<div class="row g-4">
    @php
        $i = 1;
    @endphp
    @forelse($allTransactions as $allTransaction)
        <div class="col-md-6 col-lg-4 animated zoomIn">
            <div class="d-box position-relative">
                <div class="ribbon down">
                    <div class="content">
                        <h4 class="page-title ">{{ $i++ }}</h4>
                    </div>
                </div>
                <div class="flex-mode mt-5 justify-content-between">
                    <p class="flex-heading">{{ __('Name') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ?
                        $allTransaction->student->name : $allTransaction->customer->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Created Date') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::FORMAT_DATE($allTransaction->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Debit') }}</p>
                    <p class="flex-text"><b>ብር.</b>{{ $allTransaction->debit }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Credit') }}</p>
                    <p class="flex-text"><b>ብር.</b>{{ $allTransaction->credit }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Type') }}</p>
                    <p class="flex-text">{{ $allTransaction->transactionType->name }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Commission') }}</p>
                    <p class="flex-text">{{ $allTransaction->addispay_commission }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Trx_id') }}</p>
                    <p class="flex-text">{{ $allTransaction->trx_id }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Date') }}</p>
                    <p class="flex-text"><span class="badge btn-secondary">
                            {{ \App\Helpers\GeneralHelper::FORMAT_DATE($allTransaction->created_at) }}
                        </span></p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Status') }}</p>
                    <p class="flex-text">
                        <span
                            class="badge {{ \App\Helpers\GeneralHelper::TRANSACTION_STATUS(strtoupper($allTransaction->status)) }}">
                        {{ $allTransaction->status }}</span>
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
                                <span class="material-symbols-outlined">
                                    visibility
                                </span>
                                <span> View</span>
                            </a>
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                                <span>Edit</span>
                            </a>
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                   settings
                                </span>
                                <span> Setting</span>
                            </a>
{{--                            <a class="dropdown-item flex-mode"--}}
{{--                               href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.pay', encrypt($invoice->id)) }}"--}}
{{--                               target="_blank">--}}
{{--                                <span class="material-symbols-outlined">--}}
{{--                                    edit_note--}}
{{--                                </span>--}}
{{--                                <span>{{ __('Pay') }}</span>--}}
{{--                            </a>--}}
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                  delete
                                </span>
                                <span> Delete</span>
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
