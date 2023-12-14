<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Contracts\IUserServiceContract;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Foundation\Application;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    const LOGIN_ROUTE = 'login';
    # Pages
    const RESET_PASSWORD_PAGE = 'auth.passwords.reset';
    # Messages
    const INVALID_TOKEN      = 'Invalid token cannot processed. Try again';
    const RESET_SUCCESSFULLY = 'Password has been reset successfully.';

    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userServiceContract;

    /**
     * @param IUserServiceContract $_userServiceContract
     */
    public function __construct(IUserServiceContract $_userServiceContract)
    {
        $this->_userServiceContract = $_userServiceContract;
    }

    /**
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo = GeneralHelper::WHO_AM_I().'/dashboard';
    }
    /**
     * Verify token and show form
     *
     * @param Request $request
     * @param string $token
     *
     * @return Application|Factory|JsonResponse|RedirectResponse|View
     */
    public function index(Request $request, string $token)
    {
        if($this->_userServiceContract->findByToken($token) !== null)
            return view(self::RESET_PASSWORD_PAGE)->with('token', $token);

        return GeneralHelper::SEND_RESPONSE($request, null, self::LOGIN_ROUTE, null, self::INVALID_TOKEN);
    }

    /**
     * Change User Password
     *
     * @param ResetPasswordRequest $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $user                     = $this->_userServiceContract->findByToken($request->get('_verification_token'));
        if($user !== null) {
            $user->password       = bcrypt($request->get('password'));
            $user->remember_token = GeneralHelper::STR_RANDOM(60);
            $user->save();
            return GeneralHelper::SEND_RESPONSE($request, true, self::LOGIN_ROUTE, self::RESET_SUCCESSFULLY);
        }
        return GeneralHelper::SEND_RESPONSE($request, null, self::LOGIN_ROUTE, null, self::INVALID_TOKEN);
    }

}
