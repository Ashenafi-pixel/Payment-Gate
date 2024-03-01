@extends('auth.layouts.app')
@section('title','Forgot Password')
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
                                    {!! __('Forgot Password?') !!}
                                </h3>
                                <p class="b-text text-white text-center mb-0">
                                    {!! __("Enter your email and we'll send you instructions to reset your password via mail.") !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                            <div class="container my-5">
                                <form action="{{ route('user.forgot.password.link') }}" class="ajax" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label input-label">Email:</label>
                                        <input type="email" class="form-control form-control-lg" name="email" id="email"
                                               placeholder="Enter registered username or email" autofocus>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-theme-effect w-100 mt-2">{{ __('Send Password Reset Link') }}</button>
                                </form>
                                <div class=" mt-4 text-center">
                                    <a href="{{route('login')}}" class="c-link">
                                        {!! __('Wait, I remember my password...') !!} <span>Login </span>
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
