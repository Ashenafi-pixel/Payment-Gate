<?php

namespace App\Http\Controllers\Merchant;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Requests\RefundRequest;
use \App\Models\RefundRequest as RequestRefund;
use App\Http\Services\GatewayService;
use App\Models\Invoice;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Contracts\IInvoiceServiceContract;
use App\Http\Contracts\ICustomerServiceContract;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Merchant\Invoice\CreateInvoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @var InvoiceController
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class InvoiceController extends Controller
{

    # Invoice View's
    const INVOICE_CREATE_VIEW = 'backend.merchant.invoices.invoice';
    const INVOICE_INDEX_VIEW  = 'backend.merchant.invoices.index';
    const INVOICE_PAY_VIEW = 'frontend.invoice.index';
    const INVOICE_VIEW = 'backend.merchant.invoices.view_invoice';

    /**
     * @var IInvoiceServiceContract
     */
    private IInvoiceServiceContract $_invoiceService;

    /**
     * @var ICustomerServiceContract
     */
    private ICustomerServiceContract $_customerService;

    /**
     * @var GatewayService $_gatewayService
     */
    private GatewayService $_gatewayService;

    /**
     * @var ITransactionServiceContract
     */
    private ITransactionServiceContract $_transactionService;

    /**
     * @param IInvoiceServiceContract $_invoiceService
     * @param ICustomerServiceContract $_customerService
     * @param GatewayService $_gatewayService
     * @param ITransactionServiceContract $_transactionService
     */
    public function __construct(
        IInvoiceServiceContract $_invoiceService,
        ICustomerServiceContract $_customerService,
        GatewayService $_gatewayService,
        ITransactionServiceContract $_transactionService,
    )
    {
        parent::__construct();
        $this->_invoiceService  = $_invoiceService;
        $this->_customerService = $_customerService;
        $this->_gatewayService  = $_gatewayService;
        $this->_transactionService = $_transactionService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $invoices = $this->_invoiceService->getAllMerchantInvoices();
        return view(self::INVOICE_INDEX_VIEW,compact('invoices'));
    }

    /**
     * @return Application|Factory|View
     */
    public function createInvoiceForm()
    {
        if (GeneralHelper::USER('is_school'))
            $customers = $this->_customerService->getAllStudents();
        else
            $customers = $this->_customerService->getAllActiveCustomers();
        return view(self::INVOICE_CREATE_VIEW, compact('customers'));
    }

    /**
     * @param CreateInvoiceRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function saveInvoice(CreateInvoiceRequest $request)
    {
        if (GeneralHelper::IS_SCHOOL())
            $invoice = $this->_invoiceService->store($this->_filterStudentCreateInvoiceRequest($request->all()));
        else
            $invoice = $this->_invoiceService->store($this->_filterCreateInvoiceRequest($request->all()));

        $route = route(IUserRole::MERCHANT_ROLE.'.invoices.pay', [encrypt($invoice->id)]);
        return
            $invoice ? GeneralHelper::SEND_RESPONSE($request,$route,null,config('constants.generalMessages.invoice_create_success')) :
                GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.invoice_create_error'));
    }

    /**
     * @param $invoice_id
     * @return Application|Factory|View
     */
    public function payInvoice($invoice_id)
    {
        try {
            $invoice          = $this->_invoiceService->invoice(decrypt($invoice_id));
            $merchantGateways = $this->_gatewayService->getMerchantsGateways();
            return view(self::INVOICE_PAY_VIEW, get_defined_vars());
        }catch (DecryptException $exception)
        {
            abort(404);
        }
    }

    /**
     * @param Request $request
     * @param $param
     * @return true
     */
    public function checkoutUrl(Request $request, $param)
    {
        return true;
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterCreateInvoiceRequest($request)
    {
        return [
            'merchant_id'   => auth()->id(),
            'customer_id'   => decrypt($request['customer']),
            'purpose' => $request['purpose'],
            'amount'  => $request['amount'],
            'name'    => $request['name'],
            'mobile_number'  => $request['phone'],
            'order_id'  => $this->uniqueOrderID('order_id'),
        ];
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterStudentCreateInvoiceRequest($request)
    {
        return [
            'merchant_id'   => auth()->id(),
            'student_id'    => decrypt($request['customer']),
            'purpose' => $request['purpose'],
            'amount'  => $request['amount'],
            'name'    => $request['name'],
            'mobile_number'  => $request['phone'],
            'order_id'  => $this->uniqueOrderID('order_id'),
        ];
    }

    /**
     * @param $column
     * @return int|null
     */
    private function uniqueOrderID($column){
        $OrderID = $this->createOrderID();
        $check = Invoice::where($column, $OrderID)->first();
        if($check){
            $OrderID = $this->uniqueOrderID($column);
        }
        return $OrderID;
    }

    /**
     * @return int|null
     */
    private function createOrderID()
    {
        return  mt_rand(time(), time());
    }

    /**
     * @param $invoice_id
     * @return Application|Factory|View
     */
    public function viewInvoice($invoice_id)
    {
        $invoice = $this->_invoiceService->invoice(decrypt($invoice_id));
        return view(self::INVOICE_VIEW,compact('invoice'));
    }

    /**
     * @param RefundRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function refundInvoice(RefundRequest $request)
    {
        $refund = $this->_transactionService->refundTransaction($request);

        $route = IUserRole::MERCHANT_ROLE.'.invoices.index';
        return
            $refund ? GeneralHelper::SEND_RESPONSE($request,$refund,$route,config('constants.generalMessages.invoice_refund_success')) :
                GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.invoice_refund_error'));
    }

    /**
     * @return Application|Factory|View
     */
    public function refundRequest()
    {
        $refundRequests = RequestRefund::with(['invoice' => function($q){
            $q->where('merchant_id', Auth::id());
        }])->where('is_verified',true)->get();
        return view('backend.merchant.invoices.refund-request',compact('refundRequests'));
    }


}
