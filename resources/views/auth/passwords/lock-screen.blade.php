@extends('auth.layouts.app')
@section('title','Addis | Locked')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="credential-holder">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-content text-center h-180" data-aos="fade-up" data-aos-easing="linear"
                                 data-aos-duration="1500">
                            </div>
                            <div class="profile-holder px-4">
                                <div>
                                    <img class='user-profile' src="{{asset(Session::get('profile_image'))}}" alt="">
                                </div>
                                <h3 class="sub-heading">
                                    {!! __(\Illuminate\Support\Facades\Session::get('username')) !!}
                                </h3>
                                <p class="b-text mb-0 ">
                                    {!! __('This screen is password protected. Please enter your password to unlock it.')
                                    !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="container mb-5">
                                {!! Form::open(['url' => route('user.unlock.screen'), 'class' => 'ajax', 'method' => 'POST']) !!}
                                <div class=" position-relative">
                                    <div class="flex-mode">
                                        {!! Form::label('Password',__('Password:'),['class' => 'form-label input-label'])
                                        !!}
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

                                {!! Form::button( __('Unlock Screen') ,['class' => 'btn btn-theme-effect w-100 mt-4','type'
                                => 'submit']) !!}
                                <div class="flex-row-mode mt-4 text-center ">
                                    <a href="{{ route('user.login-instead-unlock') }}" class="c-link">
                                        {!! __('Not '.\Illuminate\Support\Facades\Session::get('username')) !!}
                                        <span>{!! __('Login with your account') !!}</span>
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
