@extends('backend.layouts.app')
@section('title', 'All Oddo Requests')
@section('content')
    <div class="row mt-1 gy-3">
        <div class="col-lg-6 my-auto">
            <h3 class="page-title">{{ __(' All Oddo Requests') }}</h3>
        </div>
        <div class="col-lg-6">

        </div>
        <div class="col-lg-6">
            <div class="d-box position-relative">
                <h3 class="small-heading">{{ __('Customer Info') }}</h3>
                <hr>
                <div class="flex-mode  justify-content-between">
                    <p class="flex-heading">{{ __('Name') }}</p>
                    <p class="flex-text">{{ $invoice->customer->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode  justify-content-between">
                    <p class="flex-heading">{{ __('Email') }}</p>
                    <p class="flex-text">{{ $invoice->customer->email ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode  justify-content-between">
                    <p class="flex-heading">{{ __('Phone') }}</p>
                    <p class="flex-text">{{ $invoice->customer->mobile_number ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode  justify-content-between">
                    <p class="flex-heading">{{ __('Status') }}</p>
                    <p class="flex-text">
                        <span class="badge {{ \App\Helpers\GeneralHelper::INVOICE_STATUS_CLASS($invoice->customer->status == 'ACTIVE' ? 1 : 0) }}">{{ $invoice->customer->status ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</span>
                    </p>
                </div>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="d-box position-relative">
                <h3 class="small-heading">{{ __('Request Info') }}</h3>
                <hr>
                <div class="flex-mode  justify-content-between">
                    <p class="flex-heading">{{ __('Created Date') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::FORMAT_DATE($invoice->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                @php
                    $amount = $invoice->amount;
                @endphp
                @if(count($invoice->invoiceTransactions) > 0)
                    <div class="flex-mode  justify-content-between">
                        <p class="flex-heading">{{ __('Request Amount') }}</p>
                        <p class="flex-text"><b>ብር.</b>{{ $invoice->amount }}</p>
                    </div>
                    @foreach($invoice->invoiceTransactions as $transaction)
                        @php
                            $amount = $amount - $transaction->credit;
                        @endphp
                        <div class="flex-mode  justify-content-between">
                            <p class="flex-heading">{{ __('Refunded Amount') }}</p>
                            <p class="flex-text"><b>ብር.</b>{{ $transaction->credit }}</p>
                        </div>
                    @endforeach
                    <div class="flex-mode  justify-content-between">
                        <p class="flex-heading">{{ __('Remaining Amount') }}</p>
                        <p class="flex-text"><b>ብር.</b>{{ sprintf("%0.2f", $amount) }}</p>
                    </div>
                @else
                    <div class="flex-mode  justify-content-between">
                        <p class="flex-heading">{{ __('Amount') }}</p>
                        <p class="flex-text"><b>ብር.</b>{{ $amount }}</p>
                    </div>
                @endif
                <div class="flex-mode  justify-content-between">
                    <p class="flex-heading">{{ __('REQUEST STATUS') }}</p>
                    <p class="flex-text">
                        <span class="badge {{ \App\Helpers\GeneralHelper::INVOICE_STATUS_CLASS($invoice->status) }}">{{ \App\Helpers\GeneralHelper::INVOICE_STATUS($invoice->status) }}</span>
                    </p>
                </div>
                <div class="flex-mode  justify-content-between">
                    <p class="flex-heading">{{ __('Transaction Status') }}</p>
                    <p class="flex-text">
                        <span class="badge {{ \App\Helpers\GeneralHelper::TRANSACTION_STATUS(isset($invoice->invoiceTransaction) ? strtoupper($invoice->invoiceTransaction->status) : "") }}">
                            {{ isset($invoice->invoiceTransaction) ? $invoice->invoiceTransaction->status : ucfirst(strtolower(\App\Helpers\IStatuses::TRANSACTION_PENDING)) }}
                        </span>
                    </p>
                </div>

            </div>
        </div>
        <div class="col-12 mt-4 text-end">
            <a href="{{ url()->previous() }}" type="reset" class="btn btn-danger me-3">
                <div class="flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                    {{ __('Back') }}
                </div>
            </a>
            @if(isset($invoice->invoiceTransaction) && ($invoice->invoiceTransaction->status == 'Success' && $amount > 0))
                <button type="submit" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#importCustomer">
                    <div class="flex-mode gap-2">
                        <span class="material-symbols-outlined">
                           replay
                        </span>
                        {{ __('Refund') }}
                    </div>
                </button>
            @endif
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal animated zoomIn" id="importCustomer" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoice.refund') }}" method="POST" class="ajax">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ isset($invoice->invoiceTransaction) ? $invoice->invoiceTransaction->id : '' }}">
                <div class="modal-header">
                    <h5 class="modal-title page-title" id="modalTitleId">Refund Amount</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0 ">
                        <div class="row gy-2">
                            <div class="col-12">
                                <h6 class="sub-title mb-2">Refund Type:</h6>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="completePayment">
                                        Complete
                                    </label>
                                    <input class="form-check-input" type="radio" name="payment" id="completePayment" value="completeRefund">
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="partialPayment">
                                         Partial
                                    </label>
                                    <input class="form-check-input" type="radio" name="payment" id="partialPayment" value="partialRefund">
                                </div>
                            </div>
                            <div class="col-12 Partialamount">
                                 <div class="mb-2">
                                    <label for="" class="form-label semi-bold">Refund Amount:</label>
                                    <input type="text" class="form-control" name="partialAmount" id="" aria-describedby="helpId" placeholder="">
                                 </div>
                            </div>
                            <div class="col-12">
                                <h6 class="sub-title mb-2">Refund Method:</h6>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="cardTransfer">
                                         Transfer in the card
                                    </label>
                                    <input class="form-check-input" type="radio" name="transfer" id="cardTransfer" value="card">
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="bankTransfer">
                                            Transfer through the bank account
                                    </label>
                                    <input class="form-check-input" type="radio" name="transfer" id="bankTransfer" value="account">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger flex-mode gap-2" data-bs-dismiss="modal">
                        <span class="material-symbols-outlined">
                            close
                        </span>
                        Not Now
                    </button>
                    <button type="submit" class="btn btn-green flex-mode gap-2">
                        <span class="material-symbols-outlined">
                            replay
                        </span>
                            Refund
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('js')
<script>
    $('input[type=radio][name=payment]').change(function() {
    if (this.value == 'completeRefund') {
        $('.Partialamount').hide();
    }
    else if (this.value == 'partialRefund') {
        $('.Partialamount').show();
    }
});
</script>
@endpush
