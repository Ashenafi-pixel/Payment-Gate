<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHelper;
use App\Http\Requests\Admin\Profile\UpdateProfilePinRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Contracts\IUserServiceContract;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;

/**
 * @package     ProfileController
 * @author      Shaarif@xintsolutions.com
 */
class ProfileController extends Controller
{

    # Profile view and edit
    const PROFILE_VIEW = 'backend.admin.profile.edit-profile';

    const PROFILE_ROUTE = 'admin.profile.view';

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
    public function index()
    {
        $user = GeneralHelper::USER();
        return view(self::PROFILE_VIEW,compact('user'));
    }

    /**
     * @param UpdateProfileRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $response   = $this->_userService->updateAdmin($request);
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
