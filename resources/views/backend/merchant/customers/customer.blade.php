@extends('backend.layouts.app')
@section('title','Add Customer')
@section('content')
    <div class="row">
        <div class="col-6 my-auto">
            <h2 class="page-title">{{ isset($customer) ? __('Update Customer') :  __('Create Customer') }}</h2>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.customers.index') }}" class="btn btn-theme ">
                <div class="flex-mode gap-2">
                <span class="material-symbols-outlined">
                    view_list
                </span>
                    {{ __('All Customers') }}
                </div>
            </a>
        </div>
       @include('backend.merchant.customers._form')
    </div>
@endsection
