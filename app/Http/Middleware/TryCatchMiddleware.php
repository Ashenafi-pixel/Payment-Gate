<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TryCatchMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!empty($response->exception)){
            $code = $response->exception->getCode();
            if($code > 0)
            {
                $http_status_code = $response->getStatusCode();
                if($http_status_code == 302 || $http_status_code == 401 || $http_status_code == 403 || $http_status_code == 404 || $http_status_code == 419 || $http_status_code == 429 || $http_status_code == 503){
                    return response()->view('errors.' . $http_status_code);
                }else{
                    return response()->view('errors.500');
                }
            }else{
                return $response;
            }
        }else{
            return $response;
        }
    }
}
