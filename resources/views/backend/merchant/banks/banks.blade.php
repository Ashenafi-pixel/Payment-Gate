@extends('backend.layouts.app')
@section('title', 'Update Gateway')
@section('content')
    <div class="row">
        <div class="col-6 my-auto">
            <h2 class="page-title">{{ __('Enable Gateway') }}</h2>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE . '.banks.index') }}" class="btn btn-theme ">
                <div class="flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        view_list
                    </span>
                    {{ __('All Your Banks') }}
                </div>
            </a>
        </div>
        @include('backend.merchant.banks._form')
    </div>
@endsection
