@extends('layouts.admin')

@section('main-content')
<div class="h-100" >
    <div style="display: flex;justify-content: space-between;" >
        <h1 class="h3 mb-4 text-gray-800">{{ __('Members') }}</h1>
        @permission('create.members')
            <div>
                <a href="/members/create" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Create member</span>
                </a>
            </div>
            @endpermission
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Members Information</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>FirstName</th>
                        <th>Lastname</th>
                        <th>Flat NO/House No</th>
                        <th>Phone No</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th  colspan="2">Actions</th>
                    </tr>
                </thead>
               
                <tbody>


                    @if(count($members)==0)

                    <tr>
                        <td colspan="100%" style="text-align: center;">{{'No Members found'}}</td>
                    </tr>
                    @endif
                
                    
                   @foreach ($members as $member)
                   <tr>
                    <td>{{$member->first_name}}</td>
                    <td>{{$member->last_name}}</td>
                    <td>{{$member->flat_no}}</td>
                    <td>{{$member->phone}}</td>
                    <td>{{$member->balance}}</td>
                    @if($member->status==1)
                    <td>Active</td>
                    @else
                    <td>Disabled</td>
                    @endif
                    @permission('edit.members')
                    <td>
                        <form action="/members/edit/{{$member->id}}">
                            @php
                            $edit='edit'
                            @endphp
                            <x-button :name='$edit'/>
                        </form>
                    </td>
                    <td>
                        <form action="/report/{{$member->id}}">
                            @php
                            $edit='download report'
                            @endphp
                            <x-button :name='$edit'/>
                        </form>
                    </td>
                    @endpermission
                    {{-- @permission('delete.members')
                    <td>
                        <form action="/members/delete/{{$member->id}}">
                            <button type="submit" href="/members/create" class="btn btn-danger btn-icon-split">
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
            {{$members->links()}}
        </div>
    </div>
</div>

</div>
<x-popup />
@endsection
