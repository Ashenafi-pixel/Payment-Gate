<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    <table class="table">
        <thead class="sticky-top">
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Transaction Type') }}</th>
            <th>{{ __('Create Date') }}</th>
            <th>{{ __('From Account') }}</th>
            <th>{{ __('Debit') }}</th>
            <th>{{ __('Credit') }}</th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Transaction ID') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($ledger_details as $ledger)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ \App\Helpers\GeneralHelper::STATUS_CASING($ledger->transactionType->name) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($ledger->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</td>
                <td>{{ $ledger->transactionDetail->from_account ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ $ledger->debit ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ $ledger->credit ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ \App\Helpers\GeneralHelper::TRANSACTION_TYPE($ledger->type) }}</td>
                <td>{{ $ledger->trx_id ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>
                    <span class="badge {{ \App\Helpers\GeneralHelper::TRANSACTION_STATUS(strtoupper($ledger->status)) }}">
                        {{ $ledger->status }}
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
