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
}
