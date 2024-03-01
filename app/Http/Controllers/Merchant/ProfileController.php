<?php

namespace App\Http\Controllers\Merchant;

use App\Helpers\GeneralHelper;
use App\Http\Requests\Merchant\Profile\UpdatePasswordRequest;
use App\Http\Requests\Merchant\Profile\UpdateProfileRequest;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use App\Http\Contracts\IUserServiceContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Profile\UpdateProfilePinRequest;


/**
 * @var         ProfileController
 * @author      Shaarif <m.shaarif@xintsolutions.com>
 */
class ProfileController extends Controller
{

    # Merchant profile View
    const PROFILE_VIEW = 'backend.merchant.profile.edit-profile';
    const PROFILE_ROUTE = 'merchant.profile.view';
    const PROFILE_UPDATE = 'Profile has been updated';
    const PROFILE_PIN_SET = 'Profile Pin has been set successfully';
    const PROFILE_PIN_UPDATE = 'Profile Pin has been updated';
    const PASSWORD_UPDATE = 'Password has been updated';
    const OLD_PASSWORD_ERROR = 'Old Password does not match';

    private IUserServiceContract $_userService;

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
    public function index()
    {
        $user = GeneralHelper::USER();
        return view(self::PROFILE_VIEW, get_defined_vars());
    }

    /**
     * @param UpdateProfileRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $response = $this->_userService->updateMerchant($request);
        return GeneralHelper::SEND_RESPONSE($request, $response, self::PROFILE_ROUTE, self::PROFILE_UPDATE);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if ($response = $this->_userService->updateMerchantPassword($request))
            return GeneralHelper::SEND_RESPONSE($request, $response, self::PROFILE_ROUTE, self::PASSWORD_UPDATE);
        return GeneralHelper::SEND_RESPONSE($request, '', '', '', self::OLD_PASSWORD_ERROR);
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
