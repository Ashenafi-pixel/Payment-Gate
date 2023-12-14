<?php

namespace App\Http\Controllers\Web;

use App\Helpers\GeneralHelper;
use App\Http\Contracts\ICustomerServiceContract;
use App\Http\Contracts\IInvoiceServiceContract;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Services\GatewayService;
use App\Http\Services\InvoiceService;
use App\Http\Services\TransactionService;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{


    # Invoice View's
    const INVOICE_PAY_VIEW = 'frontend.invoice.index';

    /**
     * @var IInvoiceServiceContract
     */
    private IInvoiceServiceContract $_invoiceService;

    /**
     * @var ICustomerServiceContract $_customerService
     */
    private ICustomerServiceContract $_customerService;

    private IUserServiceContract $_userService;

    /**
     * @var GatewayService $_gatewayService
     */
    private GatewayService $_gatewayService;

    /**
     * @var TransactionService $_transactionService
     */
    private TransactionService $_transactionService;

    /**
     * @param IInvoiceServiceContract $_invoiceService
     */
    public function __construct(
        InvoiceService $_invoiceService,
        ICustomerServiceContract $_customerService,
        GatewayService $_gatewayService,
        UserService $_userService,
        TransactionService $_transactionService
    )
    {
        $this->_invoiceService  = $_invoiceService;
        $this->_customerService = $_customerService;
        $this->_gatewayService  = $_gatewayService;
        $this->_userService     = $_userService;
        $this->_transactionService = $_transactionService;
    }

    /**
     * @param $invoice_id
     * @return Application|Factory|View
     */
    public function payInvoiceView($invoice_id)
    {
        try {
            $invoice          = $this->_invoiceService->invoice(decrypt($invoice_id));
            $user             = $this->_userService->find($invoice->merchant_id);
            $merchantGateways = $this->_gatewayService->getMerchantsGateways($user);
            return view(self::INVOICE_PAY_VIEW, get_defined_vars());
        }catch (DecryptException $exception)
        {
            abort(404);
        }
    }

    /**
     * @param $invoice_id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function payInvoice($invoice_id,Request $request)
    {
        # check payment method is PayTabs
        if($request['payment-method'] == 3)
        {
            $data = [
                'invoice_id' => decrypt($invoice_id),
                'payment-method' => $request['payment-method'],
            ];
            $encryptedData = encrypt($data);

            $route = route('pay-tabs-create',['data' => $encryptedData]);

            return response()->json([
                'success' => 'payTabs',
                'url' => $route,
            ]);
        }

        $invoice     = $this->_invoiceService->invoice(decrypt($invoice_id));
        $transaction = $this->_transactionService->payInvoiceTransaction($request->all(),$invoice);
        return GeneralHelper::SEND_RESPONSE($request,$transaction,false,'Your Invoice has been paid');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|never
     */
    public function payTabsCreate(Request $request)
    {
        try {
            $encryptedData = $request['data'];
            $decryptedData = decrypt($encryptedData);
            $paymentMethod = $decryptedData['payment-method'];
            $invoice     = $this->_invoiceService->invoice($decryptedData['invoice_id']);
            if (GeneralHelper::IS_SCHOOL())
                $customer = !empty($invoice->student) ? $invoice->student : null;
            else
                $customer = !empty($invoice->customer) ? $invoice->customer : null;

            return view('frontend.invoice.payTabs', get_defined_vars());
        }catch (DecryptException $exception)
        {
            return abort(404);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function storePayTabs(Request $request)
    {
        $response = $this->sendRequestPayTabs($request->get('qwa'));
        $decodeResponse  = json_decode($response);

        if (empty($response) || $decodeResponse->payment_result->response_status != "A")
            return ['status' => false, 'url' => null, 'error' => 'Payment not completed' ];

        $invoice     = $this->_invoiceService->invoice($request->invoice_id);
        $transaction = $this->_transactionService->payInvoiceTransaction($request->all(),$invoice,$decodeResponse);
        return ['status' => true, 'url' => route('thankyou') ];
    }

    /**
     * @param $request
     * @return bool|string
     */
    private function sendRequestPayTabs($request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://secure-global.paytabs.com/payment/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($request),
            CURLOPT_HTTPHEADER => array(
                'authorization: SHJ9L6KLWJ-J69JJL9T29-D9BB92ND6W',
                'content-type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function callBackPayTabs(Request $request)
    {
        dd($request->toArray());
    }

    /**
     * @return Application|Factory|View
     */
    public function thankyou()
    {
        return view('frontend.thankyou');

    }
}
