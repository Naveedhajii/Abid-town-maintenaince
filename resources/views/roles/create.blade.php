@extends('layouts.admin')

@section('main-content')

<h1 class="h3 mb-4 text-gray-800">{{ __('Create Role') }}</h1>

<form method="POST" action="{{route('roles.store')}}">
    @csrf

    <div style="gap:20px; display:flex;">
        <div class="mb-3">

            <label for="name">Name<span class="text-danger"> *</span></label>
            <input class="form-control " id="exampleFormControlInput1" type="text" placeholder="Name of role"
            name="name"value="{{old('name')}}" >

        @error('name')
        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="mb-3">
            <label for="slug">Slug <span class="text-danger"> *</span></label>
            <input class="form-control " id="exampleFormControlInput1" type="text" placeholder="Slug of role"
            name='slug' value="{{old('slug')}}">
        @error('slug')
                        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror
        </div>

        <div class="mb-3" >
            <label for="description">Description <span class="text-danger"> *</span></label>
            <input class="form-control " id="exampleFormControlInput1" type="text" placeholder="description"
            name="description" value="{{old('description')}}">

            @error('description')
            <p class="text-red-500 text-xs mt-1 text-danger" text-danger>{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="level">Level<span class="text-danger"> *</span></label>
            <input class="form-control " id="exampleFormControlInput1" type="text" placeholder="level Integer"
            name="level" value="{{old('level')}}">
        
            @error('level')
                        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>
    @php
    $rolePermissions=[];
    @endphp
    <x-permissions :permissions=$permissions :rolePermissions=$rolePermissions/>

    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Create role</span>
    </button>

</form>
@endsection