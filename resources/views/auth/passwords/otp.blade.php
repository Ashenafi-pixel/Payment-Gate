@extends('auth.layouts.app')

@section('title','Addis | OTP')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="credential-holder">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-content text-center text-white" data-aos="fade-up"
                                 data-aos-easing="linear"
                                 data-aos-duration="1500">
                                <h3 class="sub-heading">
                                    {!! __('Account Verification') !!}
                                </h3>
                                <p class="b-text mb-0 text-center">
                                    {!! __('We have sent a verification code to your mobile ******'.substr(\App\Helpers\GeneralHelper::USER('email'),-6)) !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <div class="container my-5">
                                {!! Form::open(['url' => route(App\Helpers\IUserRole::CUSTOMER_ROLE.'.profile.verify.otp'), 'class' => 'ajax', 'method' => 'POST']) !!}
                                <p class="otp-text mt-2 ">
                                    Please enter the 4-digit code of Your Account.
                                </p>
                                <div class="my-4 form-otp">
                                    <input class="otp" type="tel" name="first" oninput='digitValidate(this)' onkeyup='tabChange(1)'
                                           maxlength=1 autofocus>
                                    <input class="otp" type="tel" name="second" oninput='digitValidate(this)' onkeyup='tabChange(2)'
                                           maxlength=1>
                                    <input class="otp" type="tel" name="third" oninput='digitValidate(this)' onkeyup='tabChange(3)'
                                           maxlength=1>
                                    <input class="otp" type="tel" name="fourth" oninput='digitValidate(this)' onkeyup='tabChange(4)'
                                           maxlength=1>
                                </div>
                                <p class="otp-verify">
                                    {!! Form::button( __('Verify OTP') ,['class' => 'btn btn-theme-effect w-100 mt-2','type' =>
                                'submit']) !!}
                                </p>
                                {!! Form::close() !!}
                                <hr class="mt-4">
                                <div class="row">
                                    <div class="col-lg-9 my-auto justify-content-center justify-content-lg-start d-flex ">
                                        {{ __("Didn't get the code?") }}
                                        <span class="otp-time" id="time">01:00</span>
                                        {!! Form::open(['url' => route(\App\Helpers\IUserRole::CUSTOMER_ROLE.'.profile.resend.otp'),'id'=>'resend_form','class' => 'ajax d-none']) !!}
                                        <span class="otp-req ms-2">
                                        {!! Form::submit(__('Resend code'),['class' => 'otp-req']) !!}
                                    </span>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-lg-3 text-center text-lg-end">
                                        <a class="otp-req" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span>{{ __('Logout') }}</span>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>

        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    //hide the timer and show the link of the resend button
                    let timer = document.querySelector('#time');
                    timer.style.display = 'none';
                    let resend_form = document.getElementById('resend_form');
                    resend_form.classList.add('d-flex') ;
                    resend_form.classList.remove('d-none') ;
                }

            }, 1000);
        }

        window.onload = function () {
            var minutes = 60 * 1;//in seconds
                display = document.querySelector('#time');
            startTimer(minutes, display);
        };
    </script>
@endpush
