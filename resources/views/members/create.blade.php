@extends('layouts.admin')

@section('main-content')

<h1 class="h3 mb-4 text-gray-800">{{ __('Create Member') }}</h1>

<form method="POST" action="{{route('store')}}">
    @csrf
    <div class="mb-3">
        <label for="first_name">First name<span class="text-danger"> *</span></label>
        <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="First name"
        name="first_name"value="{{old('first_name')}}" >
    </div>
    @error('first_name')
    <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
    @enderror

    <div class="mb-3">
        <label for="last_name">Last name<span class="text-danger"> *</span></label>
        <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Last name"
        name='last_name' value="{{old('last_name')}}">
    </div>
    @error('last_name')
                    <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
    @enderror

    <div class="mb-3">
        <label for="phone">Phone number<span class="text-danger"> *</span></label>
        <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Phone"
        name="phone" value="{{old('phone')}}" maxlength="11">
    </div>
    @error('phone')
                    <p class="text-red-500 text-xs mt-1 text-danger" text-danger>{{$message}}</p>
    @enderror

    <div class="mb-3">
        <label for="flat_no">Flat Number/House Number<span class="text-danger"> *</span></label>
        <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Flat Number"
        name="flat_no" value="{{old('flat_no')}}">
    </div>
    @error('flat_no')
                    <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
    @enderror

    <div class="mb-3">
        <label for="balance">Balance<span class="text-danger"> *</span></label>
        <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="balance"
        name="balance" value="{{old('balance')}}">
    </div>
    @error('balance')
                    <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
    @enderror

    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Create member</span>
    </button>

</form>
@endsection