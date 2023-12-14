<?php

namespace App\Http\Controllers\Api;

use App\Helpers\GeneralHelper;
use App\Helpers\IStatuses;
use App\Http\Controllers\Controller;
use App\Http\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{

    /**
     * @var TransactionService $_transactionService
     */
    private TransactionService $_transactionService;

    /**
     * @param TransactionService $_transactionService
     */
    public function __construct(TransactionService $_transactionService)
    {
        parent::__construct();
        $this->_transactionService = $_transactionService;
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     */
    public function initiateTransaction(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'transaction_type' => 'required|numeric',
            'amount'           => 'required|numeric',
            'account_no'       => 'required|numeric',
            'purpose'          => 'required',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            if ($this->_transactionService->transactionTypeExist($request->transaction_type))
            {
                $data = $this->_transactionService->createTransaction($this->_filterInitiateTransaction($request->all()));
                $createTransactionDetail = $data->transactionDetail()->create($this->_filterTransactionDetail($request->all()));
                $data['transactionDetail'] = $createTransactionDetail;
                return GeneralHelper::SEND_RESPONSE_API($request,$data,config('constants.generalMessages.transaction_initiated'));
            }else
                return GeneralHelper::SEND_RESPONSE_API($request,null,null,config('constants.generalMessages.transaction_types_error'));
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterInitiateTransaction($request)
    {
        return [
            'customer_id'       =>  GeneralHelper::USER('id'),
            'transaction_type'  =>  $request['transaction_type'],
            'debit'             =>  0,
            'credit'            =>  $request['amount'],
            'type'              =>  IStatuses::WITHDRAW,
            'trx_id'            =>  GeneralHelper::STR_RANDOM(8),
            'status'            =>  IStatuses::TRANSACTION_PENDING,
        ];
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function getTransactionTypes(Request $request)
    {
        $transaction_types = $this->_transactionService->getAllTransactionTypes();
        return GeneralHelper::SEND_RESPONSE_API($request,$transaction_types,config('constants.generalMessages.transaction_types_found'));
    }

    private function _filterTransactionDetail($request)
    {
        return [
          'reason'       => $request['purpose'],
          'from_account' => $request['account_no'],
        ];
    }
}
