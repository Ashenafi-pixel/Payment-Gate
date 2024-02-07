<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReceivedData; // You can remove this import if not used

class FormDataController extends Controller
{
     
    public function display()
    {
        // Retrieve the latest received data from the database
        $banks = [
            ['icon' => 'https://is1-ssl.mzstatic.com/image/thumb/Purple122/v4/95/41/83/954183ef-8454-58b8-4244-2264236dd2fe/AppIcon-1x_U007emarketing-0-5-0-85-220.png/1200x630wa.png', 'name' => 'tele birr', 'type' => 'credit_card'],
            ['icon' => 'https://is4-ssl.mzstatic.com/image/thumb/Purple122/v4/4c/a0/c6/4ca0c64a-568f-fff4-43fa-150e613e52a9/AppIcon-1-0-0-1x_U007emarketing-0-0-0-10-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/1200x630wa.png', 'name' => 'CBE', 'type' => 'credit_card'],
            ['icon' => 'https://media-exp1.licdn.com/dms/image/C4D0BAQHiPeY0n71rsw/company-logo_200_200/0/1581671082683?e=2159024400&v=beta&t=UjZySm44EpMF7TkV4jgnh5yTMaWp2uTZ-KChflc4Z2A', 'name' => 'BOA', 'type' => 'bank_transfer'],
            // Add more banks as needed
        ];

        $latestReceivedData = ReceivedData::latest()->first();

            // Find the data based on the provided ID
        // $latestReceivedData = ReceivedData::find($id);

        // if ($latestReceivedData) {
        //     // Pass the data to the view for display
        //     return view('display', ['latestReceivedData' => $latestReceivedData]);
        // } else {
        //     // Handle case where data with the specified ID is not found
        //     return response()->json(['status' => 'Data not found'], 404);
        // }
    
        return view('checkout.display', ['latestReceivedData' => $latestReceivedData, 'banks'=>$banks]);
    }

    public function receiveData(Request $request)
    {
        $jsonData = $request->json('data');

        if ($jsonData) {
            // Store the data in the database
            $receivedData = ReceivedData::create([
                'data' => json_encode($jsonData),
                'message' => $request->input('message', 'Data received successfully'),
            ]);

                    // Fetch the ID of the newly created row
        // $rowId = $receivedData->id;

        // Include the row ID in the response
        // return response()->json(['id' => $rowId]);


        $latestReceivedData = ReceivedData::latest()->first();



            // return response()->json(['status' => 'Data received successfully']);
            return redirect()->route('data.display')->with(['status' => 'Data received successfully']);
            // return view('display', ['latestReceivedData' => $latestReceivedData]);


        }

        return response()->json(['status' => 'Failed to receive data'], 400);
    }


}
