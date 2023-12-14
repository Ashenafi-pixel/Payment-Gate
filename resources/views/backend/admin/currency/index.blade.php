@extends('backend.layouts.app')
@section('title','All Banks')
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('All Banks') }}</h3>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0">
            @include('backend.admin.currency.__filter')
        </div>
        <div class="col-12 tables mt-3">
            @include('backend.admin.currency.__table')
        </div>
        <div class="col-12 mt-3 grids">
            @include('backend.admin.currency.__grid-list')
        </div>
    </div>
@endsection
