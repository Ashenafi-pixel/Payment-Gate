@extends('backend.layouts.app')
@section('title', 'All Merchants')
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('Create Merchant') }}</h3>
        </div>
    </div>
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
                                            <table>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Status</th>
                                                <tr>
                                                    <td>
                                                        {{ $merchant->name }}
                                                    </td>
                                                    <td>
                                                        {{ $merchant->email }}
                                                    </td>
                                                    <td>
                                                        {{ $merchant->mobile_number }}
                                                    </td>
                                                    <td>
                                                        {{ $merchant->status }}
                                                    </td>

                                                </tr>
                                            </table>


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
                                                        {{ __('Delete') }}
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
