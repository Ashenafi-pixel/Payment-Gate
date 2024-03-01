<div class="flex-mode gap-2  justify-content-lg-end">
    <button class="btn btn-gold flex-mode" data-bs-toggle="modal" data-bs-target="#importCustomer">
        <span class="material-symbols-outlined">
            upload
        </span>
    </button>
    <button class="btn btn-secondary flex-mode" onClick="switchView()">
        <span id="view-symbol" class="material-symbols-outlined ">
            grid_view
        </span>
    </button>
    <button class="btn btn-green flex-mode gap-2" data-bs-toggle="offcanvas" data-bs-target="#filter">
        <span class="material-symbols-outlined">
            tune
        </span>
        {{__('Filter')}}
    </button>
    <a class="btn btn-theme flex-mode gap-2"
       href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.customer.create.form') }}">
        <span class="material-symbols-outlined">
            add
        </span>
        {{ __('Add Customer') }}
    </a>
</div>
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="filter">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="Enable both scrolling & backdrop">{{ __('All Customers') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>{{ __('Use this section to filter your records') }}</p>
        <form action="">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="" class="form-label">{{ __('From') }}</label>
                    <input type="date" class="form-control form-control-lg">
                </div>
                <div class="col-12">
                    <label for="" class="form-label">{{ __('To') }}</label>
                    <input type="date" class="form-control form-control-lg">
                </div>
                <div class="col-12">
                    <label for="" class="form-label">{{ __('Status') }}</label>
                    <select class="form-select form-select-lg" name="" id="">
                        <option selected>{{ __('All') }}</option>
                        <option value="">{{ __('Approved') }}</option>
                        <option value="">{{ __('Pending') }}</option>
                        <option value="">{{ __('Declined') }}</option>
                    </select>
                </div>
                <div class="col-12 mt-4 flex-mode content-end">
                    <button type="reset" class="btn btn-danger flex-mode gap-2" data-bs-dismiss="offcanvas">
                    <span class="material-symbols-outlined">
                        close
                     </span>
                        {{ __('Cancel') }}
                    </button>
                    <button class="btn btn-green flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        filter_list
                     </span>
                        {{ __('Apply Filters') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Import Contact---->

<!-- Modal -->
<div class="modal animated zoomIn" id="importCustomer" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {!! Form::open(['url'=> route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.customers.import'),'class' => 'ajax',
                'enctype'=>"multipart/form-data",
                'method'    =>  'POST'
            ]) !!}
            <div class="modal-header">
                <h5 class="modal-title page-title" id="modalTitleId">Import Customers</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid p-0 ">
                    <div class="row">
                        <div class="col-12">
                            <label for="customer-file" class="form-label d-block mb-0 pointer">
                                <div class="file-dropzone flex-mode content-center">
                                    <div class="text-center">
                                        <img height="90" src="{{asset('images/icons/file-upload.svg')}}" alt="">
                                        <p class="sub-title file-name mt-2">{{ __('Drag n drop your files here, or click to select
                                            files') }}</p>
                                    </div>
                                </div>
                            </label>
                            {!! Form::file('import_file',['class' => 'form-control hidden custom-file-input','id'=>'customer-file']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger flex-mode gap-2" data-bs-dismiss="modal">
                        <span class="material-symbols-outlined">
                            {{ __('close') }}
                        </span>
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="btn btn-green flex-mode gap-2">
                        <span class="material-symbols-outlined">
                            upload
                        </span>
                    Upload
                </button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>

