<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use App\Http\Contracts\IUserServiceContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


/**
 * @var CustomerController
 * @author Asif Munir <asif.munir@xintsolutions.com>
 */

class CustomerController extends Controller
{
    # Constants
    const VIEW_ADMIN_CUSTOMERS  = 'backend.admin.customer.all-customer.index';
    const CREATE_ADMIN_CUSTOMER = 'backend.admin.customer.all-customer.create';
    CONST CUSTOMER_INDEX_ROUTE = IUserRole::ADMIN_ROLE.'.customers.index';
    CONST CREATE_CUSTOMER_MESSAGE = 'Customer Created Successfully.';

    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    /**
     * CustomerController constructor.
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
        $customers = $this->_userService->getAllCustomers();
        return view(self::VIEW_ADMIN_CUSTOMERS,compact('customers'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view(self::CREATE_ADMIN_CUSTOMER);
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        $customer = $this->_userService->customerStore($request->all());
        return GeneralHelper::SEND_RESPONSE($request,$customer,self::CUSTOMER_INDEX_ROUTE,self::CREATE_CUSTOMER_MESSAGE);
    }
     public function updateCustomer(Request $request, $customer_id)
    {

       try{
         $merchant = User::findOrFail($customer_id);

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
        $user = CustomerDetail::where('user_id', $merchant->id)->first();
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

        Session::flash('success','Customer Updated successfully! ');
        return redirect()->back();
}
catch (QueryException $e) {
    Session::flash('success','Database error occurred.');
    return redirect()->back();
} catch (\Exception $e) {
    Session::flash('success','Database error occurred.');
    return redirect()->back();
}

    }

    public function  deleteCustomer($merchant_id){
        $merchant = User::findOrFail($merchant_id);
        if ($merchant) {

            $merchant->delete();

             }
             Session::flash('success','Customer deleted successfully!');
             return redirect()->back();
    }

}
