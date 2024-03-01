<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\IMediaType;
use App\Helpers\IUserRole;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Helpers\IUserStatuses;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Contracts\IUserServiceContract;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;

/**
 * @var RegisterController
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */

class RegisterController extends Controller
{

    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    /**
     * @param IUserServiceContract $_userService
     */
    public function __construct(IUserServiceContract $_userService)
    {
        $this->_userService = $_userService;
    }

    /**
     * @param Request $request
     * @return false|JsonResponse|RedirectResponse
     */
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'     => 'required|string|max:255|regex:/^[A-Za-z][A-Za-z\s]*$/',
            'username' => 'required|string|unique:users',
            'mobile_no' => 'required|digits:10',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request, $validate->errors());
        else {
            $user = $this->_filterRegisterRequest($request->all());
            $create_user = $this->_userService->store($user);
            if ($create_user) {
                # Customer Details add
                //will create the object of customer details here
                $create_user->assignRole(IUserRole::CUSTOMER_ROLE);
                $this->guard()->login($create_user);
                //store user image record
                $this->_storeImage($create_user);
                # send otp mail code
                $this->_sendVerificationCode($create_user);
                $create_user->access_token = $create_user->createToken('addisPay')->accessToken;
                return GeneralHelper::SEND_RESPONSE_API($request, $this->__userData($create_user), config('constants.generalMessages.register_success'));
            } else
                return GeneralHelper::SEND_RESPONSE_API($request, null, false, config('constants.generalMessages.register_error'));
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterRegisterRequest($request)
    {
        return [
            'name'      =>  $request['name'],
            'username'  =>  $request['username'],
            'mobile_number' =>  $request['mobile_no'],
            'email'     =>  $request['email'],
            'password'  =>  bcrypt($request['password']),
            'is_first_time' => IUserStatuses::IS_FIRST_TIME,
            'status'    =>  IUserStatuses::USER_NON_ACTIVE,
            'email_otp' => GeneralHelper::RANDOM_NO(),
        ];
    }

    /**
     * @param $user
     *
     * @return array
     */
    private function __userData($user)
    {
        return [
            'id'            => $user->id,
            'name'          => $user->name,
            'email'         => $user->email,
            'status'        => strtoupper(str_replace(' ', '_', $user->status)),
            'username'      => $user->username,
            'mobile_number' => $user->mobile_number,
            'role'          => GeneralHelper::WHO_AM_I($user),
            'access_token'  => $user->access_token,
            'is_first_time' => $user->is_first_time,
            'email_otp'     => $user->email_otp
        ];
    }

    /**
     * @param $user
     * @return mixed
     */
    private function _sendVerificationCode($user)
    {
        return $user->sendVerifyOtpMail($user->email_otp);
    }

    /**
     * @return Guard|StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * @param $user
     * @return mixed
     */
    private function _storeImage($user)
    {
        return $user->image()->create([
            'url'   =>  asset('images/user-img.png'),
            'type'  =>  IMediaType::IMAGE,
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function storeOtp(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required',
            'phone_otp' => 'required'
        ]);

            if (Auth::check()) {
                $user = User::where('mobile_number', $request->input('mobile_number'))->first();
                $user->update(['phone_otp' => $request->input('phone_otp')]);
                return response()->json(['data' => [
                    'message' => 'Otp Saved'
                ]]);
            } else {
            return response()->json(['data' => [
                'message' => 'User not authorized!'
            ]]);
            }
    }
}
