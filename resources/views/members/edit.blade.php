@extends('layouts.admin')

@section('main-content')

<h1 class="h3 mb-4 text-gray-800">Edit Member {{ $member->name }}</h1>

<form method="POST" action="/members/{{$member->id}}">
    @csrf
    @method('PUT')
    
        <div class="mb-3">
            <label for="first_name">First name<span class="text-danger"> *</span></label>
            <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="First name"
            name="first_name"value="{{$member->first_name}}" >
        </div>
        @error('first_name')
        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="last_name">Last name<span class="text-danger"> *</span></label>
            <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Last name"
            name='last_name' value="{{$member->last_name}}">
        </div>
        @error('last_name')
                        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="phone">Phone number<span class="text-danger"> *</span></label>
            <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Phone"
            name="phone" value="{{$member->phone}}" maxlength="11">
        </div>
        @error('phone')
                        <p class="text-red-500 text-xs mt-1 text-danger" text-danger>{{$message}}</p>
        @enderror
    
    
        <div class="mb-3">
            <label for="flat_no">Flat Number/House Number<span class="text-danger"> *</span></label>
            <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Flat Number"
            name="flat_no" value="{{$member->flat_no}}">
        </div>
        @error('flat_no')
                        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="balance">Balance<span class="text-danger"> *</span></label>
            <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="balance"
            name="balance" value="{{$member->balance}}" readonly>
        </div>
        @error('balance')
                        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="status" class="form-label">Select list (select one)<span class="text-danger"> *</span>:</label><br>
            <select class="form-select w-25" id="sel1" name="status" >
                @if ($member->status==1)
                <option value="1">Active</option>
                <option value="0">Disable</option>
                @else
                <option value="0">Disable</option>
                <option value="1">Active</option>
                @endif
                    
            </select>
            @error('status')
            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror

        </div>

    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Edit member</span>
    </button>

</form>
@endsection