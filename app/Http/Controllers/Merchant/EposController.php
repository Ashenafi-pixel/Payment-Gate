<?php

namespace App\Http\Controllers\Merchant;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Contracts\ICustomerServiceContract;
use App\Http\Contracts\IInvoiceServiceContract;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\MerchantCustomer;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EposController extends Controller
{
    private ICustomerServiceContract $_customerService;

    private IInvoiceServiceContract $_invoiceService;

    /**
     * @param ICustomerServiceContract $_customerService
     * @param IInvoiceServiceContract $_invoiceService
     */
    public function __construct(ICustomerServiceContract $_customerService,
                                IInvoiceServiceContract $_invoiceService)
    {
        $this->middleware('guest');
        $this->_customerService = $_customerService;
        $this->_invoiceService  = $_invoiceService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function eposForm(Request $request)
    {
        if (base64_decode($request->get('data'), true)) {
            $data = json_decode(base64_decode($request->get('data')));
            return view('backend.merchant.epos.create-new', compact('data'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeInvoiceFromQr(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        $request->validate([
            'amount'   => 'required',
            'mobile_number' => 'required|min:11|max:11|regex:/^((0)?)(0)(3)([0-9]{9})/',
        ]);

        $customer = MerchantCustomer::create([
                'user_id' => $user->id,
                'name' => $request['customer_name'],
                'mobile_number' => $request['mobile_number'],
                'status' => 'ACTIVE',
            ]);

        if (GeneralHelper::IS_SCHOOL())
            $invoice = $this->_invoiceService->store($this->_filterStudentCreateInvoiceRequest($request->all(),$user,$customer));
        else
            $invoice = $this->_invoiceService->store($this->_filterCreateInvoiceRequest($request->all(),$user,$customer));

        return redirect()->route(IUserRole::MERCHANT_ROLE.'.invoices.pay', [encrypt($invoice->id)]);

    }

    /**
     * @param $request
     * @param $user
     * @param $customer
     * @return array
     */
    private function _filterCreateInvoiceRequest($request,$user,$customer)
    {
        return [
            'merchant_id'   => $user->id,
            'customer_id'   => $customer->id,
            'purpose' => $request['purpose'],
            'amount'  => $request['amount'],
            'name'    => $request['customer_name'],
            'mobile_number'  => $request['mobile_number'],
            'order_id'  => $this->uniqueOrderID('order_id'),
        ];
    }

    /**
     * @param $request
     * @param $user
     * @param $customer
     * @return array
     */
    private function _filterStudentCreateInvoiceRequest($request,$user,$customer)
    {
        return [
            'merchant_id'   => $user->id,
            'student_id'    => $customer->id,
            'purpose' => $request['purpose'],
            'amount'  => $request['amount'],
            'name'    => $request['customer_name'],
            'mobile_number'  => $request['mobile_number'],
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
}
