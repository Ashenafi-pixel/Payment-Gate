<div class="payment-container mx-3 mb-3 mb-md-0 mx-md-0">
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
                            <b>ብር.</b> {{ $invoice->amount ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</h3>
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
        <div><span>Your Invoice Has Been Paid</span></div>
    @endif
</div>
