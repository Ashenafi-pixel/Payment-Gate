@extends('auth.layouts.app')

@section('title','Addis | Login')
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
                                    {!! __('Welcome Back') !!}
                                </h3>
                                <p class="b-text text-white text-center mb-0">
                                    {!! __('To keep connected with us please login with your personal info.') !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                            <div class="container my-5">
                                {!! Form::open(['url' => route('login'), 'class' => 'ajax', 'method' => 'POST']) !!}
                                    <div class="mb-3">
                                        {!! Form::label('email',__('Email | Username:'),
                                            ['class' => 'form-label input-label'])
                                           !!}
                                        {!! Form::text('login',null,
                                            ['class' => 'form-control form-control-lg',
                                            'id' => 'email','placeholder' => 'Enter registered username or email',
                                            'autofocus' => true])
                                          !!}
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <div class="flex-mode">
                                            {!! Form::label('Password',__('Password:'),['class' => 'form-label input-label']) !!}
                                            <a href="{{ route('user.forgot.password') }}" class="link-fpsw text-end">
                                                {!! __('Forgot Password?') !!}
                                            </a>
                                        </div>
                                        {!! Form::password('password',
                                            ['class' => 'form-control form-control-lg',
                                            'id' => 'psw',
                                            'placeholder' => 'Enter Password'])
                                           !!}
                                        <span class='show-hide' id="togglePassword">
                                            <span class="material-symbols-outlined">
                                                {!! __('visibility') !!}
                                            </span>
                                        </span>
                                    </div>
                                    {!! Form::button( __('Login') ,['class' => 'btn btn-theme-effect w-100 mt-2','type' => 'submit']) !!}
                                    <div class="flex-row-mode mt-4 text-center ">
{{--                                        <div class="form-check">--}}
{{--                                            {!! Form::checkbox('','',false,['class' => 'form-check-input', 'id' => '']) !!}--}}
{{--                                            {!! Form::label('', __('Remember Me') , ['class' => 'form-check-label']) !!}--}}
{{--                                        </div>--}}
                                        <a href="{{ route('register') }}" class="c-link">
                                            {!! __("I don't have any account") !!} <span>{!! __('Sign up Now') !!}</span>
                                        </a>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
