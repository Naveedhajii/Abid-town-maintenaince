@extends('layouts.admin')

@section('main-content')
<div class="h-100" >
    <div style="display: flex;justify-content: space-between;" >
        <h1 class="h3 mb-4 text-gray-800">{{ __('Roles') }}</h1>
        @permission('create.roles')
            <div>
                <a href="/roles/create" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Create Role</span>
                </a>
            </div>
            @endpermission
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Roles Information</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
               
                <tbody>

                    {{-- <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                    </tr> --}}
                    @if(count($roles)==0)

                    <tr>
                        <td colspan="5" style="text-align: center;">{{'No Members found'}}</td>
                    </tr>
                    @endif
                
                    
                   @foreach ($roles as $role)
                   <tr>
                    <td>{{$role->name}}</td>
                    <td>{{$role->slug}}</td>
                    <td>{{$role->description}}</td>
                    <td>{{$role->level}}</td>
                    @permission('edit.roles')
                    <td>
                        <form action="/roles/edit/{{$role->id}}">
                            @php
                            $edit='Edit'
                            @endphp
                            <x-button :name='$edit'/>
                        </form>
                    </td>
                    @endpermission
                    {{-- @permission('delete.roles')
                    <td>
                        <form action="/roles/delete/{{$role->id}}">
                            <button type="submit"  class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Delete</span>
                            </button>
                        </form>
                    </td>
                    @endpermission --}}
                </tr>
             @endforeach
                </tbody>
            </table>
            {{$roles->links()}}
        </div>
    </div>
</div>

</div>
<x-popup />
@endsection
