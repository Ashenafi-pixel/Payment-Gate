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
        Session::put('username',$user->username); # Save data in the session and Logout
        Session::put('profile_image',$user->image->url); # Save data in the session and Logout
        Auth::logout();
        return view('auth.passwords.lock-screen');
    }



    /**
     * @param Request $request
     * @return Response
     */
    public function unLockScreen(Request $request)
    {
        $request->merge(['username' => Session::get('username'),'login' => Session::get('username')]);
        return $this->_loginController->login($request);
    }
    public function showCheckout()
    {
            // Fetch data from API to get merchant's name and total amount
    $merchantName = 'Zmart'; // retrieve from API;
    $totalAmount = 100; // retrieve from API;

    // Manually list banks
    $banks = [
        ['icon'=> 'https://is1-ssl.mzstatic.com/image/thumb/Purple122/v4/95/41/83/954183ef-8454-58b8-4244-2264236dd2fe/AppIcon-1x_U007emarketing-0-5-0-85-220.png/1200x630wa.png','name' => 'tele birr', 'type' => 'credit_card'],
        ['icon'=> 'https://is4-ssl.mzstatic.com/image/thumb/Purple122/v4/4c/a0/c6/4ca0c64a-568f-fff4-43fa-150e613e52a9/AppIcon-1-0-0-1x_U007emarketing-0-0-0-10-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/1200x630wa.png','name' => 'CBE', 'type' => 'credit_card'],
        ['icon'=> 'https://media-exp1.licdn.com/dms/image/C4D0BAQHiPeY0n71rsw/company-logo_200_200/0/1581671082683?e=2159024400&v=beta&t=UjZySm44EpMF7TkV4jgnh5yTMaWp2uTZ-KChflc4Z2A','name' => 'BOA', 'type' => 'bank_transfer'],
        // Add more banks as needed
    ];

    return view('checkout.checkout', compact('merchantName', 'totalAmount', 'banks'));

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
