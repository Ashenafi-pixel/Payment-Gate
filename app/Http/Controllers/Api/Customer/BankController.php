<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Http\Contracts\IBankContract;
use Illuminate\Http\RedirectResponse;

/**
 * @var BankController
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class BankController extends Controller
{

    private IBankContract $_bankService;

    public function __construct(IBankContract $_bankService)
    {
        parent::__construct();
        $this->_bankService = $_bankService;
    }

    /**
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function index(Request $request)
    {
        $banks = $this->_bankService->getAllBanks();
        return count($banks) > 0
            ?  GeneralHelper::SEND_RESPONSE_API($request,$banks,config('constants.generalMessages.banks_found'))
            : GeneralHelper::SEND_RESPONSE_API($request,$banks,null,config('constants.generalMessages.banks_not_found'));
    }
}
