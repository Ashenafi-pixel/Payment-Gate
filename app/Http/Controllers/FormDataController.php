<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReceivedData; // You can remove this import if not used
use App\Models\User; // You can remove this import if not used
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;



class FormDataController extends Controller
{
     
    public function display(Request $request, $tx_ref)
    {
        if ($request->isMethod('post')) {
            // Handle POST request logic here
            $banks = [
                ['icon'=> 'https://www.capitalethiopia.com/wp-content/uploads/2021/06/Telebirr.jpg', 'name' => 'Tele birr', 'type' => 'wallet'],
                ['icon'=> 'https://www.rocketremit.com/wp-content/uploads/2017/10/CBE-Birr-Logo-768x532.jpeg', 'name' => 'Cbe birr', 'type' => 'wallet'],
                ['icon'=> 'https://play-lh.googleusercontent.com/upmf1qfd-4dHZm7XrlsKeD6ftgTSCFymZRRXyASCORxePd8zDsEnB52blKlABoz3q18', 'name' => 'Apollo', 'type' => 'wallet'],
                ['icon'=> 'https://www.logolynx.com/images/logolynx/49/49e82a05b1e55bff89da663c76e4b4fc.jpeg', 'name' => 'Apollo', 'type' => 'wallet'],
                ['icon'=> 'https://addisfortune.news/wp-content/uploads/2020/06/Hibret-bank-logo.jpg', 'name' => 'Hibret', 'type' => 'wallet'],
                // Add more banks as needed
            ];
    
            // Retrieve the data based on tx_ref
            $receivedData  = ReceivedData::where('tx_ref', $tx_ref)->first();
    
            return view('checkout.display', compact('receivedData','banks'));
        } else {
            // Handle GET request logic here
            $banks = [
                ['icon'=> 'https://www.capitalethiopia.com/wp-content/uploads/2021/06/Telebirr.jpg', 'name' => 'Tele birr', 'type' => 'wallet'],
                ['icon'=> 'https://www.rocketremit.com/wp-content/uploads/2017/10/CBE-Birr-Logo-768x532.jpeg', 'name' => 'Cbe birr', 'type' => 'wallet'],
                ['icon'=> 'https://play-lh.googleusercontent.com/upmf1qfd-4dHZm7XrlsKeD6ftgTSCFymZRRXyASCORxePd8zDsEnB52blKlABoz3q18', 'name' => 'Apollo', 'type' => 'wallet'],
                ['icon'=> 'https://www.logolynx.com/images/logolynx/49/49e82a05b1e55bff89da663c76e4b4fc.jpeg', 'name' => 'M-pesa', 'type' => 'wallet'],
                ['icon'=> 'https://addisfortune.news/wp-content/uploads/2020/06/Hibret-bank-logo.jpg', 'name' => 'Hibret', 'type' => 'wallet'],
                // Add more banks as needed
            ];

        // Retrieve the data based on tx_ref
        $receivedData  = ReceivedData::where('tx_ref', $tx_ref)->first();

        return view('checkout.display', compact('receivedData','banks'));
    }


    }

    public function receiveData(Request $request)
{
    // Retrieve data from the request
    $data = $request->input('data');
    $key = $request->input('key');

    // Check if the key exists
    $accepted = User::where('api_token', $key)->first();

    if (!$accepted) {
        return response()->json(['status' => 'Merchant not found. Please use a valid key.'], 400);
    }

    // Validate the data format
    $requiredFields = ['merchant_name', 'merchant_id', 'tin_number', 'items_list', 'amount', 'tx_ref', 'currency', 'first_name', 'last_name', 'email', 'phone_number', 'order_detail'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field])) {
            return response()->json(['status' => 'Invalid data format. Please provide all required fields.'], 400);
        }
    }

    // Validate amount format and value
    if (!is_numeric($data['amount']) || $data['amount'] > 10000) {
        return response()->json(['status' => 'Invalid amount. Amount must be a number not greater than 10000.'], 400);
    }

    // Validate email format
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return response()->json(['status' => 'Invalid email format. Please provide a valid email address.'], 400);
    }

    // Check for unique tx_ref
    $existingData = ReceivedData::where('tx_ref', $data['tx_ref'])->first();
    if ($existingData) {
        return response()->json(['status' => 'Duplicate tx_ref. Please use a unique reference.'], 400);
    }

    // Create a new instance of the model and store the data
    $receivedData = ReceivedData::create([
        'merchant_name' => $data['merchant_name'],
        'merchant_id' => $data['merchant_id'],
        'tin_number' => $data['tin_number'],
        'items_list' => $data['items_list'],
        'amount' => $data['amount'],
        'tx_ref' => $data['tx_ref'],
        'currency' => $data['currency'],
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone_number' => $data['phone_number'],
        'order_detail' => $data['order_detail'],
        'message' => $request->input('message', 'Data received successfully'),
    ]);

    // Return a JSON response indicating the result
    return response()->json(['status' => 'Data received successfully', 'data' => $receivedData]);
}

   

    public function handleStatusUpdateFromBank(Request $request)
    {
        $tex_ref = $request->input('ref1');
        // Log::info('User logged in.', $tex_ref);


        // Example: Handle the incoming status update from the bank
        $statusFromBank = $request->status; // Assuming the status is sent by the bank
        // $txref = ReceivedData::where('tx_ref', $data['tx_ref'])->first();
        $finalStatus = [
            // 'status' => 'successfull 200',
            "cartId"=> $tex_ref,
            "respStatus"=>"Done",
        ];
        // Process the status and update the payment record in your application
        // Your logic to update the payment record based on the status

        // Forward the status to the merchant website
        $merchantApiUrl = 'https://app.zmart.addissystems.et/payment/AddisPay/return';
        $headers = [
            'Content-Type' => 'application/json',
        ];
        
        $merchantApiResponse = Http::withHeaders($headers)->post($merchantApiUrl,$finalStatus);

        // Process the response from the merchant website if needed
        // return $merchantApiResponse;

        // You can process the response if needed

        // return $response;
    return redirect('https://app.zmart.addissystems.et/shop/confirmation')->with('response', $merchantApiResponse->json());

    }


    public function forwardStatusToMerchant($statusFromBank)
    {
        // Example: Forward the status to the merchant website via API
        // You can use HTTP client or any library to make the API call
        
        // Example: Forwarding the status via HTTP client
        $merchantApiUrl = 'https://app.zmart.addissystems.et/payment/AddisPay/return';
        $headers = [
            'Content-Type' => 'application/json',
        ];
        
        $merchantApiResponse = Http::withHeaders($headers)->post($merchantApiUrl, [
            'status' => $statusFromBank, // Forwarding the status received from the bank
            // You can forward any other relevant data
        ]);

        // Process the response from the merchant website if needed
        // return $merchantApiResponse;
    return redirect('https://app.zmart.addissystems.et/shop/confirmation')->with('response', $merchantApiResponse->json());

    }

    function abortTransaction(Request $request){
        $tex_ref = $request->input('urlEnd');
        ReceivedData::where('tx_ref', $tex_ref)->delete();
// 
        
    return redirect('https://app.zmart.addissystems.et/shop')->with('response', "transaction aborted");


    }
    

}
