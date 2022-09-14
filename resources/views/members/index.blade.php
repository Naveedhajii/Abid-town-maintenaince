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
            @permission('edit.members')
            <div>
                <a href="/balance" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add monthly bill</span>
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
                            $edit='Edit'
                            @endphp
                            <x-button :name='$edit'/>
                        </form>
                    </td>
                    <td>
                        <form action="/report/{{$member->id}}">
                            @php
                            $edit='Download report'
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
@if ($showModal)
<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>New month has been started please update balance</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div
@endif
@endsection
