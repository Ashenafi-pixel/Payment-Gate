<?php

namespace App\Http\Middleware;

use App\Helpers\GeneralHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAuthenticator
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            if ($request->acceptsJson())
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

        if (GeneralHelper::WHO_AM_I() === $role)
            return $next($request);

        if ($request->acceptsJson()) {
            return GeneralHelper::SEND_RESPONSE_API(
                $request,
                false,null,
                "You're unauthorized for this request"
            );
        } else
            return GeneralHelper::SEND_RESPONSE(
                $request,
                false,
                GeneralHelper::REDIRECT_TO(),
                null,
                "You're unauthorized for this request"
            );

    }
}
