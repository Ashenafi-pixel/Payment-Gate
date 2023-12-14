@extends('backend.layouts.app')
@section('title','All Transactions')
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('All Transactions') }}</h3>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0">
            @include('backend.admin.ledger.__filter')
        </div>
        <div class="col-12 tables mt-3">
            @include('backend.admin.ledger.__table')
        </div>
        <div class="col-12 mt-3 grids">
            @include('backend.admin.ledger.__grid-list')
        </div>
    </div>
@endsection
