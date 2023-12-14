<div class="tab-pane animated zoomIn active" id="profile-setting">
    {!! Form::model($user,
        ['url' => route(\App\Helpers\GeneralHelper::WHO_AM_I().'.profile.update'),'class' => 'ajax','enctype'=>'multimedia/form-part']
        ) !!}
    <div class="row gy-3">
        <div class="col-lg-6 order-lg-2 my-auto">
            <div class="text-center">
                {!! Form::file('profile_image',['class' => 'd-none','id' => 'imgInp','hidden' => true]) !!}
                <label for="imgInp" class="position-relative">
                    <img class="profile-img" id="blah"
                         src="{{auth()->user()->image->url ? asset($user->image->url) :  asset('images/user-img.png')}}" alt="">
                    <div class="upload-img">
                        <img width="18" src="{{asset('images/icons/edit-square.svg')}}" alt="">
                    </div>
                </label>
            </div>
        </div>
        <div class="col-lg-6 order-lg-1">
            <div class="form-floating mb-2">
                <span class="form-control">{{__($user->username)}}</span>
                {!! Form::label('username',__('Username')) !!}
            </div>
            <div class="form-floating mb-2">
                {!! Form::text('name',null,['class'=>'form-control','id'=>'fullname','placeholder'=>'John Doe']) !!}
                {!! Form::label(__('name'),__('Full Name')) !!}
            </div>
            <div class="form-floating mb-2">
                <span class="form-control">{{ __($user->email) }}</span>
                {!! Form::label('email',__('Email')) !!}
            </div>
            <div class="form-floating">
                {!! Form::number('mobile_number',null,['class' => 'form-control','id' => 'phone','placeholder' => '+219-X-XXX-XXXX']) !!}
                {!! Form::label('mobile_number',__('Phone Number')) !!}
            </div>
        </div>
        <div class="col-12 order-last text-end">
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
                   {{__('Update')}}
                </div>
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
