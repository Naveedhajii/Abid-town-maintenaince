<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use App\Http\Controllers\Auth\RegisterController;

class UserController extends Controller
{
    public function index(){
        $users = User::count();
        
        $widget = [
            'users' => $users,
        ];

        return view('users.index',[
            'users'=>User::latest()->filter(request(['search']))->paginate(8),
        ]);
    }
    public function create(){
        $users = User::count();
        
        $widget = [
            'users' => $users,
        ];

        return view('users.create',[
            'roles'=>Role::all(),
            'permissions'=>Permission::all(),
        ]);
    }
    public function store(Request $request){
     $formFeilds=$request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'roles'=>['array','required'],
            'permissions'=>'array',
        ]);
        
        $user=User::create([
            'name' => $formFeilds['name'],
            'last_name' => $formFeilds['last_name'],
            'email' => $formFeilds['email'],
            'password' => $formFeilds['password'],
        ]);
        if (array_key_exists("permissions",$formFeilds))
        {
            $user->syncPermissions($formFeilds['permissions']); 
        }
        if (array_key_exists("roles",$formFeilds))
        {
            $user->syncRoles($formFeilds['roles']);
        }
        return redirect('/users')->with('message','User has been Created');
        
    }

    public function edit(User $user){
        $users = User::count();
        
        $widget = [
            'users' => $users,
        ];
        

        $permissions=Permission::all();
        
        return view('users.edit',[
            'user'=>$user,
            'permissions'=>$permissions,
            'userPermissions'=>$user->getPermissions(),
            'userRoles'=>$user->roles,
            'roles'=>Role::all(),
        ]);
    }
    public function update(Request $request,User $user){
        $formFeilds=$request->validate( [
               'name' => ['required', 'string', 'max:255'],
               'last_name' => ['required', 'string', 'max:255'],
               'email' => ['required', 'string', 'email', 'max:255'],
               'password'=>['nullable'],
               'roles'=>'array',
               'permissions'=>'array',
           ]);
           $data=[
            'name' => $formFeilds['name'],
            'last_name' => $formFeilds['last_name'],
            'email' => $formFeilds['email'],
           ];
           if(isset($formFeilds['password']) && $formFeilds['password']){
            $data['password'] = $formFeilds['password'];
           }
           $user->update($data);
           if (array_key_exists("permissions",$formFeilds))
           {
               $user->syncPermissions($formFeilds['permissions']); 

           }
           else{
            $user->syncPermissions([]);
           }
 
           if (array_key_exists("roles",$formFeilds))
           {
               $user->syncRoles($formFeilds['roles']);
           }
           else{
            $user->syncRoles([]);
           }
           return redirect('/users')->with('message','users has been updated');
       }
}
