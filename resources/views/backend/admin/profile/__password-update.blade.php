<div class="tab-pane animated zoomIn" id="change-password">
    {!! Form::model($user,['url' => route(\App\Helpers\GeneralHelper::WHO_AM_I().'.profile.change.password'),
            'class' => 'ajax']) !!}
    <div class="row gy-3">
        <div class="col-12">
            <div class="form-floating">
                {!! Form::password('old_password',['class' => 'form-control','id' => 'current','placeholder' => 'Current Password']) !!}
                {!! Form::label('current_password','Current Password') !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-floating">
                {!! Form::password('password',['class' => 'form-control','id' => 'current','placeholder' => 'New Password']) !!}
                {!! Form::label('password','New Password') !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-floating">
                {!! Form::password('password_confirmation',['class' => 'form-control','id' => 'current','placeholder' => 'New Password']) !!}
                {!! Form::label('password_confirmation','Confirm Password') !!}
            </div>
        </div>
        <div class="col-12 text-end">
            <button type="reset" class="btn btn-danger me-2">
                <div class="flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                    {{__('Cancel')}}
                </div>
            </button>
            <button type="submit" class="btn btn-theme">
                <div class="flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        update
                    </span>
                   {{__('Update Password')}}
                </div>
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
