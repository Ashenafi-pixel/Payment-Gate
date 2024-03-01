<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{!! 'AddisPay | Requests' !!} </title>
    @include('frontend.layouts.head')
</head>
<body>
    <main>
        <div class="col-12">
            <div class="row">
                <section class="col-md-8 pe-md-0 my-auto">
                    @include('frontend.invoice.__payment-info')
                </section>
                <section class="col-md-4">
                    @include('frontend.invoice.__payment-methods')
                </section>
            </div>
        </div>
    </main>
    @include('frontend.layouts.foot')
</body>

</html>
