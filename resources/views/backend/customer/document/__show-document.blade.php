<div class="tab-pane animated zoomIn " id="view-document">
    @if(isset($documents))

        <div class="row gy-4">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="page-title mb-0">{{ __('CNIC') }}</h3>
                    </div>
                    @if(pathinfo($documents->cnic_doc, PATHINFO_EXTENSION) == \App\Helpers\IDocTypes::PDF)
                        <div class="card-body p-0 mh-185">
                            <iframe width="100%" height="185" src="{{asset($documents->cnic_doc)}}"
                                    frameborder="0"></iframe>
                        </div>
                    @else
                        <div class="card-body p-0 mh-185">
                            <img class="img-fluid w-100" src="{{asset($documents->cnic_doc)}}" alt="">
                        </div>
                    @endif
                    <div class="card-footer text-end p-2">
                        <div class="d-flex justify-content-between">
                            <span
                                class="badge {{ \App\Helpers\GeneralHelper::USER_DOCUMENT_STATUS_CLASS($documents->cnic_doc_status) }}">
                                {{ __($documents->cnic_doc_status) }}
                            </span>
{{--                            <button class="btn btn-secondary p-1" >--}}
{{--                                <span class="material-symbols-outlined f-14">--}}
{{--                                    edit_document--}}
{{--                                </span>--}}
{{--                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="page-title mb-0">{{ __('LICENSE') }}</h3>
                    </div>
                    @if(pathinfo($documents->license_doc, PATHINFO_EXTENSION) == \App\Helpers\IDocTypes::PDF)
                        <div class="card-body p-0 mh-185">
                            <iframe width="100%" height="185" src="{{asset($documents->license_doc)}}"
                                    frameborder="0"></iframe>
                        </div>
                    @else
                        <div class="card-body p-0 mh-185">
                            <img class="img-fluid w-100" src="{{asset($documents->license_doc)}}" alt="">
                        </div>
                    @endif
                    <div class="card-footer text-end p-2">
                        <div class="d-flex justify-content-between">
                            <span
                                class="badge {{ \App\Helpers\GeneralHelper::USER_DOCUMENT_STATUS_CLASS($documents->license_doc_status) }}">
                                {{ $documents->license_doc_status }}
                            </span>
{{--                            <button class="btn btn-secondary p-1">--}}
{{--                                <span class="material-symbols-outlined f-14">--}}
{{--                                    edit_document--}}
{{--                                </span>--}}
{{--                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="row min-height-60">
        <div class="col-12 d-flex align-items-center justify-content-center ">
            <div>
                <img src="{{asset('images/no-data-found.png')}}" alt="">
                <h3 class="page-title mt-3">{{ __('No Document Found') }}</h3>
            </div>
        </div>
    </div>
    @endif
</div>
