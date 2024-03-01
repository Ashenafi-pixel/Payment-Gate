<div class="row g-4">
    @php
        $i = 1;
    @endphp
    @forelse($invoices as $invoice)
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
                        $invoice->student->name : $invoice->customer->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Created Date') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::FORMAT_DATE($invoice->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Amount') }}</p>
                    <p class="flex-text"><b>ብር.</b>{{ $invoice->amount }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Email') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? $invoice->student->email : $invoice->customer->email ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Phone') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? $invoice->student->mobile_number : $invoice->customer->mobile_number ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Status') }}</p>
                    <p class="flex-text">
                        <span
                            class="badge {{ \App\Helpers\GeneralHelper::INVOICE_STATUS_CLASS($invoice->status) }}">{{ \App\Helpers\GeneralHelper::INVOICE_STATUS($invoice->status) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</span>
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
                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.pay', encrypt($invoice->id)) }}" target="_blank">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                                <span>{{ __('Pay') }}</span>
                            </a>
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
