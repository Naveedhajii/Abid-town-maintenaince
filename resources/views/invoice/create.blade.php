@extends('layouts.admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@section('main-content')

@if($member==null||$request['search']=='')
    <form method="GET" action="{{route('invoice.create')}}">
        @csrf
        <div class="mb-3">
            <label for="search">Enter phone number or flat/house number</label>
            <input class="form-control w-25"  type="text" placeholder="search no"
            name="search"value="{{old('search')}}" >
        </div>
        
        <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>

        <button type="submit" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-search"></i>
            </span>
            <span class="text">Search</span>
        </button>

    </form>
@elseif($member->count()>0)
    @section('main-content')
        <h1 class="h3 mb-4 text-gray-800">{{ __('Add payments') }}</h1>
        <form method="POST" action="/invoice/create/{{$member->id}}">
            @csrf
            <div class="mb-3">
                <label for="name">Name <span class="text-danger"> *</span></label>
                <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Name"
                name="name"value="{{$member->first_name}}" readonly >
            </div>
            @error('name')
            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="last_name">Last name<span class="text-danger"> *</span></label>
                <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Last name"
                name='last_name' value="{{$member->last_name}}" readonly>
            </div>
            @error('last_name')
                            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="flat_no">Flat Number/House Number<span class="text-danger"> *</span></label>
                <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Flat Number"
                name="flat_no" value="{{$member->flat_no}}" readonly>
            </div>
            @error('flat_no')
                            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror
            
            <div class="mb-3">
                <label for="amount">Amount <span class="text-danger"> *</span></label>
                <input class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Amount"
                name="amount" value="{{old('amount')}}">
            </div>
            @error('amount')
                            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror

            @if ($member->balance!=0)
            <div class="mb-3">
                <label for="balance" class="form-label">Select list (select one):</label><br>
                <select class="form-select w-25" id="sel1" name="balance" value="{{old('balance')}}">
                        <option></option>
                    @foreach ($member->payable as $payable)
                        <option value="{{$payable->id}}">{{$payable->name}} Amount {{$payable->remaining}}</option>
                    @endforeach
                </select>
                @error('balance')
                <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
                @enderror
            </div>    
            @endif
            

            {{-- <div class="form-group"> <!-- Date input -->
                <label class="control-label" for="month" >Please Select Month<span class="text-danger"> *</span></label>
                <input class="form-control w-25" id="date" name="month" placeholder="MM-YYYY" type="text" value="{{old('month')}}"/>
                @error('month')
                <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
                @enderror
            </div> --}}
            
            <div class="mb-3">
                <label for="note">Note<span class="text-danger"> *</span></label>
                <textarea class="form-control w-25" id="exampleFormControlInput1" type="text" placeholder="Example: October,November..."
                name="note" value="{{old('note')}}" ></textarea>
            </div>
            @error('note')
                            <p class="text-red-500 text-xs mt-1 text-danger">{{$message}}</p>
            @enderror

            <!-- Include Date Range Picker -->
        
            {{-- <script>

                $(document).ready(function(){
                var date_input=$('input[name="month"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'mm-yyyy',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                    multidate:true,
                };
                date_input.datepicker(options);
                })

            </script> --}}

            <button type="submit" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Genarate Invoice</span>
            </button>

        </form>

        @endif
        <x-popup />
@endsection
