<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\GeneralHelper;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Http\Requests\Customer\Profile\UpdateProfileRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\Profile\UpdateProfilePinRequest;

    /**
 * @package ProfileController
 * @author umer.masood@mytm.pk
 */
class ProfileController extends Controller
{

    const PROFILE_VIEW = 'backend.customer.profile.profile-view';
    const PROFILE_ROUTE = 'customer.profile.view';
    const PROFILE_UPDATE = 'Profile has been updated';
    const PROFILE_PIN_SET = 'Profile Pin has been set successfully';
    const PROFILE_PIN_UPDATE = 'Profile Pin has been updated';
    const PASSWORD_UPDATE = 'Password has been updated';
    const OLD_PASSWORD_ERROR = 'Old Password does not match';

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
     * @return Application|Factory|View
     */
    public function index(){

        $user = GeneralHelper::USER();
        return view(self::PROFILE_VIEW,compact('user'));
    }

    /**
     * @param UpdateProfileRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $response   = $this->_userService->updateCustomer($request);
        return GeneralHelper::SEND_RESPONSE($request,$response,self::PROFILE_ROUTE,self::PROFILE_UPDATE);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if ($response = $this->_userService->updatePassword($request))
            return GeneralHelper::SEND_RESPONSE($request,$response,self::PROFILE_ROUTE,self::PASSWORD_UPDATE);
        return GeneralHelper::SEND_RESPONSE($request,'','','',self::OLD_PASSWORD_ERROR);
    }

    /**
     * @param UpdateProfilePinRequest $request
     * @return mixed
     */
    public function setPin(UpdateProfilePinRequest $request)
    {
        $response = $this->_userService->setPin($request->pin);
        return GeneralHelper::SEND_RESPONSE($request,$response,self::PROFILE_ROUTE,self::PROFILE_PIN_SET);
    }

    /**
     * @param UpdateProfilePinRequest $request
     * @return mixed
     */
    public function resetPin(UpdateProfilePinRequest $request)
    {
        $response = $this->_userService->setPin($request->pin);
        return GeneralHelper::SEND_RESPONSE($request,$response,self::PROFILE_ROUTE,self::PROFILE_PIN_UPDATE);
    }
}
