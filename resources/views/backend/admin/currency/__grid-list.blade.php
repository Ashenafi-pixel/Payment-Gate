<div class="row g-4">
    @php
        $i = 1;
    @endphp
    @forelse($currencies as $currency)
        <div class="col-md-6 col-lg-4 animated zoomIn">
            <div class="d-box position-relative">
                <div class="ribbon down">
                    <div class="content">
                        <h4 class="page-title ">{{ $i++ }}</h4>
                    </div>
                </div>
                <div class="flex-mode mt-5 justify-content-between">
                    <p class="flex-heading">{{ __('Currency Code') }}</p>
                    <p class="flex-text">{{ $currency->code ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Currency Name') }}</p>
                    <p class="flex-text">{{ $currency->name }}</p>
                </div>
                <div class="flex-mode justify-content-between">
                    <p class="flex-heading">{{ __('Currency Symbol') }}</p>
                    <p class="flex-text">{{ $currency->symbol }}</p>
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
                            <a class="dropdown-item flex-mode" href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.gateway.edit.form', encrypt($currency->id)) }}">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                                <span>Edit</span>
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
