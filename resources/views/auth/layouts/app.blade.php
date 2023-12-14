<html class="loading" lang="@if(session()->has('locale')){{session()->get('locale')}}@endif" data-textdirection="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Include core + vendor Styles -->
    @include('frontend.layouts.head')
</head>

<body>
    <section class="credential-header">
        <div class="c-absolute">
            <div class="text-center pt-4">
                <a href="{{ route('home') }}">
                    <img height='54' src="{{asset('images/addispay-logo.png')}}" alt="">
                </a>
            </div>
        </div>
    </section>
    @yield('content')
    @include('frontend.layouts.foot')
</body>

</html>
