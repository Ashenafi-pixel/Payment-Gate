<?php

namespace App\Http\Middleware;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Helpers\IUserStatuses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VerifyDocument
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
        $role = GeneralHelper::WHO_AM_I();
        if ($role == IUserRole::MERCHANT_ROLE) {
            if (Auth::check() && (isset(Auth::user()->merchantDetail) && Auth::user()->merchantDetail->status == IUserStatuses::APPROVED))
                return $next($request);
            else {
                return GeneralHelper::SEND_RESPONSE(
                    $request,
                    false,
                    IUserRole::MERCHANT_ROLE.'.approval.documents',
                    null,
                    config('constants.generalMessages.document_approval'));
            }
        }
        else{
            if (Auth::check() && ( isset(Auth::user()->customerDetail) && Auth::user()->customerDetail->status == IUserStatuses::APPROVED))
                return $next($request);
            else {
                return GeneralHelper::SEND_RESPONSE(
                    $request,
                    false,
                    IUserRole::CUSTOMER_ROLE.'.approval.documents',
                    null,
                    config('constants.generalMessages.document_approval'));
            }
        }
    }
}
