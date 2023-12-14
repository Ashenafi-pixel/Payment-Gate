<?php

namespace App\Http\Middleware;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()){
            if (GeneralHelper::REQUEST_FROM_API($request))
                return GeneralHelper::SEND_RESPONSE_API(
                    $request,
                    false,
                    null,
                    'Session expired.'
                );
            else
                return GeneralHelper::SEND_RESPONSE(
                    $request,
                    false,
                    'login',
                    null,
                    'Session expired.'
                );
        }

        if (GeneralHelper::USER()->is_verified)
            return $next($request);

        else {
            GeneralHelper::USER()->sendVerifyOtpMail();
            if (GeneralHelper::REQUEST_FROM_API($request))
                return GeneralHelper::SEND_RESPONSE_API(
                    $request,
                    false,
                    null,
                    config('constants.generalMessages.verify_account'));
            else
                return GeneralHelper::SEND_RESPONSE(
                    $request,
                    false,
                    IUserRole::CUSTOMER_ROLE.'.profile.verify.otp.form',
                    null,
                    config('constants.generalMessages.verify_account'));
        }
    }
}
