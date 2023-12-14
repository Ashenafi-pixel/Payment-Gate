<div class="tab-pane animated zoomIn" id="set-pin">
    {!! Form::model($user ?? null,['url' => isset($user->pin_code)
                ? route(\App\Helpers\GeneralHelper::WHO_AM_I().'.profile.reset.pin')
                : route(\App\Helpers\GeneralHelper::WHO_AM_I().'.profile.set.pin'),
            'class' => 'ajax']) !!}

    <div class="row gy-3">
        <div class="col-lg-12">
            @if(isset($user->pin_code))
                {!! Form::label('','Your pin is already set, You can Reset ! ') !!}
                <br>
                <div class="col-lg-6">
                    <div class="form-floating">
                        {!! Form::text('old_pin',null,['class'=>'form-control','id'=>'pin-code','placeholder'=>'XXXX']) !!}
                        {!! Form::label('','OLD PIN') !!}
                    </div>
                </div>
                <br>
            <div class="col-lg-6">
                <div class="form-floating">
                    {!! Form::text('pin',null,['class'=>'form-control','id'=>'pin-code','placeholder'=>'XXXX']) !!}
                    {!! Form::label('','NEW PIN') !!}
                </div>
            </div>
            @else
                <div class="col-lg-6">
                    <div class="form-floating">
                        {!! Form::text('pin',null,['class'=>'form-control','id'=>'pin-code','placeholder'=>'XXXX']) !!}
                        {!! Form::label('','PIN') !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row gy-3">
        <div class="col-6 text-end">
            <br>
            <button type="submit" class="btn btn-theme">
                @if(isset($user->pin_code))
                <div class="flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        update
                    </span>
                    {{__('RESET PIN')}}
                </div>
                @else
                    <div class="flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        update
                    </span>
                        {{__('SET PIN')}}
                    </div>
                @endif
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
