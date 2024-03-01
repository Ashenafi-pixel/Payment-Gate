<?php

namespace App\Http\Controllers\Api;

use App\Helpers\IStatuses;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Contracts\ITransactionServiceContract;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */

class OtpController extends Controller
{
    /**
     * @var ITransactionServiceContract $_transactionService
     */
    private ITransactionServiceContract $_transactionService;

    public function __construct(ITransactionServiceContract $_transactionService)
    {
        parent::__construct();
        $this->_transactionService = $_transactionService;
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws BindingResolutionException
     */
    public function sendTransactionsOtp(Request $request)
    {
        $send_otp = GeneralHelper::SEND_OTP_FOR_API();
        return GeneralHelper::SEND_RESPONSE_API($request,$send_otp,'Otp has been send');
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     */
    public function verifyVerificationOtp(Request $request)
    {
        $validate = \Validator::make($request->all(),[
            'otp'           => 'required',
            'trx_id'        =>  'required',
            'payment_type'  => 'required',
            'account_no'    =>  'required'
        ],[
            'trx_id.required'    =>  'The transaction id is required',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            $verify_otp = GeneralHelper::VERIFY_OTP_FOR_API($request->otp);
            if ($verify_otp){
                $status = $this->_verifyUserTransaction($request->all());
                if ($status){
                    # Update the status of transaction
                    $this->_transactionService->updateTransaction(['trx_id'=>$request->trx_id],
                        ['status'    =>  IStatuses::TRANSACTION_SUCCESS]);
                    # Update the otp of user
                    app()->make(UserService::class)->update(GeneralHelper::USER('id'),[
                        'email_otp' =>  null
                    ]);
                    $transaction = $this->_transactionService->getTransactionByTrxId($request->trx_id);
                    if (isset($transaction->transactionDetail))
                    {
                        $transaction->transactionDetail()->update([
                           'payment_type'       => $request->payment_type,
                           'from_account' =>  $request->account_no
                        ]);
                    }else{
                        $transaction->transactionDetail()->create([
                           'payment_type'           =>  $request->payment_type,
                           'from_account'     =>  $request->account_no
                        ]);
                    }
                    $transaction['transactionDetail'] = $transaction->transactionDetail;
                    return GeneralHelper::SEND_RESPONSE_API($request,$transaction,'Transaction completed');
                }
                else
                    return GeneralHelper::SEND_RESPONSE_API($request,false,null,'No Record found');
            }else
                return GeneralHelper::SEND_RESPONSE_API($request,false,null,'Invalid Otp!');
        }
    }

    /**
     * @param $request
     * @return bool
     */
    private function _verifyUserTransaction($request)
    {
        $transaction = $this->_transactionService->getTransactionByTrxId($request['trx_id']);
        if ($transaction && GeneralHelper::USER('id') == $transaction->customer_id)
            return true;
        else
            return false;
    }

}
