<?php

namespace App\Http\Controllers\Merchant;

use App\Helpers\IUserRole;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Imports\MerchantCustomerImport;
use App\Http\Contracts\ICustomerServiceContract;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Merchant\Customer\ImportCustomerRequest;
use App\Http\Requests\Merchant\Customer\CreateCustomerRequest;

class CustomerController extends Controller
{

    # Constant View
    const CUSTOMER_INDEX_VIEW   = 'backend.merchant.customers.index';
    const CUSTOMER_CREATE_VIEW  = 'backend.merchant.customers.customer';
    # Customer Route
    const CUSTOMER_INDEX_ROUTE  =   IUserRole::MERCHANT_ROLE.'.customers.index';

    private ICustomerServiceContract $_customerService;

    /**
     * @param ICustomerServiceContract $_customerService
     */
    public function __construct(ICustomerServiceContract $_customerService)
    {
        parent::__construct();
        $this->_customerService = $_customerService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $customers = $this->_customerService->getAllCustomers();
        return view(self::CUSTOMER_INDEX_VIEW,compact('customers'));
    }

    /**
     * @return Application|Factory|View
     */
    public function createCustomerForm()
    {
        return view(self::CUSTOMER_CREATE_VIEW);
    }

    /**
     * @param CreateCustomerRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function saveCustomer(CreateCustomerRequest $request)
    {
        $customer_request = $this->_customerService->saveCustomer($this->_filterCreateCustomerRequest($request->all())) ;
        return $customer_request ? GeneralHelper::SEND_RESPONSE($request,$customer_request,self::CUSTOMER_INDEX_ROUTE,config('constants.generalMessages.customer_create_success')) :
               GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.customer_create_error'));
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterCreateCustomerRequest($request)
    {
        return [
          'name'            =>  $request['name'],
          'email'           =>  $request['email'],
          'mobile_number'   =>  $request['mobile_number'],
          'status'          =>  $request['status'],
        ];
    }

    /**
     * @param ImportCustomerRequest $request
     * @return JsonResponse|RedirectResponse|void
     */
    public function importCustomers(ImportCustomerRequest $request)
    {
        if ($request->hasFile('import_file')){
            $bulk_import = Excel::queueImport(new MerchantCustomerImport(auth()->id()), request()->file('import_file'),'');
            if ($bulk_import)
                return GeneralHelper::SEND_RESPONSE($request,$bulk_import,null,config('constants.generalMessages.import_success'));
            else
                return GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.import_error'));
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function editCustomerForm($id){
        $customer = $this->_customerService->getCustomer(decrypt($id));
        return view(self::CUSTOMER_CREATE_VIEW,compact('customer'));
    }

    /**
     * @param CreateCustomerRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updateCustomer(CreateCustomerRequest $request){
        $customer_request = $this->_customerService->updateCustomer($request);
        return $customer_request ? GeneralHelper::SEND_RESPONSE($request,$customer_request,self::CUSTOMER_INDEX_ROUTE,config('constants.generalMessages.customer_update_success')) :
            GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.customer_update_error'));
    }
}
