<div class="row g-4">
    @php
        $i = 1;
    @endphp
    @forelse($students as $student)
        <div class="col-md-6 col-lg-4 animated zoomIn">
            <div class="d-box position-relative">
                <div class="ribbon down">
                    <div class="content">
                        <h4 class="page-title ">{{ $i++ }}</h4>
                    </div>
                </div>
                <div class="flex-mode mt-5 justify-content-between">
                    <p class="flex-heading">{{ __('Name') }}</p>
                    <p class="flex-text">{{ $student->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Created Date') }}</p>
                    <p class="flex-text">{{ \App\Helpers\GeneralHelper::FORMAT_DATE($student->created_at) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Email') }}</p>
                    <p class="flex-text">{{ $student->email ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Phone') }}</p>
                    <p class="flex-text">{{ $student->mobile_number ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Class') }}</p>
                    <p class="flex-text">{{ $student->class ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Father Name') }}</p>
                    <p class="flex-text">{{ $student->father_name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Status') }}</p>
                    <p class="flex-text">
                        <span
                            class="badge {{ \App\Helpers\GeneralHelper::USER_STATUS_CLASS($student->status) }}">{{ \App\Helpers\GeneralHelper::STATUS_CASING( $student->status) ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</span>
                    </p>
                </div>
                <hr>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading my-auto">Action</p>
                    <p class="flex-text text-end">
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
                                <span> View</span>
                            </a>
                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.student.edit.form', encrypt($student->id)) }}">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                                <span>Edit</span>
                            </a>
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                   settings
                                </span>
                                <span> Setting</span>
                            </a>
                            <a class="dropdown-item flex-mode" href="#">
                                <span class="material-symbols-outlined">
                                  delete
                                </span>
                                <span> Delete</span>
                            </a>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    @empty
        @include('backend.partials.no-table-data')
    @endforelse
</div>
