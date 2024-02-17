<style>
    /* Remove border */
    input[type="text"].paragraph-like {
        border: none;
        background-color: transparent;
        padding: 0;
        font-size: inherit;
        font-family: inherit;
        outline: none;
    }
</style>
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
                <th>{{ __('Merchant Name') }}</th>
                <th>{{ __('Company Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Phone Number') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Passport') }}</th>
                <th>{{ __('License') }}</th>
                <th>{{ __('License Number') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @forelse($users   as $merchant)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $merchant->name }}</td>
                    <td>{{ $merchant->company_name }}</td>
                    <td>{{ $merchant->email }}</td>
                    <td>{{ $merchant->merchant_phone ?? '--------' }}</td>
                    <td>
                        {{ $merchant->user_status }}
                    </td>
                    <td>
                        <img src="{{ url('' . $merchant->passport) }}" style="height: 100px; width: 150px;">
                    </td>
                    ` <td>

                        <img src="{{ url('' . $merchant->license) }}" style="height: 100px; width: 150px;">
                    </td>

                    <td>
                        <form action="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE . '.checkLicense') }}"
                            method="post">
                            @csrf
                            <input type="text" name="encodedData" value="{{ $merchant->license_number }}" readonly
                                class="paragraph-like">
                            <button type="submit">Check</button>
                        </form>
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
