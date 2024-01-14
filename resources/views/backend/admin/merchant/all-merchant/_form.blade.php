@extends('backend.layouts.app')
@section('title', 'All Merchants')
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('Create Merchant') }}</h3>
        </div>
    </div>
    <div class="table-responsive table-nowrap d-box p-0 border-radius-0 animated zoomIn">
        @if (Session::has('success'))
            <div id="successMessage" class="alert alert-success">
                {{ Session::get('success') }}
            </div>

            <script>
                setTimeout(function() {
                    document.getElementById('successMessage').style.display = 'none';
                }, 5000); // 5000 milliseconds = 5 seconds
            </script>
        @endif
        <section class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="credential-holder">
                        <div class="row">
                            <div class="col-12">
                                <div class="container my-5">
                                    <div class="d-box">
                                        {{ $merchant->id }}
                                        {!! Form::model([
                                            'url' => route(\App\Helpers\IUserRole::ADMIN_ROLE . '.merchant.update', $merchant->id),
                                            'method' => 'POST',
                                            'class' => 'ajax',
                                        ]) !!}
                                        <div class="row gy-3">
                                            <div class="row gy-3">
                                                <div class="col-md-6">
                                                    {!! Form::label('name', __('Name'), ['class' => 'form-label bold']) !!}
                                                    {!! Form::text('name', $merchant->name ?? null, [
                                                        'class' => 'form-control',
                                                        'id' => '',
                                                        'placeholder' => 'your name',
                                                        'autofocus' => true,
                                                    ]) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('email', __('Email'), ['class' => 'form-label bold']) !!}
                                                    {!! Form::text('email', $merchant->email ?? null, [
                                                        'class' => 'form-control',
                                                        'id' => '',
                                                        'placeholder' => 'xx@gmail.com',
                                                        'autofocus' => true,
                                                    ]) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('status', __('Status'), ['class' => 'form-label bold']) !!}
                                                    {!! Form::text('status', $merchant->status ?? null, [
                                                        'class' => 'form-control',
                                                        'id' => '',
                                                        'placeholder' => 'in active',
                                                        'autofocus' => true,
                                                    ]) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('mobile_number', __('Phone'), ['class' => 'form-label bold']) !!}
                                                    {!! Form::text('mobile_number', $merchant->mobile_number ?? null, [
                                                        'class' => 'form-control',
                                                        'id' => '',
                                                        'placeholder' => '+2519',
                                                        'autofocus' => true,
                                                    ]) !!}
                                                </div>

                                                <div class="col-12 mt-4 text-end">
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                        class="btn btn-danger me-3">
                                                        <div class="flex-mode gap-2">
                                                            <span class="material-symbols-outlined">
                                                                close
                                                            </span>
                                                            {{ __('Back') }}
                                                        </div>
                                                    </a>
                                                    <button type="submit" class="btn btn-green">
                                                        <div class="flex-mode gap-2">
                                                            <span class="material-symbols-outlined">
                                                                save
                                                            </span>
                                                            {{ __('Change') }}
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </section>
    @endsection
