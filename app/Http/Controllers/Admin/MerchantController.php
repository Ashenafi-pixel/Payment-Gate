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
use Illuminate\Support\Facades\Http;
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
        $records=MerchantDetail::all();
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

        $users =  User::join('merchant_details', 'users.id', '=', 'merchant_details.user_id')
       ->select('users.id', 'users.name', 'users.email', 'users.status as user_status', 'merchant_details.company_name', 'merchant_details.company_phone as merchant_phone', 'merchant_details.status as merchant_status', 'merchant_details.passport', 'merchant_details.license', 'merchant_details.license_number')
       ->get();


//return view(self::ALL_ADMIN_MERCHANTS, compact('users'));


       //$users=MerchantDetail::all();

        return view(self::ALL_ADMIN_MERCHANTS, compact('users'));

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
            $licenseName = date('YmdHi') . $license->getClientOriginalName();
            $license->move(public_path('images'), $licenseName);
            $merchantData['license'] = 'images/' . $licenseName; // Update the path in the $merchantData array
        }

        if ($request->hasFile('passport')) {
            $passport = $request->file('passport');
            $passportName = date('YmdHi') . $passport->getClientOriginalName();
            $passport->move(public_path('images'), $passportName);
            $merchantData['passport'] = 'images/' . $passportName; // Update the path in the $merchantData array
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
         // Check if the merchant status is APPROVED, and update the users table
       $s=$request->input('status');
         if ( $s === 'ACTIVE') {
        $user = MerchantDetail::where('user_id', $merchant->id)->first();
        if ($user) {
            $user->status = 'APPROVED';
            $user->save();
        }
        $apiEndpoint = 'https://sms.qa.addissystems.et/api/send-bulk-sms';

// Replace with your actual phone numbers and message
$apiKey='30c57d27443e3d76d4b8c257c0a1f4d163344b14a68e312122';
$data = [
    'phoneNumbers' => [$request->input('mobile_number')],
    'message' => 'Dear esteemed merchant, we are pleased to inform you that your application has been approved.',
];
$headers=[
'Content-Type'=>'application/json',
'x-api-key'=>$apiKey
];

$response = Http::withHeaders($headers)->post($apiEndpoint, $data);
$result='';
// Check the response
if ($response->successful()) {
    // Successful request
    $result = $response->json(); // Get the response as JSON
    //dd($result);
} else {
    // Failed request
    $error = $response->json(); // Get the error response as JSON
    //dd($error);
}
    }

        Session::flash('success','Merchant Updated successfully! '.  $result['message']);
        return redirect()->back();
            }
}
