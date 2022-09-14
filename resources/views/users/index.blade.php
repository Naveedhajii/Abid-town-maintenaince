@extends('layouts.admin')

@section('main-content')
<div class="h-100" >
    <div style="display: flex;justify-content: space-between;" >
        <h1 class="h3 mb-4 text-gray-800">{{ __('Users') }}</h1>
        @permission('create.users')
            <div>
                <a href="/users/create" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Create</span>
                </a>
            </div>
            @endpermission
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users Information</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Roles</th>
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
                    @if(count($users)==0)

                    <tr>
                        <td colspan="5" style="text-align: center;">{{'No Members found'}}</td>
                    </tr>
                    @endif
                
                    
                   @foreach ($users as $user)
                   <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>@foreach ($user->roles as $item)
                        <span class="badge badge-pill badge-primary w-50 h-50">{{$item->name}}</span>
                        
                    @endforeach</td>
                    @permission('edit.users')
                    <td>
                        <form action="/users/edit/{{$user->id}}">
                            @php
                            $edit='edit'
                            @endphp
                            <x-button :name='$edit'/>
                        </form>
                    </td>
                    @endpermission

                </tr>
             @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
</div>

</div>
<x-popup />
@endsection
