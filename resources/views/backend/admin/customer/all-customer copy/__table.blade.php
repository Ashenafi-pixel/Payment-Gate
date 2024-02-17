<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    <table class="table">
        <thead class="sticky-top">
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Created Date') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Phone Number') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($customers as $customer)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $customer->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($customer->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</td>
                <td>{{ $customer->email ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ $customer->mobile_number ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>
                    <span
                            class="badge {{ \App\Helpers\GeneralHelper::USER_STATUS_CLASS($customer->status) }}">{{ \App\Helpers\GeneralHelper::STATUS_CASING($customer->status) }}</span>
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
                            <a class="dropdown-item flex-mode" href="#">
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
