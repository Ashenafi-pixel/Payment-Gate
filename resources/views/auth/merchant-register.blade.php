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
                                {!! Form::open([
                                    'url' => route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.register') ,
                                    'class' => 'ajax' ,
                                    'method' => 'POST'
                                    ]) !!}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            {!! Form::label('name',__('FullName:'),
                                            ['class' => 'form-label input-label'])
                                           !!}
                                            {!! Form::text('name',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'text','placeholder' => 'Enter Full Name',
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
                                            {!! Form::label('mobile_no',__('Mobile No:'),
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
                                            {!! Form::label('confirm_password',__('Confirm Password:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::password('password_confirmation',
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'cpsw','placeholder' => 'Enter confirm password',])
                                            !!}
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
                                            {!! Form::label('company_name',__('Company Name:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::text('company_name',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'company_name','placeholder' => 'Enter Company Name',])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('company_email',__('Company Email:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::text('company_email',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'company_email','placeholder' => 'Enter Company Email',])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('company_phone',__('Company Phone:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::number('company_phone',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'company_phone','placeholder' => 'Enter Company Phone',])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('company_address',__('Company Address:'),
                                                ['class' => 'form-label input-label'])
                                            !!}
                                            {!! Form::text('company_address',null,
                                                ['class' => 'form-control form-control-lg',
                                                'id' => 'company_address','placeholder' => 'Enter Company Address',])
                                            !!}
                                        </div>
                                    </div>

                                    <!-- OTP Section -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('otp', __('Phone OTP:'), ['class' => 'form-label input-label', 'id' => 'otpLabel', 'style' => 'display:none;']) !!}
                                            {!! Form::text('otp', null, ['class' => 'form-control form-control-lg', 'id' => 'otpInput', 'placeholder' => 'Enter OTP', 'style' => 'display:none;']) !!}
                                            
                                            {!! Form::button(__('Send OTP'), ['class' => 'btn btn-theme-effect mt-2', 'id' => 'sendOtpBtn', 'onclick' => 'sendOtp()']) !!}
                                            {!! Form::button(__('Signup'), ['class' => 'btn btn-theme-effect mt-2', 'type' => 'submit', 'id' => 'signupBtn', 'disabled' => 'disabled']) !!}
                                            
                                            {!! Form::text('code', null, ['class' => 'form-control form-control-lg', 'id' => 'codeInput', 'placeholder' => 'Enter Code', 'style' => 'display:none;']) !!}
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                                <div class="mt-1 text-center ">
                                    <a href="{{ route('register') }}" class="c-link">
                                        {{ __('Signup as') }} <span>{{ __('Customer') }}</span>
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

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('sendOtpBtn').addEventListener('click', function () {
        // Check if the button is disabled to prevent multiple clicks
        if (!this.hasAttribute('disabled')) {
            sendOtp();
        }
    });

    document.getElementById('signupBtn').addEventListener('click', function (event) {
        // Prevent form submission if the "Signup" button is disabled
        if (this.hasAttribute('disabled')) {
            event.preventDefault();
            alert('Please verify your phone number first.');
            // You can add additional logic or UI feedback here
        }
    });
});

function sendOtp() {
    // Disable the "Send OTP" button to prevent multiple clicks
    document.getElementById('sendOtpBtn').setAttribute('disabled', 'disabled');

    const phoneNumber = document.getElementById('phone').value;
    const apiKey = '30c57d27443e3d76d4b8c257c0a1f4d163344b14a68e312122';

    // Make an AJAX request to send OTP and save to OtpController
    fetch('https://sms.qa.addissystems.et/api/send-bulk-sms', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'x-api-key': apiKey,
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include CSRF token
        },
        body: JSON.stringify({
            phoneNumbers: [phoneNumber],
            message: 'This is your Addispay OTP Code' + generateRandomOtp(),
        }),
    })
        .then(response => response.json())
        .then(data => {
            console.log('API Response:', data); // Log the response to the console

            if (data.message && data.message.includes("SMS sent")) {
                // Enable the "Signup" button
                document.getElementById('signupBtn').removeAttribute('disabled');
                // Hide the "Send OTP" button and OTP input
                document.getElementById('sendOtpBtn').style.display = 'none';
                document.getElementById('otpLabel').style.display = 'none';
                document.getElementById('otpInput').style.display = 'none';

                // Save OTP to OtpController
                saveOtpToController(phoneNumber, generateRandomOtp());

                alert('OTP sent successfully!');
            } else {
                alert('Failed to send OTP. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error sending OTP:', error);
            alert('Failed to send OTP. Please try again.');
        });
}

function generateRandomOtp() {
    return Math.floor(100000 + Math.random() * 900000).toString();
}

function saveOtpToController(phoneNumber, otp) {
    // Make an AJAX request to save OTP to OtpController
    fetch('{{ route('save-otp') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include CSRF token
        },
        body: JSON.stringify({
            phone: phoneNumber,
            otp: otp,
        }),
    })
        .then(response => response.json())
        .then(data => {
            console.log('OTP saved to OtpController:', data);
        })
        .catch(error => {
            console.error('Error saving OTP to OtpController:', error);
        });

}
</script>
@endpush
