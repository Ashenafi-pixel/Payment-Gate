@extends('auth.layouts.app')
@section('title','Reset Password')
@section('content')
    <tr>
        <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
            <div class="text">
                <h2>{!! __('Reset Password Email') !!}</h2>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <div class="text-author">
                <p>Dear {!! __('User') !!}!</p>
                <p>We receive a password change request from your email. If you made this request you can click the provided link below and reset your password.</p>
                <p>If you not made this request you can ignore this email.</p>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <p><a href="{{ $param->get('link') }}" class="btn btn-primary" style="text-align: center;">{!! __('Reset Password') !!}</a></p>
        </td>
    </tr>
@endsection
