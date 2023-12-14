<div class="row g-4">
    @php
        $i = 1;
    @endphp
    @forelse($allTransactions as $ledger)
        <div class="col-md-6 col-lg-4 animated zoomIn">
            <div class="d-box position-relative">
                <div class="ribbon down">
                    <div class="content">
                        <h4 class="page-title ">{{ $i++ }}</h4>
                    </div>
                </div>
                <div class="flex-mode mt-5 justify-content-between">
                    <p class="flex-heading">{{ __('Customer Name') }}</p>
                    <p class="flex-text">{{ !empty($ledger->customer) ? $ledger->customer->name : \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Transaction Type') }}</p>
                    <p class="flex-text">{{ !empty($ledger->transactionType) ? \App\Helpers\GeneralHelper::STATUS_CASING($ledger->transactionType->name) : \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Created Date') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::FORMAT_DATE($ledger->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('From Account') }}</p>
                    <p class="flex-text">{{ $ledger->transactionDetail->from_account ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Debit') }}</p>
                    <p class="flex-text">{{ $ledger->debit ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Credit') }}</p>
                    <p class="flex-text">{{ $ledger->credit ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Type') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::TRANSACTION_TYPE($ledger->type) }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Transaction ID') }}</p>
                    <p class="flex-text">{{ $ledger->trx_id ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Status') }}</p>
                    <p class="flex-text">
                        <span
                            class="badge {{ \App\Helpers\GeneralHelper::TRANSACTION_STATUS(strtoupper($ledger->status)) }}">{{ $ledger->status ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</span>
                    </p>
                </div>
                <hr>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading my-auto">Action</p>
                    <p class="flex-text text-end">
                    <div class="btn-group">
                        <button class="btn btn-green-light flex-mode" type="button" id="action"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="material-symbols-outlined">
                                more_vert
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end animated zoomIn" aria-labelledby="action">
                            <a class="dropdown-item flex-mode" href="#">

                            </a>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    @empty
        @include('backend.partials.no-table-data')
    @endforelse
</div>
