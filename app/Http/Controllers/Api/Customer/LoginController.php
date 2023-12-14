<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\GeneralHelper;
use App\Helpers\IApiLevels;
use App\Helpers\IUserRole;
use App\Helpers\IUserStatuses;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @package Customer/LoginController
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */

class LoginController extends Controller
{

    /**
     * @var IUserServiceContract $_userService
     */
    private IUserServiceContract $_userService;

    public function __construct(UserService $_userService)
    {
        $this->_userService = $_userService;
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     */
    public function login(Request $request)
    {
        $request_login = Validator::make($request->all(),[
           'email'  =>  'required|string',
           'password'  =>  'required|string',
        ]);
        if ($request_login->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$request_login->errors());
        else{
            $attempt_login = \Auth::attempt([
                'email'      =>  $request->email,
                'password'   =>  $request->password,
            ]);
            if ($attempt_login){
                $user = GeneralHelper::USER();
                if (GeneralHelper::WHO_AM_I($user) == IUserRole::CUSTOMER_ROLE)
                {
                    $user['access_token'] = GeneralHelper::USER()->createToken('addisPay')->accessToken;
                    return GeneralHelper::SEND_RESPONSE_API($request,$user,config('constants.generalMessages.login'));
                }
                else{
                    return GeneralHelper::SEND_RESPONSE_API($request,false,null,config('constants.generalMessages.app_rights'));
                }
            }else
                return GeneralHelper::SEND_RESPONSE_API($request,null,'',config('constants.generalMessages.credentials_issue'));
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function logout(Request $request)
    {
        if (\Auth::check())
        {
            $revoke_token = GeneralHelper::USER()->token()->revoke();
            return GeneralHelper::SEND_RESPONSE_API($request,$revoke_token,config('constants.generalMessages.logout_user_success'));
        }else
            return GeneralHelper::SEND_RESPONSE_API($request,false,false,config('constants.generalMessages.logout_user_error'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function resendVerifyOtp(Request $request)
    {
        GeneralHelper::USER()->sendVerifyOtpMail();
        return GeneralHelper::SEND_RESPONSE_API($request,true,config('constants.generalMessages.otp_resend'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector|void
     */
    public function verifyOtp(Request $request)
    {
        if ($request->type == IApiLevels::EMAIL_VERIFY_OTP) {
            if (GeneralHelper::USER('email_otp') == $request->otp) {
                $user = GeneralHelper::USER()->update([
                    'email_otp' => null,
                    'is_verified' => true,
                ]);
                GeneralHelper::USER()->customerDetail()->create([
                   'balance'    =>  10000,
                   'status'    =>  IUserStatuses::APPROVED
                ]);
                return GeneralHelper::SEND_RESPONSE_API($request, $user, config('constants.generalMessages.otp_api_match'));
            } else
                return GeneralHelper::SEND_RESPONSE_API($request, false, null, config('constants.generalMessages.otp_api_not_match'));
        }else{
            return GeneralHelper::SEND_RESPONSE_API($request, false, null, config('constants.generalMessages.type_not_found'));
        }
    }

    /**
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function forgotPassword(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email'         =>  'required',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            $email = $request->email;
            $data = [
                'email' => $email,
            ];
            $user = GeneralHelper::USER_VERIFY($data);
            if ($user){
                Auth::login($user);
                $auth_user = GeneralHelper::USER();
                $auth_user->sendVerifyOtpMail();
                app()->make(UserService::class)->update($auth_user->id,[
                    'is_verified' => 0,
                ]);
                $auth_user['access_token'] = $auth_user->createToken('addisPay')->accessToken;
                return GeneralHelper::SEND_RESPONSE_API($request,$auth_user,config('constants.generalMessages.otp_send'));
            }else{
                return GeneralHelper::SEND_RESPONSE_API($request,false, false,config('constants.generalMessages.user_not_found'));
            }
        }
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     * @throws BindingResolutionException
     */
    public function resetPassword(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'password'   =>  'required|string|min:8|confirmed',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            $password = $request->password;
            $user = GeneralHelper::USER();
            if ($user){
                app()->make(UserService::class)->update($user->id,[
                    'password' => bcrypt($password),
                ]);
                $user->token()->revoke();
                return GeneralHelper::SEND_RESPONSE_API($request,true,config('constants.generalMessages.password_update'));
            }else{
                return GeneralHelper::SEND_RESPONSE_API($request,false, false,config('constants.generalMessages.user_not_found'));
            }
        }
    }
}
