@extends('backend.layouts.app')
@section('title','Add Student')
@section('content')
    <div class="row">
        <div class="col-6 my-auto">
            <h2 class="page-title">{{ __('Create Student') }}</h2>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.students.index') }}" class="btn btn-theme ">
                <div class="flex-mode gap-2">
                <span class="material-symbols-outlined">
                    view_list
                </span>
                    {{ __('All Students') }}
                </div>
            </a>
        </div>
       @include('backend.merchant.students._form')
    </div>
@endsection
