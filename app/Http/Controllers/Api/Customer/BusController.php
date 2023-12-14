<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class BusController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function getTransportService(Request $request)
    {
        $response = config('bus');
        return response()->json(['success' => true, 'data' => $response,'errors'=>[],'message'=>'Data Found successfully']);

//            ?  GeneralHelper::SEND_RESPONSE_API($request,config('bus'),'successfully fetch data',null)
//            : GeneralHelper::SEND_RESPONSE_API($request,null,null,'Transport Service Not Found');
    }
}
