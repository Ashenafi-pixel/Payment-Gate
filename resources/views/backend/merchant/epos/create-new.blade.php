@extends('frontend.layouts.app')
@section('title','Create Request')
@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        :root{
            --dark-theme-site: #140c37
        }
        *,
        ::after,
        ::before {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        html {
            scroll-behavior: smooth;
            min-width: 100vw;
            max-width: 100vw;
            overflow-x: hidden !important;
        }

        .credential-holder{
            background: #fee7d9;
            box-shadow:  0 0 5px 5px rgb(0 0 0 / 1%);

        }
        .login-content{
            background: #fee7d9;
            padding: 1rem;
        }
        h3.send-money{
            font-size: 20px;
            font-weight: bold;
        }

        .bg-gray{
            background: #fafafa;
            border-radius: 30px 30px 0 0;
        }
        .form-control,.form-control:is(:hover,:focus){
            box-shadow: 0 0 0 !important;
        }
        .form-control:is(:hover,:focus){
            border-color: var(--theme-green);
        }
        .bg-theme,.btn-theme,.btn-theme:is(:hover,:focus){
            background: var(--theme-green)
        }
        .amount-flex{
            display: flex;
            justify-content:center;
            align-items: center;
        }
        .amount-flex :is(h3, input,label),
        .btns input{
            font-size: 24px;
            font-weight: bold;
        }
        .amount-flex input,
        .amount-flex input:is(:hover,:focus){
            width: 6ch;
            max-width: 6ch;

        }
        .amount-flex input,
        .amount-flex input:is(:hover,:focus),
        .btns input{
            background: transparent;
            border: none;
            outline: none;
        }
        .btns input{
            text-align: center;
            padding: 0.75rem;
        }
        .table td, .table th {
            padding: 0;
            vertical-align: top;
            border: 1px solid #dee2e6;
            box-shadow: rgba(17, 17, 26, 0.01) 0px 0px 16px;
        }
        input[type=number] {
            -moz-appearance:textfield; /** Firefox **/
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            display: none;
            -webkit-appearance: none;
            margin: 0;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
@endpush

@section('content')
    <section class="container h-100">
        <div class="row justify-content-center pt-100 pb-100" style="margin-top: 100px !important;">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="credential-holder">
                    <form method="POST" name="pay" action="{{ route('epos.invoice') }}" class="">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="login-content text-center" >
                                    <h3 class="send-money">Send Money</h3>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="user_id"
                                   value="{{ $data->merchant_id }}">
                            <input type="hidden" class="form-control" name="purpose"
                                   value="{{ __('offline walk in customer') }}">
                            <input type="hidden" class="form-control" name="customer_name"
                                   value="{{ __('offline walk') }}">
                            <div class="col-12">
                                <div class="py-4 px-3 bg-gray">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend ">
                                          <span class="input-group-text bg-theme " id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" width="25"><path d="M459-525q-17 0-28.5-11.5T419-565q0-17 11.5-28.5T459-605q17 0 28.5 11.5T499-565q0 17-11.5 28.5T459-525Zm173 0q-16.575 0-27.787-11.5Q593-548 593-565t11.213-28.5Q615.425-605 632-605q17.425 0 29.213 11.5Q673-582 673-565t-11.787 28.5Q649.425-525 632-525Zm177 0q-17.425 0-29.213-11.5Q768-548 768-565t11.787-28.5Q791.575-605 809-605q16.575 0 27.787 11.5Q848-582 848-565t-11.213 28.5Q825.575-525 809-525Zm-14 405q-122 0-242.5-60T336-336q-96-96-156-216.5T120-795q0-19.286 12.857-32.143T165-840h140q13.611 0 24.306 9.5Q340-821 343-805l27 126q2 14-.5 25.5T359-634L259-533q56 93 125.5 162T542-254l95-98q10-11 23-15.5t26-1.5l119 26q15.312 3.375 25.156 15.188Q840-316 840-300v135q0 19.286-12.857 32.143T795-120ZM229-588l81-82-23-110H180q0 39 12 85.5T229-588Zm369 363q41 19 89 31t93 14v-107l-103-21-79 83ZM229-588Zm369 363Z" fill="#fff"/></svg>
                                          </span>
                                        </div>
                                        <input type="number" name="mobile_number" id="numberPhone" class="form-control numberPhone border-left-0" placeholder="XXXXXXXXXXX">
                                        @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="py-4 amount-flex ">
                                        <h3 class="mb-0 pr-1">SAR</h3>
                                        <input type="number" name="amount" class="numberAmount" id="numberAmount"  oninput="this.style.width = ((this.value.length + 1) * 14) + 'px';" maxlength="6">
                                    </div>
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="bg-white p-3">
                                    <table class="table border btns">
                                        <tr>
                                            <td class="text-center">
                                                <input type="button" name="one" value="1" onclick="dialNumber('1')" class="btn-block">
                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="two" value="2" onclick="dialNumber('2')" class="btn-block">
                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="three" value="3" onclick="dialNumber('3')" class="btn-block">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <input type="button" name="four" value="4" onclick="dialNumber('4')" class="btn-block">
                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="fiv" value="5" onclick="dialNumber('5')" class="btn-block">
                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="six" value="6" onclick="dialNumber('6')" class="btn-block">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <input type="button" name="seven" value="7" onclick="dialNumber('7')" class="btn-block">
                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="eight" value="8" onclick="dialNumber('8')" class="btn-block">
                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="nine" value="9" onclick="dialNumber('9')" class="btn-block">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">

                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="zero" value="0" onclick="dialNumber('0')" class="btn-block">
                                            </td>
                                            <td class="text-center">
                                                <input type="button" name="clear" value="❌" onclick="clearScreen()" class="btn-block" style="padding-top: 22px; font-size: 15px;">
                                            </td>
                                        </tr>
                                    </table>

                                    <button type="submit" class="btn btn-theme btn-block text-white">Pay</button>
                                </div>
                                <input type="hidden" id="activePhone" value="">
                                <input type="hidden" id="activeAmount" value="">
                                <input type="hidden" id="dial-input-amount" value="">
                                <input type="hidden" id="dial-input-phone" value="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>

        let cursor = '';

        $('.numberPhone, .numberAmount').on('input', function() {
            var inputValue = $(this).val();
            var nonNumberInput = inputValue.replace(/[0-9]/g, '');
            $(this).val(nonNumberInput);
        });

        $('.numberPhone').on('focus', function()
        {
            $('.numberPhone').css('border','1px solid #140c37')
            $('.amount-flex').css('border','none')
            $('#activeAmount').val('');
            $('#numberPhone').val('');
            $('#dial-input-phone').val('');
            $('#activePhone').val('phone');
            $(this).blur();
            cursor = 'numberPhone';
        });

        $('.numberAmount').on('focus', function() {
            $('.numberPhone').css('border','1px solid #ced4da')
            $('.amount-flex').css('border','1px solid #140c37')
            $('#activePhone').val('');
            $('#numberAmount').val('');
            $('#dial-input-amount').val('');
            $('#activeAmount').val('amount');
            $(this).blur();
            cursor = 'numberAmount';
        });

        function dialNumber(number)
        {
            var amountActiveFields = $('#activeAmount').val();
            var phoneActiveFields = $('#activePhone').val();
            if(amountActiveFields == 'amount')
            {
                var currentInput = $('#dial-input-amount').val();
                currentInput += number
                $('#dial-input-amount').val(currentInput);
                $('#numberAmount').val(currentInput);
            }else if(phoneActiveFields == 'phone')
            {
                var currentInput = $('#dial-input-phone').val();
                currentInput += number
                $('#dial-input-phone').val(currentInput);
                $('#numberPhone').val(currentInput);
            }else{
                toastr.error('No Active Field');
            }
        }
        function clearScreen(){
            if (cursor ==='numberAmount')
            {
                document.getElementById('numberAmount').value= "";
                document.getElementById('dial-input-amount').value= "";
            }
            if (cursor ==='numberPhone')
            {
                document.getElementById('numberPhone').value= "";
                document.getElementById('dial-input-phone').value= "";
            }


        }

    </script>
    <script src="{{ asset('backend/js/create_request.js') }}"></script>
@endpush
