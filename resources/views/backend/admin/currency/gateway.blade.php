@extends('backend.layouts.app')
@section('title','Update Gateway')
@section('content')
    <div class="row">
        <div class="col-6 my-auto">
            <h2 class="page-title">{{ __('Update Gateway') }}</h2>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.gateways.index') }}" class="btn btn-theme ">
                <div class="flex-mode gap-2">
                <span class="material-symbols-outlined">
                    view_list
                </span>
                    {{ __('All Payment Gateways') }}
                </div>
            </a>
        </div>
       @include('backend.admin.gateways._form')
    </div>
@endsection
