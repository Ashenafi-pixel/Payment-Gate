<div class="tab-pane animated zoomIn active" id="upload-document">
    {!! Form::model(null,
          ['url' => route(\App\Helpers\GeneralHelper::WHO_AM_I().'.store.approval.documents'),'class' => 'ajax','enctype'=>'multimedia/form-part']
          ) !!}
        <div class="row gy-3">
                <div class="col-lg-6">
                    @if(!empty($documents) && $documents->cnic_doc_status == \App\Helpers\IStatuses::APPROVED)
                        <label class="form-label input-label">{{__('CNIC')}}</label>
                        <div class="position-relative">
                            <label for="cnic_file" class="btn btn-green">{{__(\App\Helpers\IStatuses::APPROVED)}}</label>
                        </div>
                    @else
                        <label class="form-label input-label">{{__('Choose CNIC')}}</label>
                        <div class="position-relative">
                            {!! Form::file('cnic',['class' => 'form-control form-control-lg this','id' => 'cnic_file','accept' => 'application/pdf,image/*']) !!}
                            <label for="cnic_file" class="btn btn-green">{{__('Choose')}}</label>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    @if(!empty($documents) && $documents->license_doc_status == \App\Helpers\IStatuses::APPROVED)
                        <label class="form-label input-label">{{__('License')}}</label>
                        <div class="position-relative">
                            <label for="license_file" class="btn btn-green">{{__(\App\Helpers\IStatuses::APPROVED)}}</label>
                        </div>
                    @else
                        <label class="form-label input-label">{{__('Choose License')}}</label>
                        <div class="position-relative">
                            {!! Form::file('license',['class' => 'form-control form-control-lg this','id' => 'license_file','accept' => 'application/pdf,image/*']) !!}
                            <label for="license_file" class="btn btn-green">{{__('Choose')}}</label>
                        </div>
                    @endif
                </div>
            @if(\App\Helpers\GeneralHelper::USER()->is_school == \App\Helpers\IUserStatuses::IS_SCHOOL)
                <div class="col-lg-6">
                    @if(!empty($documents) && $documents->registration_form_doc_status == \App\Helpers\IStatuses::APPROVED)
                        <label class="form-label input-label">{{__('Registration Form')}}</label>
                        <div class="position-relative">
                            <label for="registration_form" class="btn btn-green">{{__(\App\Helpers\IStatuses::APPROVED)}}</label>
                        </div>
                    @else
                        <label class="form-label input-label">{{__('Choose School Registration Form')}}</label>
                        <div class="position-relative">
                            {!! Form::file('registration_form',['class' => 'form-control form-control-lg this','id' => 'registration_form','accept' => 'application/pdf,image/*']) !!}
                            <label for="registration_form" class="btn btn-green">{{__('Choose')}}</label>
                        </div>
                    @endif
                </div>
            @endif
            <div class="col-12 mt-4 text-end">
                {!! Form::submit('Upload Documents',['class'=>'btn btn-theme']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
