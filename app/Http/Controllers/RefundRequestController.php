<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Invoice;
use App\Models\RefundRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RefundRequestController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveRefundRequest(Request $request)
    {
        $invoiceId = $request->invoice_no;
        $reason = $request->reason;
        $numericPart = preg_replace("/[^0-9]/", "", $invoiceId);

        $invoice_id = ltrim($numericPart, '0');
        $invoice_data = Invoice::find($invoice_id);

        if (empty($invoice_data)) {
            return redirect()->back()->with('error', config('constants.generalMessages.invoiceNotFound'));
        }

        $check_refund = RefundRequest::where('invoice_no',$invoice_data->id)->first();
        if (isset($check_refund) && $check_refund->status != 'complete')
        {
            return redirect()->back()->with('error', 'Refund Request Already Been generated against this invoice.');
        }else{
            $route = 'refund.request.otp.view';

            if ($invoice_data->status) {
                return redirect()->back()->with('error', config('constants.generalMessages.notRefund'));
            }

            $refund_request = new RefundRequest([
                'invoice_no' => $invoice_data->id,
                'reason' => $reason,
                'otp' => 1234
            ]);
            $refund_request->save();

            return redirect()->route($route,['request_id' => encrypt($refund_request)]);
        }


    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function otpView(Request $request)
    {
        $refund_request = decrypt($request->request_id);
        $request_id = $refund_request->id;
        return view('frontend.refund-otp',compact('request_id'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function verifyOtp(Request $request)
    {
        $otp = $request->first . $request->second . $request->third . $request->fourth;
        $id = $request->request_id;

        $refund_request = RefundRequest::find($id);

        if ($otp == $refund_request->otp) {
            $verify_user = $refund_request->update(['is_verified' => 1]);
            if ($verify_user)
                return GeneralHelper::SEND_RESPONSE($request, true, 'customer.support', config('constants.generalMessages.refund_otp_match'));
        }
        return GeneralHelper::SEND_RESPONSE($request, null, '', '', config('constants.generalMessages.otp_not_matched'));
    }
}
