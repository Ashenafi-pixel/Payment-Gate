<div class="col-12 mt-3">
    <div class="d-box">
        {!! Form::model($student ?? null, [
                        'class' => 'ajax',
                        'method' => isset($student) ? 'put' : 'post',
                        'url' => isset($student)
                        ? route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.student.update',encrypt($student->id))
                        : route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.student.create')
                ]) !!}
        <div class="row gy-3">
            <div class="row gy-3">
                <div class="col-md-6">
                    {!! Form::label('name',__('Name'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::text('name',$student->name ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => 'John Doe',
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('email',__('Email'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::email('email',$student->email ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => 'johndoe@gmail.com',
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('mobile_number',__('Phone'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::number('mobile_number',$student->mobile_number ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => '+251-YY-XXX-XXXX',
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('address',__('Address'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::text('address',$student->address ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => '134A Block',
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('father_name',__('Father Name'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::text('father_name',$student->father_name ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => 'John Doe',
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('class',__('Class'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::text('class',$student->class ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => '10',
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('section',__('Section'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::text('section',$student->section ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => 'B Section',
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('status',__('Select Status'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::select('status', [\App\Helpers\IUserStatuses::USER_ACTIVE => \App\Helpers\IUserStatuses::USER_ACTIVE, \App\Helpers\IUserStatuses::NON_ACTIVE => \App\Helpers\IUserStatuses::USER_NON_ACTIVE], null ,
                    ['class'=>"form-control", !empty($student) && !empty($student->status == \App\Helpers\IUserStatuses::NON_ACTIVE) ? 'selected' : null ,'required'=>false]) !!}
                </div>
            <div class="col-12 mt-4 text-end">
                <a href="{{ url()->previous() }}" type="reset" class="btn btn-danger me-3">
                    <div class="flex-mode gap-2">
                            <span class="material-symbols-outlined">
                                close
                            </span>
                        {{ __('Back') }}
                    </div>
                </a>
                <button type="submit" class="btn btn-green">
                    <div class="flex-mode gap-2">
                            <span class="material-symbols-outlined">
                                save
                            </span>
                        {{ __('Save') }}
                    </div>
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
