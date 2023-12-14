<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use App\Helpers\IUserStatuses;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    const LINK_SENT     = 'Forgot password link has been sent to your email address.';
    const INACTIVE_USER = 'Sorry your account status is inactive. Unable to send reset password request.';

    const FORGOT_PASSWORD_PAGE = 'auth.passwords.forgot';

    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    public function __construct(IUserServiceContract $_userService)
    {
        $this->_userService = $_userService;
    }

    /**
     * Show ForgotPassword Form
     *
     * @return Factory|Application|View
     */
    public function showLinkRequestForm()
    {
        return view(self::FORGOT_PASSWORD_PAGE);
    }

    /**
     * @param ForgotPasswordRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        if($user = $this->_userService->findByEmail($request->get('email'))) {
            if($user->status === IUserStatuses::USER_ACTIVE) {
                $user->remember_token = GeneralHelper::STR_RANDOM(60);
                $user->save();
                $user->sendForgotPasswordLink();
                return GeneralHelper::SEND_RESPONSE($request, true, null, self::LINK_SENT);
            }

            return GeneralHelper::SEND_RESPONSE($request, null, null, null, self::INACTIVE_USER);
        }

        return GeneralHelper::SEND_RESPONSE($request, null);
    }
}
