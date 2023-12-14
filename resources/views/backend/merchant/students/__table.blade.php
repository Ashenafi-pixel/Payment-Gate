<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    <table class="table">
        <thead class="sticky-top">
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Created Date') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Phone Number') }}</th>
            <th>{{ __('Class') }}</th>
            <th>{{ __('Father Name') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($students as $student)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $student->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($student->created_at) }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->mobile_number ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ $student->class ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>{{ $student->father_name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                <td>
                    <span class="badge {{ \App\Helpers\GeneralHelper::USER_STATUS_CLASS($student->status) }}">
                        {{ \App\Helpers\GeneralHelper::STATUS_CASING($student->status) }}</span>
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
                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.student.edit.form', encrypt($student->id)) }}">
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
