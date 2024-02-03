<?php

namespace App\Http\Controllers\Auth;

// namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Log;
use App\Models\ReceivedData;

class   LockScreenController extends Controller
{

    /**
     * @package     LockScreenController
     * @author      Shaarif <m.shaarif@xintsolutions.com>
     */

    /**
     * @var LoginController
     */
    private LoginController $_loginController;

    /**
     * @param LoginController $_loginController
     */
    public function __construct(LoginController $_loginController)
    {
        $this->_loginController = $_loginController;
    }

    /**
     * @return Application|Factory|View
     */
    public function lockScreen()
    {
        $user    = Auth::user();
        Session::put('username', $user->username); # Save data in the session and Logout
        Session::put('profile_image', $user->image->url); # Save data in the session and Logout
        Auth::logout();
        return view('auth.passwords.lock-screen');
    }



    /**
     * @param Request $request
     * @return Response
     */
    public function unLockScreen(Request $request)
    {
        $request->merge(['username' => Session::get('username'), 'login' => Session::get('username')]);
        return $this->_loginController->login($request);
    }

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

            return response()->json(['status' => 'Data received successfully']);
        }

        return response()->json(['status' => 'Failed to receive data'], 400);
    }

    public function showCheckout(Request $request, $totalAmount = null, $merchantName = null)
    {
        // Fetch data from API to get merchant's name and total amount
        // $merchantName = 'Zmart'; // retrieve from API;
        // $totalAmount = 100; // retrieve from API;
        // Retrieve data from the session
        // $merchantName = Session::get('merchantName');
        // $totalAmount = Session::get('totalAmount');
        
if (isset($_POST['submit'])) { // Check if the form was submitted
  $totalAmount = $_POST['name']; // Retrieve the value of the 'name' field
  $merchantName = $_POST['email']; // Retrieve the value of the 'email' field

  // Process the form data as needed
  // For example, you can store it in a database or send it via email

  // Output or redirect to a success page
  echo "Form submitted successfully!";
}
        // $totalAmount = $request->input('total_amount');
        // $merchantName = $request->input('merchant_name');


        // Manually list banks
        Log::info("showCheckout: totalAmount = $totalAmount, merchantName = $merchantName");

        $banks = [
            ['icon' => 'https://is1-ssl.mzstatic.com/image/thumb/Purple122/v4/95/41/83/954183ef-8454-58b8-4244-2264236dd2fe/AppIcon-1x_U007emarketing-0-5-0-85-220.png/1200x630wa.png', 'name' => 'tele birr', 'type' => 'credit_card'],
            ['icon' => 'https://is4-ssl.mzstatic.com/image/thumb/Purple122/v4/4c/a0/c6/4ca0c64a-568f-fff4-43fa-150e613e52a9/AppIcon-1-0-0-1x_U007emarketing-0-0-0-10-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/1200x630wa.png', 'name' => 'CBE', 'type' => 'credit_card'],
            ['icon' => 'https://media-exp1.licdn.com/dms/image/C4D0BAQHiPeY0n71rsw/company-logo_200_200/0/1581671082683?e=2159024400&v=beta&t=UjZySm44EpMF7TkV4jgnh5yTMaWp2uTZ-KChflc4Z2A', 'name' => 'BOA', 'type' => 'bank_transfer'],
            // Add more banks as needed
        ];

        return view('checkout.checkout', compact('merchantName', 'totalAmount', 'banks'));
    }

    public function showForm($totalAmount = null, $merchantName =null)
    {

        Log::info("showForm: totalAmount = $totalAmount, merchantName = $merchantName");

        return view('checkout.submit-form', compact('totalAmount', 'merchantName'));
    }



    public function processCheckout(Request $request)
    {
        // $totalAmount = $request->input('total_amount');
        // $merchantName = $request->input('merchant_name');

        // You can add logic to save the data or perform additional actions
        // session(['totalAmount' => $totalAmount, 'merchantName' => $merchantName]);

        // return redirect()->route('showCheckout');

                // Retrieve data from the form
                $totalAmount = $request->input('total_amount');
                $merchantName = $request->input('merchant_name');

                Log::info("processCheckout: totalAmountFromForm = $totalAmount, merchantNameFromForm = $merchantName");
                // Log::info("processCheckout: totalAmount = $totalAmount, merchantName = $merchantName");
        
        
                // Use the data from the form if available, otherwise use the parameters
                // $totalAmount = $totalAmount ?: $totalAmount;
                // $merchantName = $merchantName ?: $merchantName;

                Log::info("processCheckout (final): totalAmount = $totalAmount, merchantName = $merchantName");
                $banks = [
                    ['icon' => 'https://is1-ssl.mzstatic.com/image/thumb/Purple122/v4/95/41/83/954183ef-8454-58b8-4244-2264236dd2fe/AppIcon-1x_U007emarketing-0-5-0-85-220.png/1200x630wa.png', 'name' => 'tele birr', 'type' => 'credit_card'],
                    ['icon' => 'https://is4-ssl.mzstatic.com/image/thumb/Purple122/v4/4c/a0/c6/4ca0c64a-568f-fff4-43fa-150e613e52a9/AppIcon-1-0-0-1x_U007emarketing-0-0-0-10-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/1200x630wa.png', 'name' => 'CBE', 'type' => 'credit_card'],
                    ['icon' => 'https://media-exp1.licdn.com/dms/image/C4D0BAQHiPeY0n71rsw/company-logo_200_200/0/1581671082683?e=2159024400&v=beta&t=UjZySm44EpMF7TkV4jgnh5yTMaWp2uTZ-KChflc4Z2A', 'name' => 'BOA', 'type' => 'bank_transfer'],
                    // Add more banks as needed
                ];

        
        // return redirect()->route('showCheckout', ['totalAmount' => $totalAmount, 'merchantName' => $merchantName]);
        return view('checkout.checkout', compact('merchantName', 'totalAmount', 'banks'));

        




        // return redirect()->route('showCheckout')->with([
        //     'totalAmount' => $totalAmount,
        //     'merchantName' => $merchantName,
        // ]);
    }


    public function showForms()
    {
        return view('checkout.form');
    }
    public function handleForm(Request $request)
    {
        $formData = $request->all();

        // Send JSON data to the other application using an API endpoint
        $response = Http::post('http://127.0.0.1:8001/api/receive-data', [
            'data' => $formData,
            'message' => 'Data received successfully from Sender',
        ]);

        // Redirect to the form with the response from the receiver
        return redirect()->route('form.show')->with('response', $response->json());
    }

    public function processPayment(Request $request)
    {
        // Handle payment processing logic here
    }

    /**
     * @return \Illuminate\View\View
     */
    public function loginInsteadUnlock()
    {
        Session::remove('username');
        Session::remove('profile_image');
        return $this->_loginController->showLoginForm();
    }
}
