<?php

namespace App\Http\Controllers\Api;

use App\Helpers\IStatuses;
use App\Helpers\ITransactionTypes;
use App\Http\Repositories\TelecomCompanyRepo;
use App\Http\Services\TransactionService;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Models\TelecomCompany;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

/**
 * @var MobileTopUpController
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */

class MobileTopUpController extends Controller
{
    /**
     * @var TelecomCompanyRepo $_telecomRepo
     */
    private TelecomCompanyRepo $_telecomRepo;

    /**
     * @var TransactionService $_transactionService
     */
    private TransactionService $_transactionService;

    /**
     * @param TelecomCompanyRepo $_telecomRepo
     * @param TransactionService $_transactionService
     */
    public function __construct(
        TelecomCompanyRepo $_telecomRepo,
        TransactionService $_transactionService
    )
    {
        parent::__construct();
        $this->_telecomRepo = $_telecomRepo;
        $this->_transactionService = $_transactionService;
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function index(Request $request)
    {
        $companies = $this->_telecomRepo->all();
        return GeneralHelper::SEND_RESPONSE_API($request,$companies,config('constants.generalMessages.mobile_topUp_found'));
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     */
    public function mobileTopUp(Request $request)
    {
        $validate = \Validator::make($request->all(),[
           'company_id'     =>  'required',
           'mobile_number'  =>  'required|numeric|digits:10',
           'amount'         =>  'required|numeric|gt:0',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            $company = $this->_telecomRepo->model()->where('id',$request->company_id)->first();
            if ($company)
            {
                $transaction = $this->_transactionService->createTransaction($this->_filterCreateMobileTopUpTransactionRequest($request->all()));
                $transaction->transactionDetail()->create($this->_filterCustomerTransactionRequest($request->all()));
                $summary     = $this->_makeSummary($request->all(),$company->name,$transaction->trx_id);
                return GeneralHelper::SEND_RESPONSE_API($request,$summary,config('constants.generalMessages.mobile_topUp_purchased_credit'));
            }
            else
                return GeneralHelper::SEND_RESPONSE_API($request,false,null,config('constants.generalMessages.mobile_topUp_not_found'));

        }
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterCreateMobileTopUpTransactionRequest($request)
    {
        return [
            'customer_id'       =>  GeneralHelper::USER('id'),
            'transaction_type'  =>  $this->_transactionService->getTransactionType('name',ITransactionTypes::TOP_UP)->id,
            'debit'             =>  0,
            'credit'            =>  $request['amount'],
            'type'              =>  IStatuses::WITHDRAW,
            'trx_id'            =>  GeneralHelper::STR_RANDOM(8),
            'status'            =>  IStatuses::TRANSACTION_SUCCESS,
        ];
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterCustomerTransactionRequest($request)
    {
        GeneralHelper::CUSTOMER_BALANCE_UPDATE($request['amount']);
        return [
            'sender_id'           =>  GeneralHelper::USER('id'),
            'remaining_balance'   =>  GeneralHelper::CUSTOMER_REMAINING_BALANCE($request['amount'])
        ];
    }

    /**
     * @param $request
     * @param $company
     * @return array
     */
    private function _makeSummary($request,$company,$trx_id)
    {
        return [
            'from' => GeneralHelper::USER('name'),
            'receiver_mobile' => $request['mobile_number'],
            'amount'  =>  $request['amount'],
            'telecom_company' => ucfirst($company),
            'trx_id'    =>  $trx_id
        ];
    }
}
