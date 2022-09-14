@extends('layouts.admin')

@section('main-content')

<h1 class="h3 mb-4 text-gray-800">{{ __('Create User') }}</h1>

<form method="POST" action="{{route('users.store')}}" class="user">
    @csrf

    <div style="gap:20px; display:flex;">
        <div class="mb-3">

        <label for="name">Name<span class="text-danger"> *</span></label>
        <input class="form-control "  type="text" placeholder="Name of user"
        name="name"value="{{old('name')}}" >
        @error('name')
        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="mb-3">
        <label for="last_name">last name <span class="text-danger"> *</span></label>
        <input class="form-control "  type="text" placeholder="last name "
        name='last_name' value="{{old('last_name')}}">
        @error('last_name')
            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror

        </div>

        <div class="mb-3">
            <label for="email">Email <span class="text-danger"> *</span></label>
            <input class="form-control "  type="text" placeholder="Email"
            name="email" value="{{old('email')}}">

            @error('email')
            <p class="text-red-500 text-xs mt-1 text-danger" text-danger>{{$message}}</p>
            @enderror
        </div>   
        <div class="mb-3">
            <label for="password">Password<span class="text-danger"> *</span></label>
            <input class="form-control "  type="password" placeholder="Password"
            name="password" value="{{old('password')}}">
        
            @error('password')
                        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>
    @php
        $rolePermissions=[];
        $userRoles=[];
    @endphp
    <x-roles :roles=$roles :userRoles=$userRoles/>
    

    <x-permissions :permissions=$permissions :rolePermissions=$rolePermissions/>
 

    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Create user</span>
    </button>

</form>

@endsection