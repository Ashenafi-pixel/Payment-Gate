<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
{!! Html::style('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap') !!}
{!! Html::style(asset('frontend/css/bootstrap.min.css')) !!}
{!! Html::style(asset('frontend/css/aos.css')) !!}
{!! Html::style(asset('frontend/css/slick.min.css')) !!}
{!! Html::style(asset('frontend/css/onboard.css')) !!}
{!! Html::style(asset('frontend/css/app.css')) !!}
{!! Html::style(asset('app-assets/css/noty-css/main.css')) !!}
{!! Html::style(asset('app-assets/css/noty-css/metro-theme.css')) !!}
<title>{!! env('APP_NAME').' | ' !!} @yield('title')</title>
@stack('css')
