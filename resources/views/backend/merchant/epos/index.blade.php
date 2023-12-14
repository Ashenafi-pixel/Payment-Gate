@extends('backend.layouts.app')
@section('title','Payment QR Code')
<style>
    .downloadBtn {
        width: 100%;
        background: #150A42;
        color: #fff;
        text-align: center;
        max-width: 150px;
        border-radius: 5px;
        margin: 0 auto;
        height: 40px;
        line-height: 40px;
        margin-right: 0;
    }
</style>
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h1 class="page-title">Epos</h1>
            </div>
            @if (!empty($merchant_getway_exits))
                <div class="col-12 col-md-12 col-lg-12">
                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('message') }}</div>
                    @endif
                </div>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            @if (!$epose)
                                <form method="get" class="" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input id="email" class="custom-control-input" name="email" type="checkbox"
                                                           value="YES">
                                                    <label class="custom-control-label" for="email">{{ __('Email') }}</label>
                                                </div>
                                                <small class="form-text text-muted">{{ __('Customers will see this when checking
                                        out.') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input id="name" class="custom-control-input" name="name" type="checkbox"
                                                           value="YES">
                                                    <label class="custom-control-label" for="name">{{ __('Name') }}</label>&nbsp;

                                                </div>
                                                <small class="form-text text-muted">{{ __('Customers will see this when checking
                                        out.') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-switch">
                                                <input id="phone" class="custom-control-input" name="phone" type="checkbox"
                                                       value="YES">
                                                <label class="custom-control-label" for="phone">{{ __('Phone') }}</label>&nbsp;
                                            </div>
                                            <small class="form-text text-muted">{{ __('Customers will see this when checking out.')
                                    }}</small>
                                        </div>
                                        <div class="col-12 mt-3 text-right">
                                            <button type="submit" class="btn btn-primary  btn-lg">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="row">
                                    <div class="col-12 text-center mb-3">
                                        <div class="bg-theme text-white p-2 w-25 mx-auto rounded">
                                            <h3>
                                                Scan and pay
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <img height="500" src="{{asset($epose->qr)}}" />
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @else
                <div class="col-12 mt-3 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="min-height:70vh">
                                <div class="col-12 my-auto text-center">
                                    <h6>Please Installed Gateways for create Invoice.</h6>
                                    <a class="btn btn-theme mt-4" href="{{ route('merchant.gateway.index') }}">{{ __('Installed
                                Gateway') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
