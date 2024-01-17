@extends('auth.layouts.app')
@section('title','OTP')
@section('content')
    <tr>
        <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
            <div class="text">
                <h2>{!! __('Request Otp') !!}</h2>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <div class="text-author">
                <p>Dear {!! __($param['name']) !!}!</p>
                <p>Your verification code is {!! __($param['otp']) !!}</p>
                <p>Please use this code to verify your Addispay Account.</p>
            </div>
        </td>
    </tr>
@endsection
