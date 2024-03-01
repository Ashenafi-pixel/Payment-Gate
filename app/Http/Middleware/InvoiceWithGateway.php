<?php

namespace App\Http\Middleware;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class InvoiceWithGateway
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (User::IS_GATEWAY_INSTALLED())
            return $next($request);
        else
            return GeneralHelper::SEND_RESPONSE($request,false,IUserRole::MERCHANT_ROLE.'.gateway.index',null,config('constants.generalMessages.gateway_install_error'));
    }
}
