<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\GeneralHelper;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use App\Rules\MatchOldPin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    /**
     * @param IUserServiceContract $userService
     */
    public function __construct(IUserServiceContract $userService)
    {
        parent::__construct();
        $this->_userService = $userService;
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     */
    public function setPin(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'pin_code'  =>  'required|numeric|digits:6',
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            $pin = $request->pin_code;
            $auth_user = GeneralHelper::USER();
            $set_pin = $this->_userService->setPin($pin);
            if ($set_pin){
                return GeneralHelper::SEND_RESPONSE_API($request,$auth_user,config('constants.generalMessages.set_pin'));
            }else{
                return GeneralHelper::SEND_RESPONSE_API($request,false, false,config('constants.generalMessages.not_set_pin'));
            }
        }
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse|RedirectResponse|Redirector
     */
    public function resetPin(Request $request)
    {
        $auth_user = GeneralHelper::USER();

        $validate = Validator::make($request->all(),[
            'old_pin_code' =>  ['required', new MatchOldPin($auth_user)],
            'pin_code'     =>  ['required', 'digits:6','numeric'],
        ]);
        if ($validate->fails())
            return GeneralHelper::VALIDATION_ERROR_RESPONSE($request,$validate->errors());
        else{
            $pin = $request->pin_code;
            $set_pin = $this->_userService->setPin($pin);
            if ($set_pin){
                $user = GeneralHelper::USER_VERIFY(['id' => $auth_user->id]);
                return GeneralHelper::SEND_RESPONSE_API($request,$user,config('constants.generalMessages.update_pin'));
            }else{
                return GeneralHelper::SEND_RESPONSE_API($request,false, false,config('constants.generalMessages.not_update_pin'));
            }
        }
    }
}
