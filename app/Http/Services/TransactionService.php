<?php

namespace App\Http\Services;

use App\Helpers\GeneralHelper;
use App\Helpers\IStatuses;
use App\Helpers\ITransactionTypes;
use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Repositories\InvoiceRepo;
use App\Http\Repositories\TransactionRepo;
use App\Http\Repositories\TransactionTypeRepo;
use App\Http\Repositories\UserRepo;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UtilityPayment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @var TransactionService
 * @author Shaarif <m.shaarif@xintsolutions.com>
 */
class TransactionService implements ITransactionServiceContract
{

    /**
     * @var TransactionRepo $_transactionRepo
     */

    private UserRepo $_userRepo;

    /**
     * @var TransactionRepo
     */
    private TransactionRepo $_transactionRepo;

    /**
     * @var InvoiceRepo $_invoiceRepo
     */
    private InvoiceRepo $_invoiceRepo;

    /**
     * @var TransactionTypeRepo
     */
    private TransactionTypeRepo $_transactionTypeRepo;

    /**
     * @param TransactionRepo $_transactionRepo
     */
    public function __construct(
        TransactionRepo     $_transactionRepo,
        UserRepo            $_userRepo,
        InvoiceRepo         $invoiceRepo,
        TransactionTypeRepo $_transactionTypeRepo,
    )
    {
        $this->_userRepo = $_userRepo;
        $this->_invoiceRepo = $invoiceRepo;
        $this->_transactionRepo = $_transactionRepo;
        $this->_transactionTypeRepo = $_transactionTypeRepo;
    }

    /**
     * @param $array
     * @return object
     */
    public function createTransaction($array, $merchantId = null): object
    {
        return $this->_userRepo->findById($merchantId ?? auth()->id())->Transaction()->create($array);
    }

    /**
     * @param $id
     * @return object
     */
    public function getTransactionById($id)
    {
        return $this->_transactionRepo->findById($id);
    }

    /**
     * @param $key
     * @param $value
     * @return TransactionType
     */
    public function getTransactionType($key, $value): TransactionType
    {
        return TransactionType::where($key, $value)->first();
    }

    /**
     * @param $trx
     * @return mixed
     */
    public function getTransactionByTrxId($trx): mixed
    {
        return $this->_transactionRepo->findByClause(['trx_id' => $trx])->first();
    }

    /**
     * @param $clause
     * @param $data
     * @return bool
     */
    public function updateTransaction($clause, $data): bool
    {
        return $this->_transactionRepo->updateByClause($clause, $data);
    }

    /**
     * @return mixed
     */
    public function getTransaction(): mixed
    {
        return $this->_transactionRepo->model()->with('customer','transactionDetail', 'transactionType')->where('customer_id', Auth::user()->id)->get();
    }

    /**
     * @param $array
     * @param $response
     * @return void
     */
    public function storeUtilityPayments($array, $response)
    {
        $transaction = $this->createTransaction($array);
        $utility_payment = UtilityPayment::create($this->_filterApiRequest($response, $transaction->id));
        $data = [
            'manifest_id' => $utility_payment->manifest_id,
            'bill_id' => $utility_payment->bill_id,
            'bill_desc' => $response->bill_desc ?? $response['bill_desc'],
            'amount_due' => $response->amount_due ?? $response['amount_due'],
            'reason' => $response->reason ?? $response['reason'],
        ];
        return $data;
    }

