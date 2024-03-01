<?php

namespace App\Dispatchers;

use App\Helpers\GeneralHelper;
use App\Http\Services\UserService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Http;

/**
* @var MailEventsDispatcher
* @author Shaarif <m.shaarif@xintsolutions.com>
*/

trait MailEventsDispatcher
{

    /**
     * @var array $_data
     */
    private array $_data;

    /**
     * @return bool|mixed
     */
    public function sendForgotPasswordLink(): mixed
    {
        $this->_data = [
            'to'      => $this->email,
            'view'    => 'forgot_password',
            'subject' => 'Forgot Password',

            'params' => [
                'name'  => $this->name,
                'link'  => route('user.reset.password.form', $this->remember_token),
            ]
        ];

        return $this->_dispatchEvent();
    }

    /**
     * @return void
     */
    public function sendEmailVerificationLink(): void
    {
        $this->_data = [
            'to'      => $this->email,
            'view'    => 'forgot_password',
            'subject' => 'Forgot Password',

            'params' => [
                'name'  => $this->name,
                'link'  => route('user.reset.password.form', $this->email_verified_token),
            ]
        ];
    }

    /**
     * @return bool|mixed
     * @throws BindingResolutionException
     */
    public function sendVerifyOtpMail($custom_otp = false): mixed
    {
        $otp = GeneralHelper::RANDOM_NO();
        app()->make(UserService::class)->update(GeneralHelper::USER('id'),[
            'email_otp' =>  $custom_otp != null ? $custom_otp : $otp,
        ]);
        $this->_data = [
            'to'        =>  GeneralHelper::USER('email'),
            'view'      =>  'email_verification',
            'subject'   =>  'OTP verification',

            'params'    =>  [
                'otp'   =>  $otp,
                'name'  =>  GeneralHelper::USER('name'),
            ],
        ];

        return $this->_dispatchEvent();
    }

    /**
     * @return bool|mixed
     * @throws BindingResolutionException
     */
    public function sendOtpEmail():mixed
    {
        $otp = GeneralHelper::RANDOM_NO();
        app()->make(UserService::class)->update(GeneralHelper::USER('id'),[
            'email_otp' => $otp,
        ]);
        $this->_data = [
            'to'        =>  GeneralHelper::USER('email'),
            'view'      =>  'request_otp',
            'subject'   =>  'OTP verification',

            'params'    =>  [
                'otp'   =>  $otp,
                'name'  =>  GeneralHelper::USER('name'),
            ],
        ];

        return $this->_dispatchEvent();
    }

    /**
     * Event Dispatcher
     *
     * @return bool|mixed
     */
    private function _dispatchEvent(): mixed
    {
        return GeneralHelper::DISPATCH_MAIL($this->_data);
    }

    /**
     * @return void
     */
    public function sendPasswordSetLink()
    {
        $this->_data = [
            'to'      => $this->email,
            'view'    => 'forgot_password',
            'subject' => 'Set Password',

            'params' => [
                'name'  => $this->name,
                'link'  => route('user.reset.password.form', $this->remember_token),
            ]
        ];

        return $this->_dispatchEvent();
    }

    /**
     * @param $phoneNo
     * @param $invoiceId
     * @return void
     */
    public function sendInvoiceSMS($phoneNo,$invoiceId)
    {
        $response =  Http::get('http://central.mytm.com.pk/api/send-smsApi', [
            'phone' => $phoneNo,
            'msg' => config('constants.generalMessages.invoicePayMessage') . url('/invoices-pay/' . $invoiceId),
        ]);
        \Log::info($response);
    }


}
