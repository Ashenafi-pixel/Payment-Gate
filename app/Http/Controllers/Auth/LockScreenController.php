<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Encryption\DecryptException;

class LockScreenController extends Controller
{
    private LoginController $_loginController;

    public function __construct(LoginController $_loginController)
    {
        $this->_loginController = $_loginController;
    }

    public function lockScreen()
    {
        $user = Auth::user();
        Session::put('username', $user->username);
        Session::put('profile_image', $user->image->url);
        Auth::logout();
        return view('auth.passwords.lock-screen');
    }

    public function unLockScreen(Request $request)
    {
        $request->merge(['username' => Session::get('username'), 'login' => Session::get('username')]);
        return $this->_loginController->login($request);
    }

    public function showCheckout(Request $request)
    {
        // Manually set some data for the checkout page
        $merchantName = 'Zmart'; // retrieve from API;
        $totalAmount = 100; // retrieve from API;
    
        // Manually list banks
        $banks = [
            ['icon'=> 'https://example.com/bank1.png', 'name' => 'Bank A', 'type' => 'credit_card'],
            ['icon'=> 'https://example.com/bank2.png', 'name' => 'Bank B', 'type' => 'credit_card'],
            ['icon'=> 'https://example.com/bank3.png', 'name' => 'Bank C', 'type' => 'bank_transfer'],
            // Add more banks as needed
        ];
    
        return view('checkout.checkout', compact('merchantName', 'totalAmount', 'banks'));
    }
    

    public function processPayment(Request $request)
    {
        // Handle payment processing logic here
    }

    public function loginInsteadUnlock()
    {
        Session::remove('username');
        Session::remove('profile_image');
        return $this->_loginController->showLoginForm();
    }

    // Your existing payInvoice method, make sure it returns the necessary data
    private function payInvoice($invoice_id)
    {
        // Your logic to fetch invoice data
        // ...

        return [
            'invoice' => $invoiceData,
            // Add other data as needed
        ];
    }
}
