@extends('backend.layouts.app')
@section('title',__('All Pending Merchants'))
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('Pending Merchants') }}</h3>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0">
            @include('backend.admin.merchant.document.__filter')
        </div>
        <div class="col-12 tables mt-3">
            @include('backend.admin.merchant.document.__table')
        </div>
        <div class="col-12 mt-3 grids">
            @include('backend.admin.merchant.document.__grid-list')
        </div>
    </div>
@endsection
