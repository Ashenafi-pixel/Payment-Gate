<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Payment Info Card -->
        <div class="col-md-6">
            <div class="card" style="margin-bottom: 20px;">
                <div class="card-body text-center">
                    <img style="max-width: 400px; height: 50px;" class="img-fluid mb-4" src="{{ asset('images/addispay-logo-c.svg') }}" alt="Logo">

                    <h3 class="card-title heading" style="font-size: 20px;">
                        Payment Info
                    </h3>
                    <p class="card-text b-text mb-1" style="font-size: 14px;">
                        <span class="bold">Email:</span>
                        {{ !empty($invoice->merchant) ? $invoice->merchant->email : \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                    </p>
                    <p class="card-text b-text" style="font-size: 14px;">
                        <span class="bold">Address:</span>
                        {{ !empty($invoice->merchant->merchantDetail) ? $invoice->merchant->merchantDetail->company_address : \App\Helpers\GeneralHelper::EMPTY_DASHES() }}
                    </p>

                    <!-- Other Payment Info Content... -->

                    @if($invoice->status)
                        <div class="w-100">
                            {!! Form::open(['url' => route('pay-invoice',encrypt($invoice->id)),'method' => 'POST','class' =>'ajax' ])!!}
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="w-100 alert-highlight v-flex-mode gap-2">
                                        <span class="material-symbols-outlined">
                                            info
                                        </span>
                                        Only accepted via 3d secure ecommerce enabled card.
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <p class="b-text bold mb-0">
                                        How would you like to pay?
                                    </p>
                                </div>
                                <!--Payment Methods---->
                                <div class="col-12">
                                    <div class="row g-3">
                                        @forelse($merchantGateways as $key=>$merchantGateway)
                                            <div class="col-6 col-lg-4">
                                                <input class="hidden p-radio" name="payment-method" type="radio"
                                                    value="{{ $merchantGateway->gateway->id }}" @if($key==0) checked
                                                    @endif id="{{ str_replace(' ','-',$merchantGateway->gateway->name) }}">
                                                <label class="radio-payments"
                                                    for="{{ str_replace(' ','-',$merchantGateway->gateway->name) }}">
                                                    <img height="24" src="{{asset($merchantGateway->gateway->image->url)}}" alt="">
                                                    <p class="small-text mb-0 text-center">
                                                        {{__(ucwords($merchantGateway->gateway->name))}}
                                                    </p>
                                                </label>
                                            </div>
                                        @empty
                                            <span>
                                                {{ __('No Gateway Installed') }}
                                            </span>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- Payment Methods Ends Here--->
                                <div class="col-12">
                                    <div class="flex-all bg-light-blue gap-2">
                                        <p class="flex-text mb-0">Total Amount</p>
                                        <h3 class="flex-heading mb-0">
                                            <b>ብር.</b> {{ $invoice->amount ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}
                                        </h3>
                                    </div>
                                </div>
                                @if(count($merchantGateways) > 0)
                                    <div class="col-12">
                                        <button class="btn btn-theme-effect w-100 bold" type="submit"
                                                title="We don't have any payment gateway for payment">
                                            Submit
                                        </button>
                                    </div>
                                @endif
                            </div>
                            {!! Form::close() !!}
                        </div>

                    @else
                        <div style="text-align: center;">
                            <img style="max-width: 400px; height: 300px;" class="img-fluid mb-4" src="{{ asset('images/success.gif') }}" alt="Logo">
                            <div style="max-width: 600px; margin: 0 auto; text-align: center;">
                                <span style="display: block;">Payment Successful</span>
                            </div>
                        </div>
                    @endif

                    <!-- Payment Methods Ends Here -->
                    <div class="flex-all bg-light-blue gap-2 mt-4">
                        <div class="card-footer">
                            <div class="alert-highlight">
                                <p class="flex-text mb-0">Thank you for Trusting AddisPay</p>
                            </div>
                        </div>
                        <h3 class="flex-heading mb-0">
                            <b>ብር.</b> {{ $invoice->amount ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

         <!-- Success Card -->
         @if($invoice->status==0)
            <div class="col-md-6">
                <div class="card" style="margin-bottom: 20px;">
                    <div style="text-align: center;">
                        <img style="max-width: 400px; height: 300px;" class="img-fluid mb-4" src="{{ asset('images/Thank_you.jpg') }}" alt="Logo">
                        <div style="max-width: 600px; margin: 0 auto; text-align: center;">
                            <span style="display: block;">Payment Successful</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
