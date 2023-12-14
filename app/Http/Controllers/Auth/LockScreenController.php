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

class LockScreenController extends Controller
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
