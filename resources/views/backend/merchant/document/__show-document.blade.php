<div class="tab-pane animated zoomIn " id="view-document">
    @if(!empty($documents))
        <form action="">
            <div class="row gy-4">
                {{--CNIC--}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class="page-title mb-0">{!! __('CNIC') !!}</h3>
                        </div>
                        @if(pathinfo($documents->cnic_doc)['extension'] == 'pdf')
                            <div class="card-body p-0 mh-185">
                                <iframe width="100%" height="185" src="{{$documents->cnic_doc}}"
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
                            </div>
                        </div>
                    </div>
                </div>

                {{--license--}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class="page-title mb-0">{!! __('License') !!}</h3>
                        </div>
                        @if(pathinfo($documents->license_doc)['extension'] == \App\Helpers\IDocTypes::PDF)
                            <div class="card-body p-0 mh-185">
                                <iframe width="100%" height="185" src="{{$documents->license_doc}}"
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
                                    {{ __($documents->license_doc_status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Registration Form--}}
                @if(!empty($documents->registration_form_doc))
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3 class="page-title mb-0">{!! __('Registration Form') !!}</h3>
                            </div>
                            @if(pathinfo($documents->registration_form_doc)['extension'] == \App\Helpers\IDocTypes::PDF)
                                <div class="card-body p-0 mh-185">
                                    <iframe width="100%" height="185" src="{{$documents->registration_form_doc}}"
                                            frameborder="0"></iframe>
                                </div>
                            @else
                                <div class="card-body p-0 mh-185">
                                    <img class="img-fluid w-100" src="{{asset($documents->registration_form_doc)}}"
                                         alt="">
                                </div>
                            @endif

                            <div class="card-footer text-end p-2">
                                <div class="d-flex justify-content-between">
                                    <span
                                        class="badge {{\App\Helpers\GeneralHelper::USER_DOCUMENT_STATUS_CLASS($documents->registration_form_doc_status)}}">
                                        {{ __($documents->registration_form_doc_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    @endif
</div>
