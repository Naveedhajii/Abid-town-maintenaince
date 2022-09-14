@extends('layouts.admin')

@section('main-content')

<h1 class="h3 mb-4 text-gray-800">{{ __('Edit user') }}</h1>

<form method="POST" action="/users/update/{{$user->id}}">
    @csrf
        <div style="gap:20px; display:flex;" class="row">
            <div class="mb-3 col">

                <label for="name">Name<span class="text-danger"> *</span></label>
                <input class="form-control " type="text" placeholder="Name of user"
                name="name" value="{{$user->name}}" style="width: 200px" >

            @error('name')
            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror
            </div>
            <div class="mb-3 col" >
                <label for="last_name">last name <span class="text-danger"> *</span></label>
                <input class="form-control " type="text" placeholder="last_name of user should be unique"
                name='last_name' value="{{$user->last_name}}">
            @error('last_name')
                            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror

            </div>

            <div class="mb-3 col">
                <label for="email">Email <span class="text-danger"> *</span></label>
                <input class="form-control " style="width: 250px" type="text" placeholder="email"
                name="email" value="{{$user->email}}">

                @error('email')
                <p class="text-red-500 text-xs mt-1 text-danger" text-danger>{{$message}}</p>
                @enderror
                <br>
            </div>
            <div class="mb-3 col">
                <label for="password">password</label>
                <input class="form-control " type="password" placeholder="password "
                name="password" value="">
            
                @error('password')
                            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        
        <x-roles :user=$user :roles=$roles :userRoles=$userRoles/>
    
    <x-permissions :user=$user :permissions=$permissions :rolePermissions=$userPermissions/>


    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Edit user</span>
    </button>

</form>
@endsection