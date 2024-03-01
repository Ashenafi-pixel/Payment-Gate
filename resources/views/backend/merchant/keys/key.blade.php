@extends('backend.layouts.app')
@section('title', 'All Your Services')
@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <style>
        /* Add a style block to override default textarea styles */
        textarea,
        input,
        .copy-icon-button {
            border: none;
            resize: none;
            outline: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <h2>Private Key:</h2>
    <textarea id="privateKeyInput" readonly style="width: 90%; margin-bottom: 10px;" rows="3">{{ $apiResponse['private_key'] }}</textarea>
    <button onclick="copyToClipboard('privateKeyInput')" class="copy-icon-button"><i class="far fa-copy"></i></button>

    <h2>Public Key:</h2>
    <textarea id="publicKeyInput" readonly style="width: 90%; margin-bottom: 10px;" rows="3">{{ $apiResponse['public_key'] }}</textarea>
    <button onclick="copyToClipboard('publicKeyInput')" class="copy-icon-button"><i class="far fa-copy"></i></button>

    <h2>Merchant Key:</h2>
    <textarea id="merchantKeyInput" readonly style="width: 90%; margin-bottom: 10px;" rows="3">{{ $apiResponse['api_token'] }}</textarea>
    <button onclick="copyToClipboard('merchantKeyInput')" class="copy-icon-button"><i class="far fa-copy"></i></button>

    <form method="post" action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . '.generate.new.keys') }}">
        @csrf
        @method('post')
        <button type="submit" class="btn btn-primary mt-3">Generate New</button>
    </form>
    <script>
        function copyToClipboard(inputId) {
            const inputElement = document.getElementById(inputId);
            inputElement.select();
            document.execCommand('copy');
            alert('Copied to clipboard: ' + inputElement.value);
        }
    </script>

@endsection
