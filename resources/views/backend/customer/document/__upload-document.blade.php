<div class="tab-pane animated zoomIn active" id="upload-document">
    {!! Form::model(null,['url' => route(\App\Helpers\IUserRole::CUSTOMER_ROLE.'.store.document'),'class' => 'ajax','enctype'=>'multimedia/form-part']) !!}
        <div class="row gy-3">
            <div class="col-lg-6">
                <label class="form-label input-label">{{__('Choose CNIC')}}</label>
                <div class="position-relative">
                    @if(isset($documents) && $documents->cnic_doc_status == \App\Helpers\IStatuses::APPROVED)
                        <span class="badge badge-success">
                            {{ $documents->cnic_doc_status }}
                        </span>
                    @else
                        {!! Form::file('cnic',['class' => 'form-control form-control-lg this','id' => 'cnic_file','accept' => 'application/pdf,image/*']) !!}
                        <label for="cnic_file" class="btn btn-green">{{__('Choose')}}</label>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <label class="form-label input-label">{{__('Choose License')}}</label>
                <div class="position-relative">
                    @if(isset($documents) && $documents->license_doc_status == \App\Helpers\IStatuses::APPROVED)
                        <span class="badge badge-success">
                            {{ $documents->license_doc_status }}
                        </span>
                    @else
                        {!! Form::file('license',['class' => 'form-control form-control-lg this','id' => 'license_file','accept' => 'application/pdf,image/*']) !!}
                        <label for="license_file" class="btn btn-green">{{__('Choose')}}</label>
                    @endif
                </div>
            </div>
            <div class="col-12 mt-4 text-end">
                {!! Form::button('Upload Documents',['type' => 'submit','class'=>'btn btn-theme-effect']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
