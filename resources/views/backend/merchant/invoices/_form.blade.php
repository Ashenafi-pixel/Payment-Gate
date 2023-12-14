<div class="col-12 mt-3">
    <div class="d-box">
        {!! Form::open(['url' => route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.save'),'class' => 'requestform']) !!}
        <div class="row gy-3">
            <div class="col-12">
                {!! Form::label('select', \App\Helpers\GeneralHelper::IS_SCHOOL() ? __('Select Student') : __('Select Customer'),
                ['class' => 'form-label bold'])
                !!}
                <div class="parent" id="selec2-parent">
                    <select name="customer" data-placeholder="{{ \App\Helpers\GeneralHelper::IS_SCHOOL() ? 'Select a student' : 'Select a customer' }}"
                            class="form-control selectpiker customer" id="select">
                        <option value="">Select</option>
                        @forelse($customers as $customer)
                            <option value="{{ encrypt($customer['id']) }}" data-customer="{{ $customer }}">
                                {{ $customer['name']}}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('purpose',__('Purpose'),
                ['class' => 'form-label bold'])
                !!}
                {!! Form::text('purpose',null,
                ['class' => 'form-control',
                'id' => '','placeholder' => 'e.g Credit',
                'autofocus' => true])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('amount',__('Amount'),
                ['class' => 'form-label bold'])
                !!}
                {!! Form::number('amount',null,
                ['class' => 'form-control',
                'id' => '','placeholder' => '300',
                'autofocus' => true])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('name',__('Name'),
                ['class' => 'form-label bold'])
                !!}
                {!! Form::text('name','',
                ['class' => 'form-control','readonly' => true,
                'id' => 'name','placeholder' => 'John Doe',
                'autofocus' => true])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('phone',__('Phone'),
                ['class' => 'form-label bold'])
                !!}
                {!! Form::number('phone','',
                ['class' => 'form-control','readonly' => true,
                'id' => 'phone','placeholder' => '+251-YY-XXX-XXXX',
                'autofocus' => true])
                !!}
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
