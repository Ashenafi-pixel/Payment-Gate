<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReceivedData; // You can remove this import if not used
use Illuminate\Support\Facades\Log;


class FormDataController extends Controller
{
     
    public function display($tx_ref)
    {
        $banks = [
            ['icon'=> 'https://example.com/bank1.png', 'name' => 'Bank A', 'type' => 'credit_card'],
            ['icon'=> 'https://example.com/bank2.png', 'name' => 'Bank B', 'type' => 'credit_card'],
            ['icon'=> 'https://example.com/bank3.png', 'name' => 'Bank C', 'type' => 'bank_transfer'],
            // Add more banks as needed
        ];

        // Retrieve the data based on tx_ref
        $receivedData  = ReceivedData::where('tx_ref', $tx_ref)->first();

        return view('checkout.display', compact('receivedData','banks'));

    }

    public function receiveData(Request $request)
{
    // Retrieve data from the request
    $data = $request->input('data');

    if ($data) {
        // Create a new instance of the model and store the data
        $receivedData = ReceivedData::create([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'email' => $data['email'],
            'tx_ref' => $data['tx_ref'],
            'currency' => $data['currency'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'order_detail' => $data['order_detail'],
            'message' => $request->input('message', 'Data received successfully'),
        ]);
    
        // Return a JSON response indicating the result
        return response()->json(['status' => 'Data received successfully', 'data' => $receivedData]);
    }
    
    return response()->json(['status' => 'Failed to receive data'], 400);
}


}
