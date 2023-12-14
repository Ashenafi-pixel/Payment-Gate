<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Contracts\IUserServiceContract;
use Illuminate\Contracts\Foundation\Application;

/**
 * @package   UserVerifyController
 * @author    Shaarif@xintsolutions.com
 */
class UserVerifyController extends Controller
{
    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    #Views
    const OTP_VIEW = 'auth.passwords.otp';

    const CUSTOMER_DASHBOARD_ROUTE = IUserRole::CUSTOMER_ROLE . '.index';

    /**
     * @param IUserServiceContract $_userService
     */
    public function __construct(IUserServiceContract $_userService)
    {
        parent::__construct();
        $this->_userService = $_userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function showCustomerVerifyForm()
    {
        $customer = GeneralHelper::USER();
        return view(self::OTP_VIEW, compact('customer'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function resendVerifyOtp(Request $request)
    {
        GeneralHelper::USER()->sendVerifyOtpMail();
        return GeneralHelper::SEND_RESPONSE($request, true, null, config('constants.generalMessages.otp_resend'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|void
     */
    public
    function verifyCustomerOtp(Request $request)
    {
        $otp = $request->first . $request->second . $request->third . $request->fourth;
        if ($otp == GeneralHelper::USER('email_otp')) {
            $verify_user = $this->_userService->update(GeneralHelper::USER('id'), ['email_otp' => null, 'is_verified' => true]);
            if ($verify_user)
                return GeneralHelper::SEND_RESPONSE($request, true, self::CUSTOMER_DASHBOARD_ROUTE, config('constants.generalMessages.otp_match'));
        }
        return GeneralHelper::SEND_RESPONSE($request, null, '', '', config('constants.generalMessages.otp_not_matched'));
    }
}
