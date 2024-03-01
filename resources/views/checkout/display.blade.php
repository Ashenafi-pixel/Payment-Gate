<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receiver - Display</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->

    <style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .checkout-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    h2, p, label {
        font-weight: 600;
    }

    .phone-number {
        position: relative;
        margin-bottom: 15px;
    }

    .input-wrapper {
        position: relative;
        display: inline-block;
    }

    .input-wrapper input {
        padding: 10px;
        width: calc(100% - 30px);
    }

    .validation-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 10px;
        font-size: 16px;
    }

    .bank-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        background-color: #FCA019;
        padding: 20px;
        border-radius: 10px;
    }

    .bank-item {
        text-align: center;
        background-color: white;
        padding: 5px;
        border: 1px solid transparent;
        position: relative;
        cursor: pointer;
        height:60px;
        width: 60px;
        border-radius: 10px;
    }

    .bank-item.selected {
        border: 2px solid #4CAF50;
        border-radius: 10px;
    }

    .bank-item.selected::after {
        content: "\2714";
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 16px;
        color: #4CAF50;
        height: 20px;
        width: 20px;
        border:1px solid #4CAF50;
        border-radius: 50%;
    }

    #pay_button {
        /* background-color: #FCA019; */
        background-color: #FCA019;
        color: white;
        padding: 10px;
        cursor: pointer;
        width: calc(100% - 22px);
        margin-top: 20px;
        font-weight: 600;
    }

    .cancel-transaction {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 20px;
        border: 1px solid black;
        height: 25px;
        width: 25px;
        border-radius: 50%;
    }
    .fa-times{
        padding: 5px;
        align-items: center;
        justify-items: center;


    }

    .confirmation-card {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .confirmation-card-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
    }

    .confirmation-card-buttons {
        margin-top: 20px;
    }
    .payment-method-section {
        margin-top: 20px;
    }

    .expandable-section {
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .expandable-header {
        padding: 10px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f9f9f9;
        border-bottom: 1px solid #ddd;
        border-radius: 8px;
    }

    .expandable-content {
        display: none;
        padding: 10px;
    }

    .expandable-content.active {
        display: block;
    }

    .expandable-header i {
        font-size: 20px;
    }
    .container {
            background-color: #00A26B;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border-radius: 10px;
        }

        .data-row {
            display: flex;
            /* justify-content: space-between; */
            flex-direction: column ;
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }
        .merchant-info {
    display: flex;
    align-items: center;
}
        .merchant-logo {
    width: 60px; /* Set the desired width */
    height: 60px; /* Set the desired height */
    border-radius: 50%; /* Make it a circle */
    margin-right: 10px; /* Adjust spacing between logo and name */
}
.merchant-info p{
    font-size: 30px;
}
.amoutToPay{
    font-size: 30px;

}

</style>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</head>

<body>
    




    <div class="checkout-container">
        <div class="company-info">
            <img src="{{ asset('Images/addispay-logo.png') }}" alt="Company Logo" style="max-width: 200px;height:100px; width:200px;  max-height: 200px;">
            <!-- <img src="{{ asset('images/company_logo.png') }}" alt="Company Logo" style="max-width: 100px; max-height: 100px;"> -->
            
            <!-- <h3>Addis Pay</h3> -->
        </div>
        <h2>Checkout Page</h2>
        <!-- @if (session('response'))
        <h3>Response from Receiver:</h3>
        <pre>{{ json_encode(session('response'), JSON_PRETTY_PRINT) }}</pre>
    @endif -->
    <div class="container">
    <div class="data-row">
    <div class="label">Merchant:</div>
    <div class="merchant-info">
        <img src="{{ asset('Images/logo3.jpg') }}" alt="Merchant Logo" class="merchant-logo">
        <p>{{$receivedData->merchant_name }}</p>
    </div>
</div>
        <div class="data-row">
            <div class="label">Amount To Pay:</div>
            <p class="amoutToPay"> {{$receivedData->amount }}</p>
        </div>
    </div>

    
    <h2>Payment Methods</h2>
    <div class="payment-method-section">
        <div class="expandable-section" id="walletsSection">
            <div class="expandable-header" onclick="toggleSection('walletsContent')">
                <span>Wallets</span>
                <i id="walletsContentIcon" class="fa fa-plus"></i>
                <!-- <i id="walletsIcon" class="fa fa-minus"></i> -->

            </div>
            <div class="expandable-content" id="walletsContent">
                <!-- Add Wallets list similar to Banks -->
                <!-- Example: -->
                <div class="bank-list">
                @foreach($banks as $bank)
                <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="wallet">
                    <img style="height: 60px; width:60px; margin-bottom: 5px;" src="{{ $bank['icon'] }}" alt="{{ $bank['name'] }}" class="bank-icon"><br>
                    <label for="{{ $bank['type'] }}_{{ $loop->index }}">
                        {{ $bank['name'] }}
                    </label>
                </div>
            @endforeach
            <!--  -->
        </div>
                <!-- <div class="bank-item" onclick="handlePaymentSelection(this)">
                    <img style="height: 60px; width:60px; margin-bottom: 5px;" src="wallet_icon.png" alt="Wallet" class="bank-icon"><br>
                    <label for="wallet_1">Wallet 1</label>
                </div>
                <div class="bank-item" onclick="handlePaymentSelection(this)">
                    <img style="height: 60px; width:60px; margin-bottom: 5px;" src="wallet_icon.png" alt="Wallet" class="bank-icon"><br>
                    <label for="wallet_2">Wallet 2</label>
                </div> -->
            </div>
        </div>

        <!-- <div class="expandable-section" id="banksSection">
            <div class="expandable-header" onclick="toggleSection('banksContent')">
                <span>Banks</span>
                <i id="banksContentIcon" class="fa fa-plus"></i>
            </div>
            <div class="expandable-content" id="banksContent">
                <div class="bank-list">
                <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="bank">
                    <img style="height: 60px; width:60px; margin-bottom: 5px;" src="bank_icon.png" alt="Bank" class="bank-icon"><br>
                    <h2></h2>
                    <label for="bank_1">Bank 1</label>
                </div>
                <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="bank">
                    <img style="height: 60px; width:60px; margin-bottom: 5px;" src="bank_icon.png" alt="Bank" class="bank-icon"><br>
                    <label for="bank_2">Bank 2</label>
                </div>
                </div>
            </div>
        </div> -->

        <div class="expandable-section" id="internationalPaymentsSection">
            <div class="expandable-header" onclick="toggleSection('internationalPaymentsContent')">
                <span>International Payments</span>
                <i id="internationalPaymentsContentIcon" class="fa fa-plus"></i>
            </div>
            <div class="expandable-content" id="internationalPaymentsContent">
                <!-- Add International Payments list -->
                <!-- Example: -->
                <div class="bank-list">

                <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="international">
                    <!-- <img style="height: 60px; width:60px; margin-bottom: 5px;" src="paypal_icon.png" alt="PayPal" class="bank-icon"><br> -->
                    <img src="{{ asset('Images/paypal_new_logo.png') }}" alt="Company Logo" style="height: 60px; width:60px; margin-bottom: 5px;">

                    <label for="paypal">PayPal</label>
                </div>
                <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="international">
                    <!-- <img style="height: 60px; width:60px; margin-bottom: 5px;" src="payoneer_icon.png" alt="Payoneer" class="bank-icon"><br> -->
                    <img src="{{ asset('Images/Payoneer.png') }}" alt="Company Logo" style="height: 60px; width:60px; margin-bottom: 5px;">

                    <label for="payoneer">Payoneer</label>
                </div>
                <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="international">
                    <!-- <img style="height: 60px; width:60px; margin-bottom: 5px;" src="wise_icon.png" alt="Wise" class="bank-icon"><br> -->
                    <img src="{{ asset('Images/wise.webp') }}" alt="Company Logo" style="height: 60px; width:60px; margin-bottom: 5px;">

                    <label for="wise">Wise</label>
                </div>
                </div>
            </div>
        </div>
        <div class="expandable-section" id="cardPaymentsSection">
    <div class="expandable-header" onclick="toggleSection('cardPaymentsContent')">
        <span>Card Payments</span>
        <i id="cardPaymentsContentIcon" class="fa fa-plus"></i>
    </div>
    <div class="expandable-content" id="cardPaymentsContent">
        <!-- Add Card Payments list -->
        <!-- Example: -->
        <div class="bank-list">
            <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="credit_card">
                <!-- <img style="height: 60px; width:60px; margin-bottom: 5px;" src="credit_card_icon.png" alt="Credit Card" class="bank-icon"><br> -->
                <img src="{{ asset('Images/visa.png') }}" alt="Company Logo" style="height: 60px; width:60px; margin-bottom: 5px;">

                <label for="credit_card">Credit Card</label>
            </div>
            <div class="bank-item" onclick="handlePaymentSelection(this)" data-method="other_cards">
                <img style="height: 60px; width:60px; margin-bottom: 5px;" src="other_cards_icon.png" alt="Other Cards" class="bank-icon"><br>
                <label for="other_cards">Other Cards</label>
            </div>
        </div>
    </div>
</div>
@php
    $url = url()->current();
    $params = explode('/', $url);
    $ref1 = end($params);
    @endphp
    <form id="payment_forms" method="post" action="{{ route('bankstatus.payment') }}">
    @csrf
    <input type="hidden" name="ref1" value="{{ $ref1 }}">

    <button type="submit" id="pay_button" >Pays </button>


    </form>

        <!-- <form action="{{ route('bankstatus.payment') }}" method="post"> -->
        <form id="payment_form" method="post" action="{{ route('bankstatus.payment') }}">

        <!-- <form id="payment_form" method="post"> -->

@php
    $url = url()->current();
    $params = explode('/', $url);
    $ref1 = end($params);
    @endphp
    <form id="payment_forms" method="post" action="{{ route('bankstatus.payment') }}">
    @csrf
    <input type="hidden" name="ref1" value="{{ $ref1 }}">

    <!-- <button type="submit" id="pay_buttons" >Pays </button> -->

    </form>

        <!-- <form action="{{ route('bankstatus.payment') }}" method="post"> -->
        <form id="payment_form" method="post" action="{{ route('bankstatus.payment') }}">

        <!-- <form id="payment_form" method="post"> -->

        @csrf

        <div class="phone-number" id="phone_number" style="display: none;">
        <label for="phone_number">Phone Number:</label>
            <div class="input-wrapper">
                <input type="text" id="phone_number" name="phone_number" placeholder="Enter phone number" pattern="[0-9]{10}" required oninput="validatePhoneNumber(this)">
                <span class="validation-icon" id="phone_validation_icon"></span>
            </div>
        </div>

        <div class="bank-account" id="bank_account_number" style="display: none;">
    <label for="bank_account_number">Bank Account Number:</label>
    <div class="input-wrapper">
        <input type="text" id="bank_account_input" name="bank_account_number" placeholder="Enter bank account number" required oninput="validateInput(this)">
                <span class="validation-icon" id="bank_account_validation_icon"></span>
    </div>
</div>

<div class="email" id="email" style="display: none;">
    <label for="email">Email:</label>
    <div class="input-wrapper">
        <input type="email" id="email_input" name="email" placeholder="Enter email" required oninput="validateEmail(this)">
        <span class="validation-icon" id="email_validation_icon"></span>

    </div>
</div>
<div class="credit-card-details" id="creditCardDetails" style="display: none;">
    <div class="input-wrapper">
        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" placeholder="Enter card number" required oninput="validateCardInput(this)">
        <span class="validation-icon" id="card_number_validation_icon"></span>

    </div>
    <div class="input-wrapper">
        <label for="expiration_date">Expiration Date:</label>
        <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" required oninput="validateCardInput(this)">
        <span class="validation-icon" id="expiry_date_validation_icon"></span>

    </div>
    <div class="input-wrapper">
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required oninput="validateCardInput(this)">
        <span class="validation-icon" id="cvv_validation_icon"></span>

    </div>
</div>


        

        <!-- <button type="submit" id="pay_button" >Pay </button> -->
        <!-- <button type="button" id="pay_buttons" onclick="handlePaymentSubmission()">Pay</button> -->


        <div class="cancel-transaction" onclick="showConfirmationCard()">
            <i class="fa fa-times">x</i>
        </div>
    </form>


        <div class="confirmation-card" id="confirmationCard">
        <div class="confirmation-card-content">
            <p>Are you sure you want to cancel the transaction?</p>
            <div class="confirmation-card-buttons">
                <button onclick="cancelTransaction()">Yes</button>
                <button onclick="hideConfirmationCard()">No</button>
            </div>
        </div>
    </div>
</div>

<script>
    var selectedBankItem = null;
    var selectedPaymentMethod = null;

    function handlePaymentSubmission() {
    // Extract the data to be sent
    const phoneNumber = document.getElementById('phone_number').value;

    // Construct the data object to be sent in the POST request
    const postData = {
        phone_number: phoneNumber,
        selected_bank: selectedBankItem.querySelector('label').innerText,
        // Add more data as needed
    };

    // Send the POST request using Axios to your Laravel backend route
    axios.post('{{ route("bankstatus.payment") }}', postData)
        .then(response => {
            // Handle the response here if needed
            console.log('Response from server:', response.data);
            // Redirect or perform further actions as needed
        })
        .catch(error => {
            // Handle errors here if the POST request fails
            console.error('Error sending payment details:', error);
        });
}

    function handlePaymentSubmission() {
    // Extract the data to be sent
    const phoneNumber = document.getElementById('phone_number').value;

    // Construct the data object to be sent in the POST request
    const postData = {
        phone_number: phoneNumber,
        selected_bank: selectedBankItem.querySelector('label').innerText,
        // Add more data as needed
    };

    // Send the POST request using Axios to your Laravel backend route
    axios.post('{{ route("bankstatus.payment") }}', postData)
        .then(response => {
            // Handle the response here if needed
            console.log('Response from server:', response.data);
            // Redirect or perform further actions as needed
        })
        .catch(error => {
            // Handle errors here if the POST request fails
            console.error('Error sending payment details:', error);
        });
}

    function toggleSection(sectionId) {
        console.log(sectionId);
    
    var sectionContent = document.getElementById(sectionId);
    var sectionIcon = document.getElementById(`${sectionId}Icon`);
    
    console.log(sectionIcon);
    // Attach an event listener to the "Pay" button to handle form submission
    // document.getElementById('pay_button').addEventListener('click', function(event) {
    //     // Prevent the default form submission behavior
    //     event.preventDefault();

    //     // Call the function to handle payment submission
    //     handlePaymentSubmission();
    // });
    // Attach an event listener to the "Pay" button to handle form submission
    // document.getElementById('pay_button').addEventListener('click', function(event) {
    //     // Prevent the default form submission behavior
    //     event.preventDefault();

    //     // Call the function to handle payment submission
    //     handlePaymentSubmission();
    // });

    function validateCardInput(input) {
    var cardNumber = document.getElementById('card_number').value;
    var expiryDate = document.getElementById('expiry_date').value;
    var cvv = document.getElementById('cvv').value;

    // Card number validation
    var isValidCardNumber = /^\d{16}$/.test(cardNumber);
    updateValidationIcon(document.getElementById("card_number_validation_icon"), isValidCardNumber);

    // Expiry date validation
    var isValidExpiryDate = /^(0[1-9]|1[0-2])\/\d{2}$/.test(expiryDate);
    updateValidationIcon(document.getElementById("expiry_date_validation_icon"), isValidExpiryDate);

    // CVV validation
    var isValidCVV = /^\d{3,4}$/.test(cvv);
    updateValidationIcon(document.getElementById("cvv_validation_icon"), isValidCVV);

    // Return true if all fields are valid
    return isValidCardNumber && isValidExpiryDate && isValidCVV;
}


    if (sectionContent) {
        if (sectionContent.style.display === '' || sectionContent.style.display === 'none') {
            sectionContent.style.display = 'block';
            // sectionIcon.className = 'fa-minus'; // Change icon to minus when expanded
            sectionIcon.classList.remove('fa-plus');
                sectionIcon.classList.add('fa-minus');

        } else {
            sectionContent.style.display = 'none';
            // sectionIcon.className = 'fa fa-plus'; // Change icon to plus when collapsed
            sectionIcon.classList.remove('fa-minus');
                sectionIcon.classList.add('fa-plus');
        }
    }
            // Close other sections
            var allSections = document.querySelectorAll('.expandable-content');
        for (var i = 0; i < allSections.length; i++) {
            var otherSection = allSections[i];
            if (otherSection.id !== sectionId) {
                otherSection.style.display = 'none';
            }

        }}
    


    // Function to select payment method
    function handlePaymentSelection(element) {
    // Add your logic to handle the selected payment method
    // Hide all input fields initially
    document.getElementById('phone_number').style.display = 'none';
    document.getElementById('bank_account_number').style.display = 'none';
    document.getElementById('email').style.display = 'none';
    // Reset validation icon
    document.getElementById('phone_validation_icon').innerHTML = '';

    if (selectedBankItem) {
        selectedBankItem.classList.remove('selected');
    }
    selectedBankItem = element;
    selectedBankItem.classList.add('selected');
    document.getElementById("pay_button").disabled = false;
    document.getElementById("pay_button").innerHTML = "Pay with " + element.querySelector('label').innerText;
    console.log('Selected Payment Method:', element.querySelector('label').innerText);
    selectedPaymentMethod = element.getAttribute('data-method');

    // Show/hide input fields based on the selected payment method
    var phoneNumberInput = document.getElementById('phone_number');
    var bankAccountInput = document.getElementById('bank_account_number');
    var emailInput = document.getElementById('email');

    phoneNumberInput.style.display = selectedPaymentMethod === 'wallet' ? 'block' : 'none';
    bankAccountInput.style.display = selectedPaymentMethod === 'bank' ? 'block' : 'none';
    emailInput.style.display = selectedPaymentMethod === 'international' ? 'block' : 'none';

    // Handle credit card selection logic
    if (selectedPaymentMethod === 'credit_card') {
        // Show credit card details section
        document.getElementById('creditCardDetails').style.display = 'block';
    } else {
        // Hide credit card details section if other payment method is selected
        document.getElementById('creditCardDetails').style.display = 'none';
    }

    // Handle bank selection logic
    if (selectedBankItem) {
        selectedBankItem.classList.remove('selected');
    }
    selectedBankItem = element;
    selectedBankItem.classList.add('selected');
    document.getElementById("pay_button").disabled = false;
    document.getElementById("pay_button").innerHTML = "Pay with " + element.querySelector('label').innerText;
}


    // function validateInput(element) {
    //     var inputField;

    //     if (selectedPaymentMethod === 'wallet') {
    //         inputField = document.getElementById('phone_number');
    //         return /^\d{10}$/.test(inputField.value);
    //     } else if (selectedPaymentMethod === 'bank') {
    //         inputField = document.getElementById('bank_account_number');
    //         // Add your bank account validation logic here
    //         return inputField.value.trim() !== '';
    //     } else if (selectedPaymentMethod === 'international') {
    //         inputField = document.getElementById('email');
    //         // Add your email validation logic here
    //         return /\S+@\S+\.\S+/.test(inputField.value);
    //     }

    //     return false; // Return false for unsupported payment method
    // }

    function validateInput(element) {
    var inputField = null;
    var validationIcon = null;

    if (selectedPaymentMethod === 'wallet') {
        inputField = element.value
        validationIcon = document.getElementById("phone_validation_icon");
        return validatePhoneNumber(inputField, validationIcon);
    } else if (selectedPaymentMethod === 'bank') {
        inputField = document.getElementById('bank_account_number');
        validationIcon = document.getElementById("bank_account_validation_icon");
        // Add your bank account validation logic here
        var isValidBankAccount = inputField.value.length>12 && inputField.value.length < 14 ;
        updateValidationIcon(validationIcon, isValidBankAccount);
        return isValidBankAccount;
    } else if (selectedPaymentMethod === 'international') {
        inputField = document.getElementById('email');
        validationIcon = document.getElementById("email_validation_icon");
        // Add your email validation logic here
        var isValidEmail = /\S+@\S+\.\S+/.test(inputField.value);
        updateValidationIcon(validationIcon, isValidEmail);
        return isValidEmail;
    }

    return false; // Return false for unsupported payment method
}

function validatePhoneNumber(input, validationIcon) {
    // var phoneNumber = input.value;
    console.log(input);
    var isValidPhoneNumber = /^\d{10}$/.test(input);
    updateValidationIcon(validationIcon, isValidPhoneNumber);
    return isValidPhoneNumber;
}

function updateValidationIcon(validationIcon, isValid) {
    if (isValid) {
        validationIcon.innerHTML = "&#10004;"; // Checkmark
        validationIcon.style.color = "green";
    } else {
        validationIcon.innerHTML = "&#10006;"; // Cross
        validationIcon.style.color = "red";

    }
}


    function selectBank(element) {
        if (selectedBankItem) {
            selectedBankItem.classList.remove('selected');
        }
        selectedBankItem = element;
        selectedBankItem.classList.add('selected');
        document.getElementById("pay_button").disabled = false;
        document.getElementById("pay_button").innerHTML = "Pay with " + element.querySelector('label').innerText;
    }

    function validatePhoneNumber(input) {
        var validationIcon = document.getElementById("phone_validation_icon");
        var phoneNumber = input.value;

        if (/^\d{10}$/.test(phoneNumber)) {
            validationIcon.innerHTML = "&#10004;"; // Checkmark
            validationIcon.style.color = "green";
        } else {
            validationIcon.innerHTML = "&#10006;"; // Cross
            validationIcon.style.color = "red";
        }
    }

    function validateEmail(input) {
        var validationIcon = document.getElementById("email_validation_icon");
        var email = input.value;

        if (/\S+@\S+\.\S+/.test(email)) {
            validationIcon.innerHTML = "&#10004;"; // Checkmark
            validationIcon.style.color = "green";
        } else {
            validationIcon.innerHTML = "&#10006;"; // Cross
            validationIcon.style.color = "red";
        }
    }


    function showConfirmationCard() {
        document.getElementById("confirmationCard").style.display = "flex";
    }

    function hideConfirmationCard() {
        document.getElementById("confirmationCard").style.display = "none";
    }

    function cancelTransaction() {
        var currentUrl = window.location.href;

// Split the URL by '/' and get the last part
var urlEnd = currentUrl.split('/').pop();

// Redirect to the data.abort route with the URL end as a parameter
window.location.href = '{{ route("data.abort") }}' + '?urlEnd=' + urlEnd;

// Hide the confirmation card

        var currentUrl = window.location.href;

// Split the URL by '/' and get the last part
var urlEnd = currentUrl.split('/').pop();

// Redirect to the data.abort route with the URL end as a parameter
window.location.href = '{{ route("data.abort") }}' + '?urlEnd=' + urlEnd;

// Hide the confirmation card

        hideConfirmationCard();
    }
    function fetchMerchantDetails() {
            axios.get('https://your-api-endpoint/merchant-details')
                .then(response => {
                    const { totalAmount, merchantName } = response.data;

                    // Update the HTML with fetched details
                    document.getElementById('total_amount').innerText = `Total Amount: ${totalAmount}`;
                    document.getElementById('merchant_name').innerText = `Merchant: ${merchantName}`;
                })
                .catch(error => {
                    console.error('Error fetching merchant details:', error);
                });
        }

        // Function to send transaction details using a POST request
        function sendTransactionDetails() {
            const phoneNumber = document.getElementById('phone_number').value;
            const selectedBankName = selectedBankItem.querySelector('label').innerText;

            // Data to be sent in the POST request
            const postData = {
                phoneNumber,
                selectedBankName,
                // TIME,

                // Add more data as needed
            };

            axios.post('https://your-api-endpoint/process-payment', postData)
                .then(response => {
                    // Handle the response as needed
                    console.log('Transaction details sent successfully:', response.data);
                })
                .catch(error => {
                    console.error('Error sending transaction details:', error);
                });
        }

        // Update the fetchMerchantDetails function to be called on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetchMerchantDetails();
        });


</script>



    
</body>

</html>


<!-- resources/views/checkout.blade.php -->




