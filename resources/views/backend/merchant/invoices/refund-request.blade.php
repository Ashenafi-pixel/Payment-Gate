@extends('backend.layouts.app')
@section('title','All Invoices')
@section('content')
    <div class="row">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __('Refund Request') }}</h3>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0">
            <div class="flex-mode gap-2  justify-content-lg-end">
                <button class="btn btn-secondary flex-mode" onClick="switchView()">
        <span id="view-symbol" class="material-symbols-outlined ">
            grid_view
        </span>
                </button>
                <button class="btn btn-green flex-mode gap-2" data-bs-toggle="offcanvas" data-bs-target="#filter">
        <span class="material-symbols-outlined">
            tune
        </span>
                    {{__('Filter')}}
                </button>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="filter">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="Enable both scrolling & backdrop">{{ __('All Customers') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <p>{{ __('Use this section to filter your records') }}</p>
                    <form action="">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label for="" class="form-label">{{ __('From') }}</label>
                                <input type="date" class="form-control form-control-lg">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">{{ __('To') }}</label>
                                <input type="date" class="form-control form-control-lg">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">{{ __('Status') }}</label>
                                <select class="form-select form-select-lg" name="" id="">
                                    <option selected>{{ __('All') }}</option>
                                    <option value="">{{ __('Approved') }}</option>
                                    <option value="">{{ __('Pending') }}</option>
                                    <option value="">{{ __('Declined') }}</option>
                                </select>
                            </div>
                            <div class="col-12 mt-4 flex-mode content-end">
                                <button type="reset" class="btn btn-danger flex-mode gap-2" data-bs-dismiss="offcanvas">
                    <span class="material-symbols-outlined">
                        close
                     </span>
                                    {{ __('Cancel') }}
                                </button>
                                <button class="btn btn-green flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        filter_list
                     </span>
                                    {{ __('Apply Filters') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-12 tables mt-3">
            <div class="table-responsive table-nowrap d-box p-0 border-radius-0">
                <table class="table">
                    <thead class="sticky-top">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Invoice ID') }}</th>
                        <th>{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? __('Student Name') : __('Customer Name') }}</th>
                        <th>{{ __('Created Date') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone Number') }}</th>
                        <th>{{ __('Invoice Status') }}</th>
                        <th>{{ __('Transaction Status') }}</th>
                        <th>{{ __('Refund') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @forelse($refundRequests as $invoice)
                        @if(isset($invoice->invoice))

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>AD{{ str_pad($invoice->invoice->id,'5','0',STR_PAD_LEFT) }}</td>
                                <td>
                                    {{ \App\Helpers\GeneralHelper::IS_SCHOOL() ?
                                        $invoice->invoice->student->name : $invoice->invoice->customer->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                                </td>
                                <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($invoice->invoice->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</td>
                                <td><b>ብር.</b>{{ $invoice->invoice->amount }}</td>
                                <td>{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? $invoice->invoice->student->email : $invoice->invoice->customer->email ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                                <td>{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? $invoice->invoice->student->mobile_number : $invoice->invoice->customer->mobile_number ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                                <td>
                                    <span
                                        class="badge {{ \App\Helpers\GeneralHelper::INVOICE_STATUS_CLASS($invoice->invoice->status) }}">{{ \App\Helpers\GeneralHelper::INVOICE_STATUS($invoice->invoice->status) }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ \App\Helpers\GeneralHelper::TRANSACTION_STATUS(isset($invoice->invoice->invoiceTransaction) ? strtoupper($invoice->invoice->invoiceTransaction->status) : "") }}">
                                        {{ isset($invoice->invoice->invoiceTransaction) ? $invoice->invoice->invoiceTransaction->status : ucfirst(strtolower(\App\Helpers\IStatuses::TRANSACTION_PENDING)) }}</span>
                                </td>
                                <td>
                                    {{ isset($invoice->invoice->invoiceTransaction) && $invoice->invoice->invoiceTransaction()->latest()->first()->is_refund == true ? 'Refunded' : 'N/A' }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-green-light flex-mode" type="button" id="action"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end animated zoomIn" aria-labelledby="action">
                                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoice.view', encrypt($invoice->invoice->id)) }}">
                                                <span class="material-symbols-outlined">
                                                    visibility
                                                </span>
                                                <span>{{ __('View') }}</span>
                                            </a>
                                            @if($invoice->invoice->status == false)
                                                <a href="javascript:void(0)" class="dropdown-item flex-mode">
                                                    <span class="material-symbols-outlined">
                                                        paid
                                                    </span>
                                                    <span>{{ __('Paid') }}</span>
                                                </a>
                                            @else
                                                <a class="dropdown-item flex-mode"
                                                   href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.pay', encrypt($invoice->invoice->id)) }}"
                                                   target="_blank">
                                                    <span class="material-symbols-outlined">
                                                        pending
                                                    </span>
                                                    <span>{{ __('Pay') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                            </tr>
                        @endif
                    @empty
                        @include('backend.partials.no-table-data')
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
