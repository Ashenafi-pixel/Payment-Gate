<div class="container  my-5">
    <div class="row gy-4 ">
        <div class="col-12">
            <img class="img-fluid" src="{{asset('images/addispay-logo-c.svg')}}" alt="">
        </div>
        <div class="col-12">
            <h3 class="heading">
                Payment Info
            </h3>
            <p class="b-text mb-1">
                <span class="bold">Email:</span>
                {{!empty($invoice->merchant) ? $invoice->merchant->email : \App\Helpers\GeneralHelper::EMPTY_DASHES()}}
            </p>
            <p class="b-text">
                <span class="bold">Address:</span>
                {{!empty($invoice->merchant->merchantDetail) ? $invoice->merchant->merchantDetail->company_address : \App\Helpers\GeneralHelper::EMPTY_DASHES()}}
            </p>
            <hr>
        </div>
        <div class="col-12  payments-detail">
            @if(!empty($invoice->merchant) && \App\Helpers\GeneralHelper::IS_SCHOOL())
                <div class="flex-all">
                    <p class="flex-text">Customer Name</p>
                    <p class="flex-heading">{{!empty($invoice->student) ? $invoice->student->name : \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</p>
                </div>
                <div class="flex-all">
                    <p class="flex-text">Phone Number</p>
                    <p class="flex-heading">{{!empty($invoice->student) ? $invoice->student->mobile_number : \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</p>
                </div>
            @else
                <div class="flex-all">
                    <p class="flex-text">Customer Name</p>
                    <p class="flex-heading">{{!empty($invoice->customer) ? $invoice->customer->name : \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</p>
                </div>
                <div class="flex-all">
                    <p class="flex-text">Phone Number</p>
                    <p class="flex-heading">{{!empty($invoice->customer) ? $invoice->customer->mobile_number : \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</p>
                </div>
            @endif
                <div class="flex-all">
                    <p class="flex-text">Amount</p>
                    <p class="flex-heading">{{ $invoice->amount ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</p>
                </div>
                <div class="flex-all">
                    <p class="flex-text">Currency</p>
                    <p class="flex-heading">BR/ብር</p>
                </div>
                <div class="flex-all">
                    <p class="flex-text">Purpose</p>
                    <p class="flex-heading">{{ $invoice->purpose ?? \App\Helpers\GeneralHelper::EMPTY_DASHES()}}</p>
                </div>
        </div>
        <div class="col-12">
            <div class="alert-highlight">
                Lorem ipsum dolor sit amet consectetur. Dolor fermentum morbi hendrerit nulla. Euismod ullamcorper tristique nunc lectus a eget integer. Gravida aliquam non eros vitae.
            </div>
        </div>
    </div>
</div>
