<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <hr>

                    <div class="payments-detail">
                        <!-- Your payment details here -->
                        <!-- ... -->

                        <div class="flex-all">
                            <p class="flex-text">Amount</p>
                            <p class="flex-heading">{{ $invoice->amount ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                        </div>
                        <div class="flex-all">
                            <p class="flex-text">Currency</p>
                            <p class="flex-heading">BR/ብር</p>
                        </div>
                        <div class="flex-all">
                            <p class="flex-text">Purpose</p>
                            <p class="flex-heading">{{ $invoice->purpose ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</p>
                        </div>
                    </div>

                    <div class="w-100 alert-highlight v-flex-mode gap-2 mt-4">
                        <span class="material-symbols-outlined">
                            info
                        </span>
                        Only accepted via 3d secure ecommerce enabled card.
                    </div>
                    <p class="b-text bold mt-4">
                        How would you like to pay?
                    </p>
                    <!-- Payment Methods -->
                    <div class="row g-3">
                        @forelse($merchantGateways as $key=>$merchantGateway)
                            <div class="col-6 col-lg-4">
                                <input class="hidden p-radio" name="payment-method" type="radio"
                                    value="{{ $merchantGateway->gateway->id }}" @if($key==0) checked
                                    @endif id="{{ str_replace(' ','-',$merchantGateway->gateway->name) }}">
                                <label class="radio-payments"
                                    for="{{ str_replace(' ','-',$merchantGateway->gateway->name) }}">
                                    <img height="30" src="{{asset($merchantGateway->gateway->image->url)}}" alt="">
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
                    <!-- Payment Methods Ends Here -->
                    <div class="flex-all bg-light-blue gap-2 mt-4">
                        <p class="flex-text mb-0">Total Amount</p>
                        <h3 class="flex-heading mb-0">
                            <b>ብር.</b> {{ $invoice->amount ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</h3>
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
                <div class="card-footer">
                    <div class="alert-highlight">
                        Thank you for Trusing AddisPay
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
