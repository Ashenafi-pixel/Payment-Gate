<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Models\DummyAccounts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

/**
 * @var DocumentController
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class DocumentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function uploadDocuments(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function dummyData(Request $request)
    {
        $dummy_data = DummyAccounts::all();
        return GeneralHelper::SEND_RESPONSE_API($request,$dummy_data,config('constants.generalMessages.dummy_account_found'));
    }
}
