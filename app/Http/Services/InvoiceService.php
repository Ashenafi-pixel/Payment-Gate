<?php

namespace App\Http\Services;

use App\Dispatchers\MailEventsDispatcher;
use App\Helpers\GeneralHelper;
use App\Http\Contracts\IInvoiceContract;
use App\Http\Contracts\IInvoiceServiceContract;
use App\Http\Repositories\InvoiceRepo;

/**
* @var InvoiceService
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class InvoiceService implements IInvoiceServiceContract
{

    use MailEventsDispatcher;


    /**
     * @var InvoiceRepo
     */
    private InvoiceRepo $_invoiceRepo;

    /**
     * @param InvoiceRepo $_invoiceRepo
     */
    public function __construct(InvoiceRepo $_invoiceRepo)
    {
        $this->_invoiceRepo = $_invoiceRepo;
    }

    /**
     * @param $request
     * @return object
     */
    public function store($request): object
    {
        $createInvoice = $this->_invoiceRepo->create($request);
        $sendSms       = $this->sendInvoiceSMS($request['mobile_number'],encrypt($createInvoice->id));
        return $createInvoice;
    }

    /**
     * @return mixed
     */
    public function getAllMerchantInvoices(): mixed
    {
        if (GeneralHelper::IS_SCHOOL())
            return $this->_invoiceRepo->model()->where([
                'merchant_id'    =>  GeneralHelper::USER('id'),
            ])->whereNull('customer_id')->orderBy('id','desc')->with('student')->get();
        else
            return $this->_invoiceRepo->model()->where([
                'merchant_id'    =>  GeneralHelper::USER('id'),
            ])->whereNull('student_id')->orderBy('id','desc')->with('customer')->get();
    }

    /**
     * @param $invoice_id
     * @return object
     */
    public function invoice($invoice_id): object
    {
        return $this->_invoiceRepo->model()->where('id',$invoice_id)->with('customer')->first();
    }

    /**
     * @return mixed
     */
    public function getAllInvoices(): mixed
    {
        return $this->_invoiceRepo->all();
    }

    /**
     * @return mixed
     */
    public function getAllInvoicesCount():mixed
    {
        return $this->getAllInvoices()->count();
    }

    /**
     * @return mixed
     */
    public function getAllInActiveInvoicesCount():mixed
    {
        return $this->getAllInvoices()->where('status',false)->count();
    }

    /**
     * @return mixed
     */
    public function getAllActiveInvoicesCount():mixed
    {
        return $this->getAllInvoices()->where('status',true)->count();
    }

    /**
     * @param $merchant
     * @return mixed
     */
    public function getMerchantsAllInvoices( $merchant = null):mixed
    {
        $user = $merchant ?? auth()->user();
        return $user->merchantInvoices;
    }

    /**
     * @return mixed
     */
    public function getMerchantsAllInvoicesCount():mixed
    {
        return $this->getMerchantsAllInvoices()->count();
    }

    /**
     * @return mixed
     */
    public function getMerchantsAllActiveInvoices(): mixed
    {
        return $this->getMerchantsAllInvoices()->where('status',1);
    }


    /**
     * @return mixed
     */
    public function getMerchantsAllActiveInvoicesCount(): mixed
    {
        return $this->getMerchantsAllActiveInvoices()->count();
    }

    /**
     * @return mixed
     */
    public function getMerchantsAllInActiveInvoices(): mixed
    {
        return $this->getMerchantsAllInvoices()->where('status',0);
    }

    /**
     * @return mixed
     */
    public function getMerchantsAllInActiveInvoicesCount(): mixed
    {
        return $this->getMerchantsAllInActiveInvoices()->count();
    }

    /**
     * @return mixed
     */
    public function getMerchantsPendingBalance(): mixed
    {
        return $this->getMerchantsAllActiveInvoices()->sum('amount');
    }

    /**
     * @return mixed
     */
    public function getMerchantsAvailableBalance(): mixed
    {
//        $sumOfAmount = $this->getMerchantsAllInActiveInvoices()->sum('amount');
        $sumOfAmount = auth()->user()->Transaction()->sum('debit');
        $transactionSubtractAmount = auth()->user()->Transaction()->sum('credit');
        $totalAmount = $sumOfAmount - $transactionSubtractAmount;
        return $totalAmount;
    }

}
