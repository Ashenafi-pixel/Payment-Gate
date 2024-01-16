@extends('backend.layouts.app')
@section('title', 'All Merchants')
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('Create Merchant') }}</h3>
        </div>
    </div>
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="credential-holder">
                    <div class="row">
                        <div class="col-12">
                            <div class="container my-5">
                                {!! Form::open([
                                    'url' => route(\App\Helpers\IUserRole::ADMIN_ROLE . '.merchants.store'),
                                    'class' => 'ajax',
                                    'method' => 'POST',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            {!! Form::label('name', __('FullName:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::text('name', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'text',
                                                'placeholder' => 'Enter Full Name',
                                                'autofocus' => true,
                                            ]) !!}
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            {!! Form::label('username', __('Username:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::text('username', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'username',
                                                'placeholder' => 'Enter your username',
                                            ]) !!}
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('email', __('Email:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::email('email', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'email',
                                                'placeholder' => 'Enter your email',
                                            ]) !!}
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('mobile_no', __('Mobile No:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::number('mobile_no', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'phone',
                                                'placeholder' => 'Enter your mobile no',
                                            ]) !!}
                                            @error('mobile_no')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <h5>{{ __('Company Details') }}</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="w-100"></div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('company_name', __('Company Name:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::text('company_name', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'company_name',
                                                'placeholder' => 'Enter Company Name',
                                            ]) !!}
                                            @error('company_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('company_email', __('Company Email:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::text('company_email', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'company_email',
                                                'placeholder' => 'Enter Company Email',
                                            ]) !!}
                                            @error('company_email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('company_phone', __('Company Phone:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::number('company_phone', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'company_phone',
                                                'placeholder' => 'Enter Company Phone',
                                            ]) !!}
                                            @error('company_phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('company_address', __('Company Address:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::text('company_address', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'company_address',
                                                'placeholder' => 'Enter Company Address',
                                            ]) !!}
                                            @error('company_address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('Passport or ID', __('Passport or ID:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::file('passport', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'passport',
                                                'placeholder' => 'Enter assport or ID',
                                            ]) !!}
                                            @error('company_address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('License', __('License:'), ['class' => 'form-label input-label']) !!}
                                            {!! Form::file('license', null, [
                                                'class' => 'form-control form-control-lg',
                                                'id' => 'license',
                                                'placeholder' => 'Enter your license',
                                            ]) !!}
                                            @error('company_address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {!! Form::button(__('Create Merchant'), ['class' => 'btn btn-theme-effect w-100 mt-2', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
