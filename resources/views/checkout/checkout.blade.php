@extends('layouts.frontend.app')

@section('slider')
<style>
        .marchantSec .leftSec span, .marchantSec .leftSec label {
            display: block;
        }

        .marchantSec {
            display: flex;
            justify-content: space-between;
        }

        .marchantDetails span, .marchantDetails label {
            display: block;
        }

        .leftSec label {
            font-size: 24px;
            font-weight: 700;
            color: #000;
            text-transform: capitalize;
        }

        .marchantSec > div {
            flex: 1;
        }

        .dashboard-area.pt-150.pb-150 .col-lg-8 .header-section.mb-4 {
            position: absolute;
            top: -42px;
        }

        .dashboard-area.pt-150.pb-150 .col-lg-8 {
            position: relative;
        }

        .col-lg-8 .main-container.checkout-main-area {
            padding: 0px 0px;
            background-color: transparent;
        }

        .col-lg-8 .main-container.checkout-main-area .card-body {
            background-color: #f5f5f5;
            padding: 30px 30px;
            margin-bottom: 29px;
            /* border-radius: 16px; */
        }

        .rightSec .marchantDetails:last-child {
            padding-top: 20px;
        }

        .container {
            max-width: 1170px !important;
        }

        .dashboard-area {
            background: #fff;
        }

        div#myTabContent2 {
            background-color: #F5F5F5;
            padding: 20px 30px;
            /* border-radius: 16px; */
        }

        .table-responsive.payment-gateway-section table.table.table-checkout tbody tr td {
            border-bottom: 1px solid #D8D8D8 !important;
        }

        .table-responsive.payment-gateway-section .table-checkout tr:nth-of-type(6) td, .table-responsive.payment-gateway-section .table-checkout tr:nth-of-type(6) td strong {
            color: #333;
            font-weight: bold;
            font-size: 18px;
        }

        .table-responsive.payment-gateway-section .table-checkout tr td strong {
            font-size: 16px;
            font-weight: 600;
            color: #000;
        }

        .table-responsive.payment-gateway-section .table-checkout tr td {
            padding: 14px 0;
        }

        div#myTabContent2 {
            background-color: #F5F5F5;
            padding: 1px 30px 33px;
            /* border-radius: 16px; */
        }

        .col-lg-4 .main-container.checkout-main-area .header-section.mb-4 {
            position: absolute;
            top: -35px;
        }

        .dashboard-area.pt-150.pb-150 .col-lg-4 {
            position: relative;
        }

        .col-lg-4 .checkout-main-area {
            background: #fff;
            padding: 0px 0px;
            /* border-radius: 5px; */
        }

        .totalAmount {
            display: flex;
            justify-content: space-between;
            background-color: #3BBE50;
            color: #fff;
            align-items: center;
            padding: 20px;
            /* border-radius: 16px 16px 0px 0px; */
        }

        .col-lg-4 form.form table.table.table-checkout {
            display: none;
        }

        .login-btn button {
            background: #023047;
            font-size: 16px;
        }

        .totalAmount p {
            margin: 0px;
        }

        .login-btn button:hover {
            background: #023047;
        }

        .col-lg-4 .main-container.checkout-main-area ul.nav {
            display: block;
        }

        .col-lg-4 .main-container.checkout-main-area ul.nav .nav-link.active, .col-lg-4 .main-container.checkout-main-area ul.nav .show > .nav-link {
            /* border: 1px solid #B3B3B3 ; */
            color: #000;
            background-color: #DADADA;
        }

        ul#myTab3 li:last-child a {
            /* border-radius: 0px 0px 12px 12px; */
        }

        ul#myTab3 {
            background-color: #F5F5F5;
            /* border-radius: 0px 0px 12px 12px; */
        }

        .slider-breadcrumb-area {
            color: #fff;
            padding: 0 0;
            padding-top: 60px;
        }

        .breadcrumb-title h4 {
            font-size: 36px;
            color: #000000;
            font-weight: 600;
        }

        footer {
            display: none;
        }

        .checkout-footer:before {
            content: '';
            position: absolute;
            display: block;
            height: 80px;
            width: 100%;
            background-color: #333333;
            top: 0px;
            left: 0;
            transform-origin: left;
            transform: skew(0deg, -3deg);
        }

        .checkout-footer {
            background-color: #333333;
            padding: 80px 0px;
            color: #fff;
            position: relative;
        }

        .dashboard-area.pt-150.pb-150 {
            padding-top: 120px;
        }

        .agent-social-links nav ul li a {
            background-color: #fff;
            color: #333333;
        }

        .agent-social-links svg.iconify {
            height: 20px;
            width: 20px;
        }

        .agent-social-links ul li a {
            padding: 12px 13px;
            /* border-radius: 30px; */
        }

        .copyRight {
            background-color: #333333;
        }

        .bottomLine {

            display: flex;
            max-width: 1170px;
            margin: 0 auto;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-area .main-container {
            box-shadow: unset;
        }

        .header-section-area {
            background: #F6F6F6;
        }

        .header-area .col-lg-10 {
            display: none;
        }

        .dashboard-area.pt-150.pb-150 {
            padding-top: 80px;
        }

        .payment_method img {
            height: 36px;
            width: 100%;
            object-fit: contain;
        }

        .copyRight {
            background-color: #1F1F1F;
        }

        .bottomLine p {
            margin: 0;
        }

        .bottomLine {
            padding: 14px 0px;
        }

        .login-btn button:hover, .login-btn button:focus {
            box-shadow: 0 0.5em 0.5em -0.4em #023047;
            transform: translateY(-0.em);
        }

        .login-btn button:hover, .login-btn button:focus {
            border-color: #023047;
            color: #fff;
        }

        .login-btn button {
            transition-duration: 0.3s;
        }

        .dashboard-area.pt-150.pb-150 .col-lg-8 {
            position: inherit;
        }

        .dashboard-area.pt-150.pb-150 .container {
            max-width: 1170px !important;
            position: relative;
        }

        .dashboard-area.pt-150.pb-150 .col-lg-8 form.form {
            position: absolute;
            right: 12px;
            top: 60%;
            width: 31%;
            z-index: 9;
        }

        .col-lg-8 form.form table {
            display: none;
        }

        .header-section h4, .header-section.mb-4 h5 {
            color: #000;
        }

        .slider-breadcrumb-area {
            padding-top: 50px;
        }

        .footerLogo p {
            font-size: 15px;
            font-weight: 400;
            border-bottom: 1px solid #424242;
            padding-bottom: 30px;
            padding-top: 20px;
        }

        .agent-social-links {
            padding-top: 20px;
        }

        .footerLogo {
            width: 90%;
        }

        @media (max-width: 1280px) {
            .bottomLine {
                padding: 14px 20px;
            }
        }

        @media (max-width: 1024px) {
            .dashboard-area.pt-150.pb-150 .col-lg-8 .header-section.mb-4 {
                position: relative;
                top: 0px;
            }

            .dashboard-area.pt-150.pb-150 .col-lg-8 form.form {
                position: relative;
                right: 0px;
                top: 60%;
                width: 100%;
                z-index: 9;
            }

            .header-section h4 {
                margin-bottom: 0px;
            }

            .dashboard-area.pt-150.pb-150 .row {
                flex-direction: column-reverse;
            }

            .dashboard-area.pt-150.pb-150 .col-lg-8 .header-section.mb-4 {
                padding-top: 12px;
            }
        }

        @media (max-width: 767px) {
            .checkout-footer .col-md-4 {
                text-align: center;
                padding-bottom: 44px;
            }

            .bottomLine {
                flex-direction: column;
                justify-content: center;
                padding: 16px 30px 6px;
                text-align: center;
            }


            .dashboard-area.pb-150 {
                padding-top: 16px !important;
            }

            .marchantSec {

                flex-direction: column;
            }

            .checkout-footer {
                padding: 80px 0px 0px;
            }

            .col-lg-4 .checkout-main-area {
                padding: 42px 0px;
            }

            .col-lg-4 .main-container.checkout-main-area .header-section.mb-4 {
                top: 12px;
            }

        }

        @media (min-width: 1920px) {
            .checkout-footer:before {
                transform: skew(0deg, -2deg);
            }
        }


        ul.nav.nav-pills.mx-auto.payment_method li.nav-item .card-body img {
            width: auto !important;
        }

        ul.nav.nav-pills.mx-auto.payment_method li.nav-item .card-body span {
            font-size: 14px;
            font-weight: 400;
            color: #000;
            padding-left: 20px;
        }

        .dashboard-area.pt-150.pb-150 .col-lg-8 form.form {
            top: 86%;
        }

        .bold {
            font-weight: bold
        }

        ul.payment_method {
            max-height: 460px;
            overflow: auto;
        }

        ul.payment_method::-webkit-scrollbar {
            width: 2px;
        }

        ul.payment_method::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ul.payment_method::-webkit-scrollbar-thumb {
            background: #888;
        }

        ul.payment_method::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <!-- breadcrumb area start -->
    <div class="slider-breadcrumb-area text-center pb-5" style="background:#333333">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="breadcrumb-title">
                        @if(!empty($merchant_setting))
                            <a href="{{ url('/') }}" target="_blank">
                                <img src="{{asset('uploads/addispay-white.png')}}" height="64" alt="">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
   
@section('content')
    <div class="dashboard-area pt-150 pb-150">

        <div class="container">

            <div class="row mt-5">
                <div class="col-lg-8 mb-3">
                    <div class="alert-warning p-3">
                        <b>Only accepted via 3d secure ecommerce enabled card</b>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="main-container checkout-main-area">
                        <div class="header-section mb-4" style="position: unset !important">
                            <h4 style="font-size: 24px; font-weight:600;">Payment info</h4>
                        </div>
                        <div class="login-section">
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                            @endif
                            <div class="card-body">
                                <div class="marchantSec">
                                    <div class="leftSec">
                                        <span style="font-size: 12px; font-weight:400;">Pay to</span>
                                    </div>
                                    <div class="rightSec">
                                        <div class="marchantDetails">
                                            <span style="font-size: 12px; font-weight:400;">Email</span>
                                        </div>
                                        <div class="marchantDetails">
                                            <span style="font-size: 12px; font-weight:400;">Company Address</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent2">
                            
                                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                         id="getway{{ $gateway->id }}" role="tabpanel"
                                         aria-labelledby="getway-tab{{ $gateway->id }}">
                                        <div class="table-responsive payment-gateway-section">
                                            <table class="table table-checkout">
                                                <tr>
                                                    <td><strong>Customer Name</strong></td>
                                                    <td class="text-right">{{($info->custome_name) ?? null}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone Number</strong></td>
                                                    <td class="text-right">{{($info->custome_phone) ?? null}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Amount') }}</strong></td>
                                                    <td class="text-right">{{ ($requestData->amount) ?? null }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Currency') }}</strong></td>
                                                    <td class="text-right">{{ strtoupper($gateways->currency_name) }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Total') }}</strong></td>
                                                    <td class="text-right" id="getAmount{{ $gateway->id }}"
                                                        data-value="{{ !empty($requestData) ? $requestData->amount : null }}">{{ !empty($requestData) ? $requestData->amount : null }}
                                                        {{--                                                    <td class="text-right" id="getAmount{{ $gateway->id }}" data-value="{{($requestData->amount + $total_rate)}}">{{ $final_amount = ($requestData->amount + $total_rate) }}--}}
                                                        {{--                                                        @php--}}
                                                        {{--                                                            \Illuminate\Support\Facades\Session::put('finalAmount', $final_amount);--}}
                                                        {{--                                                        @endphp--}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Purpose') }}</strong></td>
                                                    <td class="text-right">{{ $info->purpose ?? '' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <form action="{{ route('checkout.payment.view') }}" method="post" class="form"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <input type="hidden" name="gateway_id" value="{{ $gateway->id }}">
                                                <input type="hidden" name="request_id" value="{{ $requestData->id }}">
                                                <input type="hidden" name="user_id" value="{{ $gateways->user_id }}">
                                                <input type="hidden" name="is_test" value="{{ $requestData->is_test }}">
                                                <input type="hidden" name="phone_required"
                                                       value="{{ $gateways->phone_required }}">
                                                <input type="hidden" name="image_accept"
                                                       value="{{ $gateway->image_accept }}">
                                                <input type="hidden" name="phone"
                                                       value="{{ $info->custome_phone ?? null }}">
                                                <input type="hidden" name="consumer_id"
                                                       value="{{$request->consumer_id}}">

                                                {{--@if ($gateways->phone_required == 1)--}}

                                                {{--<table class="table table-checkout">--}}
                                                {{--<tr>--}}
                                                {{--<td><strong>{{ __('Phone') }}</strong></td>--}}
                                                {{--<td class="text-right">--}}
                                                {{--<input type="text" name="phone"--}}
                                                {{--class="form-control checkout_control @error('phone') is-invalid @enderror"--}}
                                                {{--value="{{ $phone ?? old('phone') }}" required>--}}
                                                {{--@error('phone')--}}
                                                {{--<span class="invalid-feedback" role="alert">--}}
                                                {{--<strong class="screenshot-alert">{{ $message }}</strong>--}}
                                                {{--</span>--}}
                                                {{--@enderror--}}
                                                {{--</td>--}}
                                                {{--</tr>--}}
                                                {{--</table>--}}
                                                {{--@endif--}}

                                                @if ($gateway->image_accept == 1)
                                                    <table class="table table-checkout">
                                                        <tr>
                                                            <td><strong>{{ __('Screenshot') }}</strong></td>
                                                            <td class="">
                                                                <div class="custom-file">
                                                                    <input type="file" name="screenshot"
                                                                           class="form-control @error('screenshot')is-invalid @enderror screenshot"
                                                                           id="screenshot">
                                                                    @error('screenshot')
                                                                    <span class="invalid-feedback" role="alert">
                                                                <strong class="screenshot-alert">{{ $message }}</strong>
                                                            </span>
                                                                    @enderror
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                                @if ($gateway->is_auto == 0)
                                                    <table class="table table-checkout">
                                                        <tr>
                                                            <td><strong>{{ __('Comment') }}</strong></td>
                                                            <td class="">
                                                                <textarea name="comment"
                                                                          class="form-control border @error('comment')is-invalid @enderror comment">{{ old('comment') ?? '' }}</textarea>

                                                                @error('comment')
                                                                <span class="invalid-feedback" role="alert">
                                                            <strong class="screenshot-alert">{{ $message }}</strong>
                                                        </span>
                                                                @enderror

                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                                <input type="hidden" name="captcha"
                                                       value="{{ $plan->captcha == 1 && $requestData->captcha_status == 1 ? 1 : 0 }}">

                                                @if ($plan->captcha == 1 && $requestData->captcha_status == 1 && env('NOCAPTCHA_SITEKEY') && $gateway->is_auto == 0)

                                                    <div class="form-group mb-2 d-flex justify-content-center">

                                                        {!! NoCaptcha::renderJs(Session::get('locale')) !!}
                                                        {!! NoCaptcha::display() !!}
                                                    </div>

                                                @endif
                                                @if ($gateway->is_auto == 0)
                                                    <tr>
                                                        <td colspan="2" class="text-left">
                                                            <strong class="text-danger">
                                                                @php $info = json_decode($gateways->data) @endphp
                                                                {{ __('Instruction') }} : {{ $info->instruction }}
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </div>

                                            <div class="login-btn">
                                                <button type="submit"
                                                        class="btn btn-primary mt-4 w-100 submitbtn">{{ __('Submit')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-container checkout-main-area">
                        <div class="header-section mb-4 ">
                            <h5 class="bold">{{ __('How would you like to pay?') }}</h5>
                        </div>

                        <div class="siderbar">
                            <div class="totalAmount">
                                <p>Total Amount</p>
                                <span id="totalAmounts">Rs. {{ !empty($requestData) ? $requestData->amount : null }}</span>
                            </div>
                        </div>
                        <ul class="nav nav-pills mx-auto payment_method" id="myTab3" role="tablist">
                            @foreach ($usergetways as $key => $gateways)
                                @php $gateway =  $gateways->getway @endphp
                                <li class="nav-item" id="first_id" data-check="{{ $gateway->id }}"
                                    onclick="changeAmount({{ $gateway->id }})">
                                    <a class="nav-link {{ $key == 0 ? 'show active' : '' }}"
                                       id="getway-tab{{ $gateway->id }}" data-toggle="tab" data-bs-toggle="pill"
                                       href="#getway{{ $gateway->id }}" role="tab" aria-controls="home"
                                       aria-selected="true">
                                        <div class="card-body">
                                            <img src="{{ asset($gateway->logo) }}" alt="{{ $gateway->name }}"
                                                 width="100">
                                            <span>{{$gateway->name}}</span>
                                        </div>
                                    </a>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="checkout-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footerLogo">
                        <img src="{{asset('uploads/addispay-white.png')}}">
                        <p>Democratizing payments and providing ease to businesses
                            to accept payments at multiple channels</p>
                    </div>
                    <div class="agent-social-links">
                        <nav>
                            <ul>
                                <li><a href="#"><span class="iconify" data-icon="ri:facebook-fill"
                                                      data-inline="false"></span></a></li>
                                <li><a href="#"><span class="iconify" data-icon="ri:twitter-fill"
                                                      data-inline="false"></span></a></li>

                                <li><a href="#"><span class="iconify" data-icon="ri:instagram-fill"
                                                      data-inline="false"></span></a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="brand-heading">Our Payment Partners</div>
                    <img height="150" src="{{asset('frontend/assets/img/placeholder-image.jpg')}}">
                </div>
                <div class="col-md-4">
                    <div class="brand-heading">Our Payment Partners</div>
                    <img height="150" src="{{asset('frontend/assets/img/placeholder-image.jpg')}}">
                </div>
            </div>
        </div>

    </div>
    <div class="copyRight">
        <div class="bottomLine">
            <p style="font-size: 16px; font-weight:400; color:#fff;">Copyrights - 2021 www.mytm.com.pk, All Rights
                Reserved.</p>
            <p style="font-size: 16px; font-weight:700; color:#fff;">AddisPay POWERED BY MyTM</p>
        </div>
    </div>

@endsection

@push('js')
<script>
        /*--------------------------------------
      		Loader
    	---------------------------------------*/

        var preload = document.getElementById('loading');

        function hideLoader() {
            preload.style.display = "none";
        }

        function showLoader() {
            preload.style.display = "block";
        }

        /*----------------
        Form Submit
      -------------------*/
        $(document).ready(function () {
            hideLoader();
        });

        $('.form').on('submit', function () {
            $('.submitbtn').text('Please wait...');
            $('.submitbtn').prop('disabled', true);
            showLoader()
        });
    </script>
    <script>
        function changeAmount(id) {
            let total_amount = $("#getAmount" + id).data('value');
            $("#totalAmounts").html('Rs. ' + total_amount);
        }

        $(document).ready(function () {
            let id = $("#first_id").data('check');
            changeAmount(id);
        })
    </script>
@endpush
