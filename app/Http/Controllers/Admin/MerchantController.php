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
use  App\Models\MerchantDetail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
class MerchantController extends Controller
{
    /**
    * @var MerchantController
    * @author Shaarif <m.shaarif@xintsolutions.com>
    */

    # Constants
    const VIEW_ADMIN_MERCHANTS  = 'backend.admin.merchant.all-merchant.index';
    const ALL_ADMIN_MERCHANTS  = 'backend.admin.merchant.all-merchant.merchantDetail';
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
    public function display(){
        $records=MerchantDetail::all();
        return view(self::ALL_ADMIN_MERCHANTS, compact('records'));

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $merchantData = $request->except(['license', 'passport']);

        if ($request->hasFile('license')) {
            $license = $request->file('license');
            $licenseName= date('YmdHi').$license->getClientOriginalName();
            $license-> move(public_path('public/images'), $licenseName);
            $merchantData['license'] = $licenseName;
        }

        if ($request->hasFile('passport')) {
            $passport = $request->file('passport');
            $passportName= date('YmdHi').$passport->getClientOriginalName();
            $passport-> move(public_path('public/images'), $passportName);
            $merchantData['passport'] = $passportName;
        }

        $merchant = $this->_userService->merchantStore($merchantData);

        return GeneralHelper::SEND_RESPONSE(
            $request,
            $merchant,
            self::MERCHANT_INDEX_ROUTE,
            self::CREATE_MERCHANT_MESSAGE
        );
    }
    public function  editMerchant($merchant_id){
        $merchant = User::findOrFail($merchant_id);
        //dd($merchant);
    return view('backend.admin.merchant.all-merchant._form', compact('merchant'));
    }

    public function  deleteMerchant($merchant_id){
        $merchant = User::findOrFail($merchant_id);
        if ($merchant) {

            $merchant->delete();

             }
             Session::flash('success','Merchant deleted successfully!');
             return redirect()->back();
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
