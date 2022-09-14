<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $users = User::count();
        $widget = [
            'users' => $users,
        ];

        return view('roles.index',[
            'roles'=>Role::latest()->paginate(8),
        ]);
    }
    public function create()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        $permissions=Permission::get();
        return view('roles.create',[
            'permissions'=>$permissions,
        ]);
    }

    public function store(Request $request)
    {
        $formFeilds=$request->validate([
            'name'=>'required',
            'slug'=>'required',
            'description'=>'required',
            'level'=>'required',
            'permissions'=>'array',
        ]);
        $users = User::count();
        $Role = config('roles.models.role')::create($formFeilds);

        if (array_key_exists("permissions",$formFeilds))
        {
            foreach ($formFeilds['permissions'] as $permission) {
                $Role->attachPermission($permission);
            }
        }
      

        $widget = [
            'users' => $users,
        ];

        return redirect('/roles')->with('message','role has been added');
    }
    public function update(Role $role,Request $request)
    {
        $formFeilds=$request->validate([
            'name'=>'required',
            'slug'=>'required',
            'description'=>'required',
            'level'=>'required',
            'permissions'=>'array',
        ]);
        $role->update($formFeilds);

        if (array_key_exists("permissions",$formFeilds))
           {
               $role->syncPermissions($formFeilds['permissions']); 

           }
           else{
            $role->syncPermissions([]);
           }

        return redirect('/roles')->with('message','role has been updated');
    }

    public function edit(Role $role)
    {
        $users = User::count();
        $widget = [
            'users' => $users,
        ];

        $permissions=Permission::get();
        return view('roles.edit',[
            'role'=>$role,
            'permissions'=>$permissions,
            'rolePermissions'=>$role->permissions,
        ]);
    }

    public function delete(Role $role){
        $role->delete();
        return redirect('/roles');
    }

}
