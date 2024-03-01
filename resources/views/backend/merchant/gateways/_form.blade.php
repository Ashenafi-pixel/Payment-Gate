<div class="col-12 mt-3">
    <div class="d-box">
        {!! Form::model($gateway ?? null, [
                        'class'   => 'ajax',
                        'method'  => 'POST',
                        'enctype' => 'multimedia/form-part',
                        'url'     => route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.gateway.install',encrypt($gateway->id))
                ]) !!}
        <div class="row gy-3">
            <div class="row gy-3">
                <div class="col-md-6">
                    {!! Form::label('name',__('Name'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::text('name',$gateway->name ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => 'Visa Master Card',
                    'disabled'   =>  true,
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('currency_name',__('Currency Name'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::text('currency_name',$gateway->currency_name ?? null,
                    ['class' => 'form-control',
                    'id' => '','placeholder' => 'PKR',
                    'disabled'   =>  true,
                    'autofocus' => true])
                    !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('gateway_logo_file',__('Gateway Logo'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::file('gateway_logo',['class' => 'form-control form-control-lg','readonly'=>true,'disabled'=>true,'id' => 'gateway_logo_file','accept' => 'image/*']) !!}
                    <img src="{{asset($gateway->image->url)}}" alt="img" class="image-thumbnail mt-4" width="50">
                </div>
                <div class="col-md-6">
                    {!! Form::label('status',__('Select Status'),
                    ['class' => 'form-label bold'])
                    !!}
                    {!! Form::select('status', [\App\Helpers\IUserStatuses::GATEWAY_ACTIVE_STATUS => \App\Helpers\IUserStatuses::USER_ACTIVE, \App\Helpers\IUserStatuses::GATEWAY_INACTIVE_STATUS => \App\Helpers\IUserStatuses::NON_ACTIVE], !empty($gateway->merchantGateway) && $gateway->merchantGateway->status == \App\Helpers\IUserStatuses::GATEWAY_ACTIVE_STATUS ? \App\Helpers\IUserStatuses::GATEWAY_ACTIVE_STATUS : (!empty($gateway->merchantGateway) && $gateway->merchantGateway->status == \App\Helpers\IUserStatuses::GATEWAY_INACTIVE_STATUS ? \App\Helpers\IUserStatuses::GATEWAY_INACTIVE_STATUS : 0) ,
                    ['class'=>"form-control" ,'required'=>false]) !!}
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
                            {{ __('Install Gateway') }}
                        </div>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
