<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    <table class="table">
        <thead class="sticky-top">
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? __('Student Name') : __('Customer Name') }}</th>
            <th>{{ __('Debit') }}</th>
            <th>{{ __('Credit') }}</th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Commission') }}</th>
            <th>{{ __('Trx_id') }}</th>
            <th>{{ __('Transaction Status') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($allTransactions as $allTransaction)
            <tr>
                <td>{{ $i++ }}</td>
                <td>
                    {{ \App\Helpers\GeneralHelper::IS_SCHOOL() ?
                        $allTransaction->student->name : $allTransaction->customer->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                </td>
                <td><b>ብር.</b>{{ $allTransaction->debit }}</td>
                <td><b>ብር.</b>{{ $allTransaction->credit }}</td>
                <td>{{ $allTransaction->transactionType->name }}</td>
                <td>{{ $allTransaction->addispay_commission }}</td>
                <td>{{ $allTransaction->trx_id }}</td>
                <td>
                    <span
                        class="badge {{ \App\Helpers\GeneralHelper::TRANSACTION_STATUS(strtoupper($allTransaction->status)) }}">
                        {{ $allTransaction->status }}</span>
                </td>
                <td><span class="badge btn-secondary">
                        {{ \App\Helpers\GeneralHelper::FORMAT_DATE($allTransaction->created_at) }}
                    </span>
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
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                    visibility
                                </span>
                                <span>{{ __('View') }}</span>
                            </a>
                            <a class="dropdown-item flex-mode" href="">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                                <span>{{ __('Edit') }}</span>
                            </a>
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                   settings
                                </span>
                                <span>{{ __('Setting') }}</span>
                            </a>
{{--                            @if($allTransaction->status == false)--}}
{{--                                <a href="javascript:void(0)" class="dropdown-item flex-mode">--}}
{{--                                    <span class="material-symbols-outlined">--}}
{{--                                    paid--}}
{{--                                </span>--}}
{{--                                    <span>{{ __('Paid') }}</span>--}}
{{--                                </a>--}}
{{--                            @else--}}
{{--                                <a class="dropdown-item flex-mode"--}}
{{--                                   href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.pay', encrypt($invoice->id)) }}"--}}
{{--                                   target="_blank">--}}
{{--                                <span class="material-symbols-outlined">--}}
{{--                                    pending--}}
{{--                                </span>--}}
{{--                                    <span>{{ __('Pay') }}</span>--}}
{{--                                </a>--}}
{{--                            @endif--}}
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                  delete
                                </span>
                                <span>{{ __('Delete') }}</span>
                            </a>
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
