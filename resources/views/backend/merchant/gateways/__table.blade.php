<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    <table class="table">
        <thead class="sticky-top">
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Created Date') }}</th>
            <th>{{ __('Currency Name') }}</th>
            <th>{{ __('Logo') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($gateways as $gateway)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $gateway->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($gateway->created_at) }}</td>
                <td>{{ $gateway->currency_name }}</td>
                <td>@if(!empty($gateway->image->url))
                        <img width="50" src="{{asset($gateway->image->url)}}" alt="">
                    @endif
                </td>
                <td>
                    <span class="badge {{ (!empty($gateway->merchantGateway) && $gateway->merchantGateway->status == \App\Helpers\IUserStatuses::GATEWAY_ACTIVE_STATUS) ? \App\Helpers\GeneralHelper::INVOICE_STATUS_CLASS($gateway->merchantGateway->status) : \App\Helpers\GeneralHelper::INVOICE_STATUS_CLASS(\App\Helpers\IUserStatuses::GATEWAY_INACTIVE_STATUS) }}">
                        {{ (!empty($gateway->merchantGateway) && $gateway->merchantGateway->status == \App\Helpers\IUserStatuses::GATEWAY_ACTIVE_STATUS) ? \App\Helpers\GeneralHelper::INVOICE_STATUS($gateway->merchantGateway->status) : \App\Helpers\GeneralHelper::INVOICE_STATUS(\App\Helpers\IUserStatuses::GATEWAY_INACTIVE_STATUS) }}</span>
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
                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.gateway.install.form', encrypt($gateway->id)) }}">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                                <span>{{ __('Edit') }}</span>
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
