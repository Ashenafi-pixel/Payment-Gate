<div class="table-responsive table-nowrap d-box p-0 border-radius-0 animated zoomIn">
    @if (Session::has('success'))
        <div id="successMessage" class="alert alert-success">
            {{ Session::get('success') }}
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>
    @endif
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
            @forelse($merchants as $merchant)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $merchant->name }}</td>
                    <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($merchant->created_at) }}</td>
                    <td>{{ $merchant->email }}</td>
                    <td>{{ $merchant->mobile_number ?? '--------' }}</td>
                    <td>
                        <span class="badge {{ \App\Helpers\GeneralHelper::USER_STATUS_CLASS($merchant->status) }}">
                            {{ \App\Helpers\GeneralHelper::STATUS_CASING($merchant->status) }}</span>
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
                                <a class="dropdown-item flex-mode"
                                    href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE . '.merchant.edit', $merchant->id) }}">
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
                                <a class="dropdown-item flex-mode"
                                    href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE . '.merchant.delete', $merchant->id) }}">
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
