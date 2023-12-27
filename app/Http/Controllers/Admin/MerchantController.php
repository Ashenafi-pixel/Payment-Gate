<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Contracts\IMerchantDetailServiceContract;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use  App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class MerchantController extends Controller
{
    /**
    * @var MerchantController
    * @author Shaarif <m.shaarif@xintsolutions.com>
    */

    # Constants
    const VIEW_ADMIN_MERCHANTS  = 'backend.admin.merchant.all-merchant.index';
    CONST CREATE_ADMIN_MERCHANT = 'backend.admin.merchant.all-merchant.create';
    const MERCHANT_INDEX_ROUTE = IUserRole::ADMIN_ROLE.'.merchants.index';
    const CREATE_MERCHANT_MESSAGE = 'Merchant Created Successfully.';

    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    /**
     * DashboardController constructor.
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
        $merchants = $this->_userService->getAllMerchants();
        return view(self::VIEW_ADMIN_MERCHANTS,compact('merchants'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view(self::CREATE_ADMIN_MERCHANT);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $merchant = $this->_userService->merchantStore($request->all());
        return GeneralHelper::SEND_RESPONSE($request,$merchant,self::MERCHANT_INDEX_ROUTE,self::CREATE_MERCHANT_MESSAGE);
    }
    public function  editMerchant($merchant_id){
        $merchant = User::findOrFail($merchant_id);
        //dd($merchant);
    return view('backend.admin.merchant.all-merchant._form', compact('merchant'));
    }

    public function updateMerchant(Request $request, $merchant_id)
    {
        $merchant = User::findOrFail($merchant_id);

        // Update the fields
        $merchant->status = $request->input('status');
        $merchant->name = $request->input('name');
        $merchant->email = $request->input('email');
        $merchant->mobile_number = $request->input('mobile_number');

        // Save the changes to the database
        $merchant->save();

        // Display a success flash message
        Alert::success('Success', 'Merchant updated successfully')->persistent(true);

        // Redirect back to the form page
        return view('backend.admin.merchant.all-merchant._form');
    }

}
