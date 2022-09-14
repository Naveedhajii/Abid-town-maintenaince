@extends('layouts.admin')

@section('main-content')
<div class="h-100" >
    <div style="display: flex;justify-content: space-between;" >
        <h1 class="h3 mb-4 text-gray-800">{{ __('Payments') }}</h1>
        @permission('create.invoices')
        <div>
            <a href="/invoice/create" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Create Payment</span>
            </a>
        </div>
        @endpermission
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Payments Information</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Note</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Invoice ID</th>
                        <th>Flat NO/House Number</th>
                        <th>Amount</th>
                        <th>Payed at</th>
                        <th>Created By </th>
                        <th>Actions</th>
                    </tr>
                </thead>
               
                <tbody>

                    @if(count($payments)==0)

                    <tr>
                        <td colspan="100%" style="text-align: center;">{{'No Payments found'}}</td>
                    </tr>
                    @endif

                   @foreach ($payments as $payment)
                   <tr>
                    <td>{{$payment->note}}
                        </td>
                    <td>{{$payment->member->first_name}}</td>
                    <td>{{$payment->member->last_name}}</td>
                    <td>{{$payment->invoice_id}}</td>
                    <td>{{$payment->member->flat_no}}</td>
                    <td>{{$payment->amount}}</td>
                    <td>{{$payment->created_at}}</td>
                    <td>{{$payment->createdby->name}}</td>
                    
                    <td>
                        <form action="/pdf/{{$payment->member->id}}/{{$payment->id}}">
                            @php
                            $edit='download'
                            @endphp
                            <x-button :name='$edit'/>
                        </form>
                    </td>
                    </td>
                </tr>
                   @endforeach
                </tbody>
            </table>
            {{$payments->links()}}
        </div>
    </div>
</div>

</div>
<x-popup />
@endsection
