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
            @forelse($documents as $document)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ !empty($document->merchant) ? $document->merchant->name : \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                    </td>
                    <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($document->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                    </td>
                    <td>{{ !empty($document->merchant->email) ? $document->merchant->email : \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                    </td>
                    <td>{{ !empty($document->merchant->mobile_number) ? $document->merchant->mobile_number : \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                    </td>
                    <td>
                        <span
                            class="badge {{ \App\Helpers\GeneralHelper::USER_DOCUMENT_STATUS_CLASS($document->status) }}">{{ $document->status }}</span>
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
                                <a class="dropdown-item flex-mode" href="">
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>
                                    <span>{{ __('View') }}</span>
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
