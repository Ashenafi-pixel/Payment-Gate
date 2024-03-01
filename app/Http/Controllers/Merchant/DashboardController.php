<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Services\TransactionService;
use App\Models\MerchantEpos;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Services\InvoiceService;
use App\Http\Services\CustomerService;
use Illuminate\Contracts\View\Factory;
use App\Http\Contracts\IInvoiceServiceContract;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Contracts\ICustomerServiceContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\directoryExists;

class DashboardController extends Controller
{

    # Merchant Dashboard View
    const DASHBOARD_VIEW = 'backend.merchant.dashboard';

    /**
     * @var ICustomerServiceContract $_customerService
     */
    private ICustomerServiceContract $_customerService;

    /**
     * @var IInvoiceServiceContract $_invoiceService
     */
    private IInvoiceServiceContract $_invoiceService;

    /**
     * @var ITransactionServiceContract
     */
    private ITransactionServiceContract $_transactionService;

    /**
     * @param CustomerService $_customerService
     * @param InvoiceService $_invoiceService
     * @param TransactionService $_transactionService
     */
    public function __construct(
        CustomerService $_customerService,
        InvoiceService  $_invoiceService,
        TransactionService $_transactionService
    )
    {
        parent::__construct();
        $this->_customerService = $_customerService;
        $this->_invoiceService  = $_invoiceService;
        $this->_transactionService = $_transactionService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $customersCount       = $this->_customerService->getAllMerchantCustomersCount();
        $invoicesCount        = $this->_invoiceService->getMerchantsAllInvoicesCount();
        $pendingInvoicesCount = $this->_invoiceService->getMerchantsAllActiveInvoicesCount();
        $paidInvoicesCount    = $this->_invoiceService->getMerchantsAllInActiveInvoicesCount();
        $pendingBalanceSum    = $this->_invoiceService->getMerchantsPendingBalance();
        $availableBalanceSum  = $this->_invoiceService->getMerchantsAvailableBalance();
        $transactionsCount      = $this->_transactionService->merchantTransactionStatusCount($request);
        $paymentMethodCount     = $this->_transactionService->merchantTransactionPaymentMethodCount($request);
        return view(self::DASHBOARD_VIEW,compact(
            'customersCount',
            'invoicesCount',
            'pendingInvoicesCount',
            'paidInvoicesCount',
            'pendingBalanceSum',
            'availableBalanceSum',
            'transactionsCount',
            'paymentMethodCount',
        ));
    }

    /**
     * @return Application|Factory|View
     */
    public function ePos()
    {
        $merchantId = Auth::user()->id;
        $epose = MerchantEpos::where('merchant_id',$merchantId)->first();
        if(!isset($epose)){
            $todir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
            $logo = $todir.'/public/images/addispay-logo.png';
            $logo = isset($logo) ? $logo : FALSE;

            $json = [
                'merchant_id' => $merchantId ,
                'name' => 'YES',
                'email' =>'YES',
                'phone' =>'YES',
            ];
            $code = route('eposForm').'?data='.base64_encode(json_encode($json));

            header('Content-type: image/png');
            $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|0&chs=500x500&chl='.urlencode($code));
            if($logo !== FALSE){
                $logo = imagecreatefromstring(file_get_contents($logo));

                $QR_width = imagesx($QR);
                $QR_height = imagesy($QR);

                $logo_width = imagesx($logo);
                $logo_height = imagesy($logo);

                // Scale logo to fit in the QR Code
                $logo_qr_width = $QR_width/3;
                $scale = $logo_width/$logo_qr_width;
                $logo_qr_height = $logo_height/$scale;

                imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
            }



            // new code

            $tempName = 'qr_for_merchant_number'.$merchantId.'-addispay.jpg';
            $todir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
            if (!is_dir(public_path('uploads/qrcodes')))
                mkdir(public_path('uploads/qrcodes'),0777,true);
            $path = $todir.'/public/uploads/qrcodes/'.$tempName;
    //                $im = imagecreatetruecolor(100, 100);
            imagetruecolortopalette($QR,false, 100);
            imagepng($QR, $path, 0, NULL);
            imagedestroy($QR);

    //               file_put_contents($path, $qrImage);
            $epose = new MerchantEpos();
            $epose->merchant_id = $merchantId;
            $epose->qr = 'uploads/qrcodes/'.$tempName;;
            $epose->save();
        }
        $merchant_getway_exits = Auth::user()->merchantGateway()->first();
        return view('backend.merchant.epos.index',compact('epose','merchant_getway_exits'));
    }
}
