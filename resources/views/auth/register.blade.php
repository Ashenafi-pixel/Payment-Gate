@extends('auth.layouts.app')
@section('title','Signup')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="credential-holder">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-content" data-aos="fade-up" data-aos-easing="linear"
                                 data-aos-duration="1500">
                                <h3 class="sub-heading text-white text-center">
                                    {!! __('Welcome') !!}
                                </h3>
                                <p class="b-text text-white text-center mb-0">
                                    {!! __('To keep connected with us please signup with your personal info.') !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                            <div class="container my-5">
                                {!! Form::open(['url' => route('register') , 'class' => 'ajax' , 'method' => 'POST']) !!}
                                    <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            {!! Form::label('name',__('FullName:'),
                                            ['class' => 'form-label input-label'])
                                           !!}
                                            {!! Form::text('name',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'text','placeholder' => 'Enter registered username or email',
                                                'autofocus' => true])
                                              !!}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            {!! Form::label('username',__('Username:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::text('username',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'username','placeholder' => 'Enter your username',])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('email',__('Email:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::email('email',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'email','placeholder' => 'Enter your email',])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('phone',__('Mobile No:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::number('mobile_no',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'phone','placeholder' => 'Enter your mobile no',])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('psw',__('Password:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::password('password',
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'psw','placeholder' => 'Enter password',
                                                'onkeyup'   =>  "isGood(this.value)"
                                                ])
                                            !!}
                                            <small id='password-text'></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('cpsw',__('Confirm Password:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::password('password_confirmation',
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'cpsw','placeholder' => 'Enter confirm password',])
                                            !!}
                                        </div>
                                    </div>
                                </div>
                                    {!! Form::button( __('Signup as Customer') ,['class' => 'btn btn-theme-effect w-100 mt-2','type'=>'submit']) !!}
                                {!! Form::close() !!}
                                <div class=" mt-4 text-center ">
                                    <a href="{{route('login')}}" class="c-link">
                                        {!! __('I have an account') !!} <span>{{ __('Login') }}</span>
                                    </a>
                                </div>
                                <div class=" mt-1 text-center ">
                                    <a href="{{route('merchant.register')}}" class="c-link">
                                        {{ __('Signup as') }} <span>{{ __('Merchant') }}</span>
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
@section('scripts')
@endsection

