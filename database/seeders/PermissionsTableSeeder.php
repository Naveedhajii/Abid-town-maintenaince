<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $PermissionsFor=['users','members','invoices','roles'];

        $i=0;
        $Permissionitems=[];
        foreach($PermissionsFor as $Permissionname){
            $Permissionitems[$i]=[
                'name'        => 'Can View '.$Permissionname,
                'slug'        => 'view.'.$Permissionname,
                'description' => 'Can view '.$Permissionname,
                'model'       => 'Permission',
            ];
            $i++;
            $Permissionitems[$i]=[
                'name'        => 'Can Create '.$Permissionname,
                'slug'        => 'create.'.$Permissionname,
                'description' => 'Can create new '.$Permissionname,
                'model'       => 'Permission',
            ];
            $i++;
            $Permissionitems[$i]=[
                'name'        => 'Can Edit '.$Permissionname,
                'slug'        => 'edit.'.$Permissionname,
                'description' => 'Can edit '.$Permissionname,
                'model'       => 'Permission',
            ];
            $i++;
            $Permissionitems[$i]=[
                'name'        => 'Can Delete '.$Permissionname,
                'slug'        => 'delete.'.$Permissionname,
                'description' => 'Can delete '.$Permissionname,
                'model'       => 'Permission',
            ];
            $i++;
        }


        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
