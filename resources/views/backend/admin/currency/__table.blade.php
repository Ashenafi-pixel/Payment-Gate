<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    <table class="table">
        <thead class="sticky-top">
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Currency Code') }}</th>
            <th>{{ __('Currency Name') }}</th>
            <th>{{ __('Currency Symbol') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($currencies as $currency)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $currency->code ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ $currency->name }}</td>
                <td>{{ $currency->symbol }}</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-green-light flex-mode" type="button" id="action"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="material-symbols-outlined">
                                more_vert
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end animated zoomIn" aria-labelledby="action">
                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.gateway.edit.form', encrypt($currency->id)) }}">
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
