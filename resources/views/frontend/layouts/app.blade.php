<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.layouts.head')
</head>
<body>
    <header>
        @include('frontend.layouts.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('frontend.layouts.footer')
    </footer>
    @include('frontend.layouts.foot')
</body>
</html>
