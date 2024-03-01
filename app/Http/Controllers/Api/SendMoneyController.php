<?php

namespace App\Http\Controllers\Api;

use App\Helpers\GeneralHelper;
use App\Helpers\IStatuses;
use App\Helpers\ITransactionTypes;
use App\Http\Controllers\Controller;
use App\Http\Services\TransactionService;
use App\Models\DummyAccounts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class SendMoneyController extends Controller
{
    /**
     * @var TransactionService $_transactionService
     */
    private TransactionService $_transactionService;

    public function __construct(TransactionService $_transactionService)
    {
        $this->_transactionService = $_transactionService;
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|void
     */
    public function sendMoney(Request $request)
    {
        $validate = Validator::make($request->all(),[
           'bank_id'    => 'required',
           'account_no' => 'required',
           'amount'     => 'required',
           'reason'     => 'required',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            if ($account = $this->_checkAccountExist($request->account_no))
            {
                $transaction = $this->_filterTransactionRequest($request->all());
                $create_transaction  = $this->_transactionService->createTransaction($transaction,$transaction['customer_id']);
                $create_transaction->transactionDetail()->create($this->_filterTransactionCustomer($request->all()));
                $summary     = $this->_makeSummary($account,$request->all(),$create_transaction->trx_id);
                return GeneralHelper::SEND_RESPONSE_API($request,$summary,config('constants.generalMessages.send_money_found'));
            }else
                return GeneralHelper::SEND_RESPONSE_API($request,false,null,config('constants.generalMessages.send_money_not_found'));
        }
    }

    /**
     * @param $account_number
     * @return mixed
     */
    private function _checkAccountExist($account_number)
    {
        return DummyAccounts::where('account_number',$account_number)->first();
    }

    /**
     * @param $account
     * @param $request
     * @return array
     */
    private function _makeSummary($account,$request,$trx_id)
    {
        return [
          'from' => GeneralHelper::USER('name'),
          'to'   => $account->name,
          'receiver_account' => $account->account_number,
          'amount'  =>  $request['amount'],
            'trx_id'    =>  $trx_id
        ];
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterTransactionRequest($request)
    {
        return [
            'customer_id'       =>  GeneralHelper::USER('id'),
            'transaction_type'  =>  $this->_transactionService->getTransactionType('name',ITransactionTypes::MONEY_TRANSFER)->id,
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
    private function _filterTransactionCustomer($request)
    {
        GeneralHelper::CUSTOMER_BALANCE_UPDATE($request['amount']);
        return [
            'sender_id'           =>  GeneralHelper::USER('id'),
            'remaining_balance'   =>  GeneralHelper::CUSTOMER_REMAINING_BALANCE($request['amount']),
            'reason'            =>  $request['reason'] ?? null,
            'from_account'      =>  $request['from_account'] ?? null
        ];
    }

}
