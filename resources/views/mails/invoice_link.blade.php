@extends('auth.layouts.app')
@section('title','Invoice Link')
@section('content')
    <tr>
        <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
            <div class="text">
                <h2>{!! __('Invoice Link') !!}</h2>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <div class="text-author">
                <p>Dear {!! __($param['name']) !!}!</p>
                <p>Please view the following link to Pay the Invoice {!! __($param['link']) !!}</p>
            </div>
        </td>
    </tr>
@endsection
