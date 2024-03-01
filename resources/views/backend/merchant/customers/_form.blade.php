<div class="col-12 mt-3">
    <div class="d-box">
        {!! Form::model($customer ?? null, [
            'url' => isset($customer)
                ? route(\App\Helpers\IUserRole::MERCHANT_ROLE . '.customer.update', ['customer_id' => encrypt($customer->id)])
                : route(\App\Helpers\IUserRole::MERCHANT_ROLE . '.customer.create'),
            'class' => 'ajax',
        ]) !!}
        <div class="row gy-3">
            <div class="col-md-6">
                {!! Form::label('name', __('Name'), ['class' => 'form-label bold']) !!}
                {!! Form::text('name', $customer->name ?? null, [
                    'class' => 'form-control',
                    'id' => '',
                    'placeholder' => __('Name'),
                    'autofocus' => true,
                ]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('email', __('Email'), ['class' => 'form-label bold']) !!}
                {!! Form::email('email', $customer->email ?? null, [
                    'class' => 'form-control',
                    'id' => '',
                    'placeholder' => __('Email'),
                    'autofocus' => true,
                ]) !!}
            </div>
            <div class="col-md-6">
    {!! Form::label('phone', __('Phone'), ['class' => 'form-label bold']) !!}
    {!! Form::tel('mobile_number', $customer->mobile_number ?? null, [
        'class' => 'form-control',
        'id' => 'phone',
        'maxlength' => '13',
        'placeholder' => '+2519XXXXXXXXX',
        'pattern' => '^(\+2519)[0-9]{8}$',
        'oninput' => 'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)',
        'autofocus' => true,
    ]) !!}
</div>
<div class="col-md-6">
    {!! Form::label('status', __('Select Status'), ['class' => 'form-label bold']) !!}
    {!! Form::select(
        'status',
        [
            \App\Helpers\IUserStatuses::USER_ACTIVE => \App\Helpers\IUserStatuses::USER_ACTIVE,
            \App\Helpers\IUserStatuses::USER_NON_ACTIVE => \App\Helpers\IUserStatuses::USER_NON_ACTIVE,
        ],
        null,
        [
            'class' => 'form-control',
            !empty($customer) && !empty($customer->status == \App\Helpers\IUserStatuses::USER_NON_ACTIVE)
                ? 'selected'
                : null,
            'required' => false,
        ],
    ) !!}
</div>

            @if (isset($customer->customerInvoices) && count($customer->customerInvoices) > 0)
                @php
                    $recurringInvoices = $customer->customerInvoices->map(function ($invoice) {
                        return [
                            'id' => $invoice->id,
                            'purpose' => $invoice->purpose,
                            'amount' => $invoice->amount,
                        ];
                    });
                @endphp
                <div class="col-md-6">
                    <label for="recurringInvoice" class="form-label bold">{!! __('Select Recurring Invoice (Purpose & Amount)') !!}</label>
                    <select name="recurringInvoice" class="form-control">
                        <option value="">{!! __('Please select') !!}</option>
                        @foreach ($recurringInvoices as $recurringInvoice)
                            <option @if (!empty($customer->recurringInvoice) && $customer->recurringInvoice->invoice_id == $recurringInvoice['id']) selected @endif value="{!! $recurringInvoice['id'] !!}">
                                {!! ucfirst($recurringInvoice['purpose']) . ' ---- BR.' . $recurringInvoice['amount'] !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="recurringDays" class="form-label bold">{!! __('Select Recurring Days') !!}</label>
                    <select name="recurringDays" class="form-control">
                        <option value="">{!! __('Please select') !!}</option>
                        <option @if (!empty($customer->recurringInvoice) && $customer->recurringInvoice->recurring_days == 7) selected @endif value="7">
                            {!! __('7 Days') !!}</option>
                        <option @if (!empty($customer->recurringInvoice) && $customer->recurringInvoice->recurring_days == 15) selected @endif value="15">
                            {!! __('15 Days') !!}</option>
                        <option @if (!empty($customer->recurringInvoice) && $customer->recurringInvoice->recurring_days == 30) selected @endif value="30">
                            {!! __('30 Days') !!}</option>
                    </select>
                </div>
            @endif
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
