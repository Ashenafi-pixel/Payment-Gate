<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\GeneralHelper;
use App\Helpers\IStatuses;
use App\Helpers\ITransactionTypes;
use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Controllers\Controller;
use App\Models\TransactionType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

/**
 * @author Umer Masood <umer.masood@mytm.pk>
 */
class UtilityPaymentController extends Controller
{
    /**
     * @var ITransactionServiceContract
     */
    private ITransactionServiceContract $_transactionService;

    /**
     * @param ITransactionServiceContract $transactionService
     */
    public function __construct(ITransactionServiceContract $transactionService)
    {
        parent::__construct();
        $this->_transactionService = $transactionService;
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     */
    public function payBillData(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'biller_id' => 'required',
            'bill_id' => 'required',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request, $validate->errors());
        else {
            $billNumber = $this->_billNumberLists();
            if(in_array($request->bill_id,$billNumber))
            {
                $mockObject =  config('derash.mock-object');
                $response['amount_due']  = $mockObject['amount_due'];
                $response['manifest_id'] = $mockObject['manifest_id'];
                $response['bill_id']     = $request->bill_id;
                $response['reason']      = $mockObject['reason'];
                $response['due_dt']      = $mockObject['due_dt'];
                $response['name']        = $mockObject['name'];
                $response['bill_desc']   = $mockObject['bill_desc'];
                $response = json_encode($response);
            }else{
                $response = Http::withHeaders([
                    'api-key' => config('derash.api-key'),
                    'api-secret' => config('derash.api-secret'),
                ])->get('https://api.qa.derash.gov.et/agent/customer-bill-data', [
                    'biller_id' => $request->biller_id,
                    'bill_id' => $request->bill_id,
                ]);
            }


            if (array_key_exists('statusCode', json_decode($response, true))) {
                $response = json_decode($response, true);
                $mockObject =  config('derash.mock-object');
                $response['amount_due']  = $mockObject['amount_due'];
                $response['manifest_id'] = $mockObject['manifest_id'];
                $response['bill_id']     = $request->bill_id;
                $response['reason']      = $mockObject['reason'];
                $response['due_dt']      = $mockObject['due_dt'];
                $response['name']        = $mockObject['name'];
                $response['bill_desc']   = $mockObject['bill_desc'];

                $bill = $this->_transactionService->getUtilityPaymentByBillId($request->bill_id);
                if (isset($bill)) {
                    $status = $bill->transaction->status;
                    return GeneralHelper::SEND_RESPONSE_API($request, false, null, "Bill has been already Process. PLease change bill id.");
                }else{
                    $data = $this->_transactionService->storeUtilityPayments($this->_filterTransactionRequest($response,'CANCELLED'), $response);
                    if ($data)
                        return GeneralHelper::SEND_RESPONSE_API($request, false, null, $response['message']);
                }
            } else {
                $bill = $this->_transactionService->getUtilityPaymentByBillId($request->bill_id);
                if (isset($bill)) {
                    $status = $bill->transaction->status;
                    return GeneralHelper::SEND_RESPONSE_API($request, true,"Bill has been Paid.");
                } else {
                    $data = $this->_transactionService->storeUtilityPayments($this->_filterTransactionRequest(json_decode($response)), json_decode($response));
                    if ($data)
                        return GeneralHelper::SEND_RESPONSE_API($request, $data, config('constants.generalMessages.utility_success'));

                    return GeneralHelper::SEND_RESPONSE_API($request, [], null, config('constants.generalMessages.bill_not_found'));
                }
            }
        }
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function getBillData(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'biller_id' => 'required',
            'bill_id' => 'required',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request, $validate->errors());
        else {
            $mockObject =  config('derash.mock-object');
            $mockObject['bill_id'] = $request->bill_id;
            return GeneralHelper::SEND_RESPONSE_API($request, $mockObject, config('constants.generalMessages.utility_success'));
        }
    }

    /**
     * @param $request
     * @param $status
     * @return array
     */
    private function _filterTransactionRequest($request,$status = null)
    {
        return [
            'transaction_type' => TransactionType::GET_TRANSACTION_TYPE(['name' => ITransactionTypes::UTILITY_BILLS])->id,
            'debit' => 0,
            'credit' => $request->amount_due ?? $request['amount_due'],
            'type' => IStatuses::WITHDRAW,
            'trx_id' => GeneralHelper::STR_RANDOM(8),
            'status' => ($status == 'CANCELLED') ? IStatuses::TRANSACTION_DECLINED : IStatuses::TRANSACTION_PENDING,
        ];
    }

    /**
     * @return array
     */
    private function _billNumberLists()
    {
        $numbers = [];

        for ($i = 20007; $i <= 20060; $i++) {
            $numbers[] = $i;
        }

        return $numbers;
    }
}
