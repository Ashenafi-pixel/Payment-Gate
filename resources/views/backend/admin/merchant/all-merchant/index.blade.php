@extends('backend.layouts.app')
@section('title', 'All Merchants')
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('All Merchants') }}</h3>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0">
            @include('backend.admin.merchant.all-merchant.__filter')
        </div>
        <div class="col-12 mt-3 tables">
            @include('backend.admin.merchant.all-merchant.__table')
        </div>
        <div class="col-12 mt-3 grids">
            @include('backend.admin.merchant.all-merchant.__grid-list')
        </div>
    </div>
@endsection