    /**
     * @param $request
     * @param $trans_id
     * @return array
     */
    private function _filterApiRequest($request, $trans_id)
    {
        return [
            'transaction_id' => $trans_id,
            'manifest_id' => $request->manifest_id ?? $request['manifest_id'],
            'bill_id' => $request->bill_id ?? $request['bill_id'],
            'name' => $request->name ?? $request['name'],
            'amount_due' => $request->amount_due ?? $request['amount_due'],
            'response_object' => json_encode($request),
            'due_date' => !empty($request->due_dt) ? date('Y-m-d h:i:s', strtotime($request->due_dt)) : date('Y-m-d h:i:s', strtotime($request['due_dt'])),
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUtilityPaymentByBillId($bill_id): mixed
    {
        return UtilityPayment::where('bill_id', $bill_id)->first();
    }

    /**
     * @param $request
     * @param $invoice
     * @return object
     */
    public function payInvoiceTransaction($request, $invoice, $paymentResponse = null): object
    {
        $transaction = $this->createTransaction($this->_filterCreateTransactionRequest($request, $invoice, $paymentResponse), $invoice->merchant_id);
        if ($transaction)
            # updating invoice as paid and inaccessible
            $updateInvoice = $this->_invoiceRepo->update($invoice->id, ['status' => false]);
        return $transaction;
    }

    /**
     * @param $request
     * @param $invoice
     * @param $paymentResponse
     * @return array
     */
    private function _filterCreateTransactionRequest($request, $invoice, $paymentResponse): array
    {
        return [
            'customer_id' => $invoice->customer_id,
            'gateway_id' => $request['payment-method'] ?? $request['payment_method'],
            'invoice_id' => $invoice->id,
            'transaction_type' => $this->_transactionTypeRepo->findByWhereClause(['name' => ITransactionTypes::INVOICE])->id,
            'debit' => $invoice->amount,
            'type' => IStatuses::DEPOSIT,
            'status' => IStatuses::TRANSACTION_SUCCESS,
            'trx_id' => GeneralHelper::STR_RANDOM(10),
            'payment_response' => !empty($paymentResponse) ? json_encode($paymentResponse) : null,
        ];
    }

    /**
     * @param $merchant
     * @return mixed
     */
    public function getMerchantsAllTransactions($merchant = null): mixed
    {
        $user = $merchant ?? GeneralHelper::USER();
        return $user->merchantTransactions()->with('transactionType', 'customer')->latest()->get();
    }

    /**
     * @return mixed
     */
    public function getAllMerchantsTransactions(): mixed
    {
        $transactions = $this->_invoiceRepo->model()
                        ->whereHas('invoiceTransaction')
                        ->with('merchant','invoiceTransaction', 'invoiceTransaction.transactionType','invoiceTransaction.transactionGateway', 'invoiceTransaction.customer')
                        ->latest()->get();
        return $transactions;
    }

    /**
     * @return mixed
     */
    public function getCustomerAllTransactionCount()
    {
        return $this->getTransaction()->count();
    }

    /**
     * @return array
     */
    public function getCustomerTransactionAmount( $customer = null )
    {
        $id = $customer->id ?? Auth::id();
        $data['debit'] = (int)$this->_transactionRepo->model()
            ->where('customer_id', $id)->sum('debit');
        $data['credit'] = (int)$this->_transactionRepo->model()
            ->where('customer_id', $id)->sum('credit');
        $data['total'] = $data['debit'] + $data['credit'];
        return $data;
    }

    /**
     * @return mixed
     */
    public function getAllCustomerTransactions(): mixed
    {
        return $this->_transactionRepo->model()->with('customer','transactionDetail', 'transactionType')->get();
    }

    /**
     * @return mixed
     */
    public function getAllTransactionTypes(): mixed
    {
        return $this->_transactionTypeRepo->all();
    }

    /**
     * @param $id
     * @return true
     */
    public function transactionTypeExist($id): bool
    {
        $query = $this->_transactionTypeRepo->findByWhereClause(['id'=> $id]);
        return  $query ? true : false;
    }

    /**
     * @param $request
     * @return false|object
     */
    public function refundTransaction($request)
    {
        $transaction = $this->getTransactionById($request->transaction_id);
        $invoice_debit = $this->_transactionRepo->model()->where('invoice_id',$transaction->invoice_id)->sum('debit');
        $invoice_credit = $this->_transactionRepo->model()->where('invoice_id',$transaction->invoice_id)->sum('credit');
        $remaining_amount = $invoice_debit - $invoice_credit;
        if ($request->payment == 'partialRefund' && $remaining_amount >= $request->partialAmount){
            return $this->createTransaction($this->_filterCreateRefundTransactionRequest($request,$transaction));
        }elseif($request->payment == 'completeRefund'){
            return $this->createTransaction($this->_filterCreateRefundTransactionRequest($request,$transaction,$remaining_amount));
        }else{
            return false;
        }
    }

    /**
     * @param $request
     * @param $transaction
     * @param $remaining_amount
     * @return array
     */
    private function _filterCreateRefundTransactionRequest($request, $transaction, $remaining_amount = null): array
    {
        return [
            'customer_id' => $transaction->customer_id,
            'gateway_id' => $request->transfer == 'card' ? 1 : 2,
            'invoice_id' => $transaction->invoice_id,
            'transaction_type' => $this->_transactionTypeRepo->findByWhereClause(['name' => ITransactionTypes::REFUND])->id ?? 0,
            'credit' => $request->payment == 'partialRefund' ? $request->partialAmount : $remaining_amount,
            'type' => IStatuses::WITHDRAW,
            'status' => IStatuses::TRANSACTION_SUCCESS,
            'trx_id' => GeneralHelper::STR_RANDOM(10),
            'payment_response' => !empty($paymentResponse) ? json_encode($paymentResponse) : null,
            'refund_type' => $request->payment == 'completeRefund' ? 'complete' : 'partial',
            'is_refund' => 1,
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function transactionStatusCount($request)
    {
        $day = $request->transaction_day;
        $month = $request->transaction_month;
        $year = $request->transaction_year;

        $query = $this->_transactionRepo->model()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status');

        $query->when($day, function ($query) use ($day) {
            $query->whereDay('created_at', $day);
        });
        $query->when($month, function ($query) use ($month) {
            $monthNumeric = date('m', strtotime($month));
            $query->whereMonth('created_at', $monthNumeric);
        });
        $query->when($year, function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        });

        $transaction = $query->get();

        $status = count($transaction->pluck('status')) > 0 ? $transaction->pluck('status') : ['Data Not Found'];
        $total = count($transaction->pluck('total')) > 0 ? $transaction->pluck('total') : ['100'];

        return compact('status', 'total');
    }

    /**
     * @param $request
     * @return array
     */
    public function transactionPaymentMethodCount($request)
    {
        $day = $request->payment_method_day;
        $month = $request->payment_method_month;
        $year = $request->payment_method_year;

        $query = $this->_transactionRepo->model()
            ->select('gateways.name as gateway_name', DB::raw('count(*) as total'))
            ->join('gateways', 'transactions.gateway_id', '=', 'gateways.id')
            ->whereNotNull('gateway_id')
            ->groupBy('gateways.name');

        $query->when($day, function ($query) use ($day) {
            $query->whereDay('transactions.created_at', $day);
        });

        $query->when($month, function ($query) use ($month) {
            // Ensure $month contains valid month names before converting to numeric.
            $monthNumeric = date('m', strtotime($month));
            $query->whereMonth('transactions.created_at', $monthNumeric);
        });

        $query->when($year, function ($query) use ($year) {
            $query->whereYear('transactions.created_at', $year);
        });

        $gatewayCounts = $query->get();

        $name = count($gatewayCounts->pluck('gateway_name')) > 0 ? $gatewayCounts->pluck('gateway_name') : ['Data Not Found'];
        $total = count($gatewayCounts->pluck('total')) > 0 ? $gatewayCounts->pluck('total') : ['0'];

        return compact('name','total');
    }

    /**
     * @param $request
     * @return array
     */
    public function merchantTransactionStatusCount($request)
    {
        $day = $request->transaction_day;
        $month = $request->transaction_month;
        $year = $request->transaction_year;

        $query = $this->_transactionRepo->model()
            ->select('status', DB::raw('count(*) as total'))
            ->where('customer_id',Auth::id())
            ->groupBy('status');

        $query->when($day, function ($query) use ($day) {
            $query->whereDay('created_at', $day);
        });
        $query->when($month, function ($query) use ($month) {
            $monthNumeric = date('m', strtotime($month));
            $query->whereMonth('created_at', $monthNumeric);
        });
        $query->when($year, function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        });

        $transaction = $query->get();

        $status = count($transaction->pluck('status')) > 0 ? $transaction->pluck('status') : ['Data Not Found'];
        $total = count($transaction->pluck('total')) > 0 ? $transaction->pluck('total') : ['100'];

        return compact('status', 'total');
    }

    /**
     * @param $request
     * @return array
     */
    public function merchantTransactionPaymentMethodCount($request)
    {
        $day = $request->payment_method_day;
        $month = $request->payment_method_month;
        $year = $request->payment_method_year;

        $query = $this->_transactionRepo->model()
            ->select('gateways.name as gateway_name', DB::raw('count(*) as total'))
            ->join('gateways', 'transactions.gateway_id', '=', 'gateways.id')
            ->whereNotNull('gateway_id')
            ->groupBy('gateways.name');

        $query->when($day, function ($query) use ($day) {
            $query->whereDay('transactions.created_at', $day);
        });

        $query->when($month, function ($query) use ($month) {
            // Ensure $month contains valid month names before converting to numeric.
            $monthNumeric = date('m', strtotime($month));
            $query->whereMonth('transactions.created_at', $monthNumeric);
        });

        $query->when($year, function ($query) use ($year) {
            $query->whereYear('transactions.created_at', $year);
        });

        $gatewayCounts = $query->get();

        $name = count($gatewayCounts->pluck('gateway_name')) > 0 ? $gatewayCounts->pluck('gateway_name') : ['Data Not Found'];
        $total = count($gatewayCounts->pluck('total')) > 0 ? $gatewayCounts->pluck('total') : ['0'];

        return compact('name','total');
    }

}
