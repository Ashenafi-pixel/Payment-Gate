<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{!! 'AddisPay | PayTabs Payment' !!} </title>
    @include('frontend.layouts.head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            background: #fff;
            box-shadow:  0 0 5px 5px rgb(0 0 0 / 3%);
            border-radius: 8px;
            border-top: 3px solid #023047;
        }
        .login-content{
            background: #023047;
            padding: 2rem;
            border-radius: 7px 7px 0px 0px;
        }
        .input-label{
            font-size: 14px;
            font-weight: bold;
        }
        .form-check-label{
            font-size: var(--font-14);
            padding-top:1px
        }
        .form-control{
            font-size:  var(--font-13);
            box-shadow: 0 0 0 !important;
        }
        input[type='checkbox']:indeterminate,
        input[type='radio']{
            accent-color: var(--theme-yellow) !important;
            background-color:var(--theme-yellow) !important ;
        }
        .show-hide{
            position: absolute;
            right: 0.5rem;
            top: 36px;
            cursor: pointer;
        }
        .flex-mode{
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }
        .v-flex-mode{
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .link-fpsw,.c-link,.c-link:hover{
            font-size: var(--font-14);
            text-decoration: none;
            color: var(--dark-green);
            transition: 0.3s all ease-in-out
        }

        .link-fpsw:hover,.c-link:hover span{
            color: var(--theme-orange);
        }
        .c-link span{
            font-weight:bold;
        }
        .error{
            font-size: var(--font-13);
            margin-top: 5px;
            color: red;
            font-weight: 500;
        }
        .form-control {
            background-image: none !important; /* Remove default browser icons */
            padding-right: 40px; /* Space for the card icon */
        }

        .form-control.card-icon {
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 25px;
        }

        .form-control:focus {
            border-color: rgba(6, 33, 47, 0.8);
            box-shadow: none;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
        }

        .is-valid {
            border-color: #28a745 !important;
            background-color: #0c7029;
            color: #fff
        }

        .is-invalid {
            border-color: #dc3545 !important;
            background-color: #9c0014;
            color: #fff
        }

        .fa-2x {
            font-size: 1.5em;
        }
        .fa-cc-mastercard{
            color:  #FF5F00
        }
        .fa-cc-visa{
            color: #1434CB
        }
        .btn-primary,.btn-primary:hover,.btn-primary:focus{
            background: var(--theme-green);
            border-color:   var(--theme-green)
        }
        .h-100{
            min-height: 100vh;
            display: flex;
            align-items: center;
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
    </style>
</head>
<body>
<main>
    <section class="container h-100">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="credential-holder">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-content text-center" >

                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="{{asset('images/addispay-logo-c.svg')}}" width="69" height="32" fill="none" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-4">
                                <form id="payform" method="post" action="{{route('paytabs-callback')}}">
                                    <span id="paymentErrors"></span>
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cardNumber">Card Number:</label>
                                                <div class="input-group">
                                                    <input type="text" data-paylib="number" size="20" id="cardNumber" name="cardNumber" class="form-control card-icon" placeholder="XXXX XXXX XXXX XXXX" required>
                                                    <div class="input-group-append">
                                                    <span class="input-group-text">
                                                         <i class="fas fa-credit-card fa-2x"></i>
                                                     </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Card Holdername:</label>
                                                <input type="text" id="name" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group ">
                                                        <label for="expirationMonth">Exp Month:</label>
                                                        <select id="expirationMonth" data-paylib="expmonth" name="expirationMonth" class="form-control" required>
                                                            <option value="">Month</option>
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="expirationYear">Exp Year:</label>
                                                        <input type="number" data-paylib="expyear" size="4" id="expirationYear" name="expirationYear" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="cvv">CVV:</label>
                                                        <input type="password" data-paylib="cvv" size="4" id="cvv" name="cvv" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="error"></div>
                                        </div>
                                        <div class="col-12 text-right mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-money-check pr-2"></i>  Pay
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('frontend.layouts.foot')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
<script src="https://secure-global.paytabs.com/payment/js/paylib.js"></script>
<script>
    // Card number validation
    $('#cardNumber').payment('formatCardNumber').keyup(function() {
        var cardNumber = $(this).val().replace(/\s+/g, '');
        var isValid = $.payment.validateCardNumber(cardNumber);

        $(this).toggleClass('is-invalid', !isValid);
        $(this).toggleClass('is-valid', isValid);

        // Detect card type based on the first digit(s) of the card number
        var cardType = $.payment.cardType(cardNumber);
        var cardIcon = '';
        if (cardType === 'visa') {
            cardIcon = '<span class="input-group-text"><i class="fab fa-cc-visa"></i></span>'; // Visa card icon
        } else if (cardType === 'mastercard') {
            cardIcon = '<span class="input-group-text"><i class="fab fa-cc-mastercard"></i></span>'; // Mastercard icon
        } else {
            cardIcon = '<span class="input-group-text"><i class="fas fa-credit-card"></i></span>'; // Default dummy icon
        }

        // Display the card icon in the input field
        var inputGroupAppend = $(this).parent().find('.input-group-append');
        inputGroupAppend.html(cardIcon);
    });

    // Expiration month validation
    $('#expirationMonth').change(function() {
        validateExpirationDate();
    });

    // Year input validation
    $('#expirationYear').on('input', function() {
        var year = $(this).val();
        var isValid = /^\d*$/.test(year); // Regular expression to check if the input contains only digits

        $(this).toggleClass('is-invalid', !isValid);
        $(this).toggleClass('is-valid', isValid);
    });

    // CVV validation
    $('#cvv').payment('formatCardCVC').keyup(function() {
        var cvv = $(this).val();
        var isValid = $.payment.validateCardCVC(cvv);

        $(this).toggleClass('is-invalid', !isValid);
        $(this).toggleClass('is-valid', isValid);
    });

    var myform = document.getElementById('payform');
    paylib.inlineForm({
        'key': 'CVK2D7-RQBM6G-P66BP7-K7BQQ6',
        'form': myform,
        'autoSubmit': false,
        'callback': function(response) {
            document.getElementById('paymentErrors').innerHTML = '';
            if (response.error) {
                paylib.handleError(document.getElementById('paymentErrors'), response);
            }
            sendRequest(response);
        }
    });

    function sendRequest(response) {
        var data = {!! json_encode($invoice) !!};
        var payment_method = {!! json_encode($paymentMethod) !!};
        var customer = {!! json_encode($customer) !!};

        var requesttopayTab = {
            "profile_id": 124068,
            "tran_type": "sale",
            "tran_class": "ecom",
            "cart_id": data.order_id,
            "cart_description": data.purpose,
            "cart_currency": "PKR",
            "cart_amount": data.amount,
            "callback": "",
            "return": "",
            "customer_details": {
                "name": customer.name,
                "email": "mailto:jsmith@gmail.com",
                "street1": "404, 11th st, void",
                "city": "Dubai",
                "state": "DU",
                "country": "AE",
                "ip": "91.74.146.168"
            },
            "payment_token": response.token
        };

        var url = "{{route('store-pay-tabs-payment')}}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            data: {
                qwa:requesttopayTab,
                invoice_id:data.id,
                payment_method:payment_method,
            },
            success: function(responseData) {
                if(responseData.status == true){
                    window.location.href = responseData.url;
                }else{
                    document.getElementById('paymentErrors').innerHTML = '<p style="color:red">'+responseData.error+'</p>';
                }
                console.log(responseData);
            }
        });

        console.log(requesttopayTab);
        console.log("hello");
        console.log(data);
    }

    // Function to validate expiration month and year
    function validateExpirationDate() {
        var expirationMonth = $('#expirationMonth').val();
        var expirationYear = $('#expirationYear').val();
        var isValid = $.payment.validateCardExpiry(expirationMonth, expirationYear);

        $('#expirationMonth').toggleClass('is-invalid', !isValid);
        $('#expirationYear').toggleClass('is-invalid', !isValid);
        $('#expirationMonth').toggleClass('is-valid', isValid);
        $('#expirationYear').toggleClass('is-valid', isValid);

        return isValid;
    }
</script>
</body>

</html>
