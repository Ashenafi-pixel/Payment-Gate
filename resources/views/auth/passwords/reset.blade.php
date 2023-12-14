@extends('auth.layouts.app')
@section('title','Reset Password')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="credential-holder">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-content text-center" data-aos="fade-up" data-aos-easing="linear"
                                 data-aos-duration="1500">
                                <h3 class="sub-heading text-white text-center">
                                    {!! __('Reset Password') !!}
                                </h3>
                                <p class="b-text text-white text-center mb-0">
                                    {!! __('Enter your password to reset.') !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                            <div class="container my-5">
                                {!! Form::open(['url' => route('user.reset.password'), 'class' => 'ajax', 'method' => 'post']) !!}
                                {!! Form::hidden('_verification_token', $token) !!}
                                <div class="mb-3">
                                    {!! Form::label('password', __('New Password'),['class' => 'form-label input-label']) !!}
                                    {!! Form::password('password', ['class' => 'form-control form-control-lg', 'placeholder' => 'New Password']) !!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::label('password_confirmation', __('Confirm Password'),['class' => 'form-label input-label']) !!}
                                    {!! Form::password('password_confirmation', ['class' => 'form-control form-control-lg', 'placeholder' => 'Confirm New Password']) !!}
                                </div>
                                {!! Form::submit(__('Reset Password'), ['class' => 'btn btn-theme-effect w-100 mt-2']) !!}
                                {!! Form::close() !!}
                                <div class=" mt-4 text-center">
                                    <a href="{{route('login')}}" class="c-link">
                                        {!! __('Wait, I remember my password...') !!} <span>{!! __('Sign in') !!} </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

