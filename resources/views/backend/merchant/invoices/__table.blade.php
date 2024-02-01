<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    <table class="table">
        <thead class="sticky-top">
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Request ID') }}</th>
            <th>{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? __('Student Name') : __('Customer Name') }}</th>
            <th>{{ __('Created Date') }}</th>
            <th>{{ __('Amount') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Phone Number') }}</th>
            <th>{{ __('Request Status') }}</th>
            <th>{{ __('Transaction Status') }}</th>
            <th>{{ __('Refund') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($invoices as $invoice)
            <tr>
                <td>{{ $i++ }}</td>
                <td>AD{{ str_pad($invoice->id,'5','0',STR_PAD_LEFT) }}</td>
                <td>
                    {{ \App\Helpers\GeneralHelper::IS_SCHOOL() ?
                        $invoice->student->name : $invoice->customer->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                </td>
                <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($invoice->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</td>
                <td><b>ብር.</b>{{ $invoice->amount }}</td>
                <td>{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? $invoice->student->email : $invoice->customer->email ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                    <td>{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? $invoice->student->mobile_number : $invoice->customer->mobile_number ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>
                    <span
                        class="badge {{ \App\Helpers\GeneralHelper::INVOICE_STATUS_CLASS($invoice->status) }}">{{ \App\Helpers\GeneralHelper::INVOICE_STATUS($invoice->status) }}</span>
                </td>
                <td>
                    <span
                        class="badge {{ \App\Helpers\GeneralHelper::TRANSACTION_STATUS(isset($invoice->invoiceTransaction) ? strtoupper($invoice->invoiceTransaction->status) : "") }}">
                        {{ isset($invoice->invoiceTransaction) ? $invoice->invoiceTransaction->status : ucfirst(strtolower(\App\Helpers\IStatuses::TRANSACTION_PENDING)) }}</span>
                </td>
                <td>
                    {{ isset($invoice->invoiceTransaction) && $invoice->invoiceTransaction()->latest()->first()->is_refund == true ? 'Refunded' : 'N/A' }}
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
                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoice.view', encrypt($invoice->id)) }}">
                                <span class="material-symbols-outlined">
                                    visibility
                                </span>
                                <span>{{ __('View') }}</span>
                            </a>
{{--                            <a class="dropdown-item flex-mode" href="">--}}
{{--                                <span class="material-symbols-outlined">--}}
{{--                                    edit_note--}}
{{--                                </span>--}}
{{--                                <span>{{ __('Edit') }}</span>--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item flex-mode" href="#">--}}
{{--                                <span class="material-symbols-outlined">--}}
{{--                                   settings--}}
{{--                                </span>--}}
{{--                                <span>{{ __('Setting') }}</span>--}}
{{--                            </a>--}}
                            @if($invoice->status == false)
                                <a href="javascript:void(0)" class="dropdown-item flex-mode">
                                    <span class="material-symbols-outlined">
                                    paid
                                </span>
                                    <span>{{ __('Paid') }}</span>
                                </a>
                            @else
                                <a class="dropdown-item flex-mode"
                                   href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.pay', encrypt($invoice->id)) }}"
                                   target="_blank">
                                <span class="material-symbols-outlined">
                                    pending
                                </span>
                                    <span>{{ __('Pay') }}</span>
                                </a>
                            @endif
{{--                            <a class="dropdown-item flex-mode" href="#">--}}
{{--                                <span class="material-symbols-outlined">--}}
{{--                                  delete--}}
{{--                                </span>--}}
{{--                                <span>{{ __('Delete') }}</span>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            @include('backend.partials.no-table-data')
        @endforelse
        </tbody>
    </table>
</div>
