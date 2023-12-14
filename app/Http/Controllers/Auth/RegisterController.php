<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\IUserRole;
use App\Helpers\IMediaType;
use Illuminate\Http\Request;
use App\Helpers\IUserStatuses;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Services\RoleService;
use Illuminate\Contracts\View\View;
use App\Http\Repositories\UserRepo;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Foundation\Application;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    const REDIRECTING_CUSTOMER_MSG = 'Redirecting, Customer Verification';
    const REDIRECTING_MERCHANT_MSG = 'Redirecting, Merchant Dashboard';
    const MERCHANT_REGISTER_VIEW   = 'auth.merchant-register';

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var UserRepo
     */
    private UserRepo $_userRepo;

    /**
     * @var RoleService
     */
    private RoleService $_roleService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepo $_userRepo,
        RoleService $_roleService
    )
    {
        $this->middleware('guest');
        $this->_userRepo = $_userRepo;
        $this->_roleService = $_roleService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required','string','unique:users'],
            'mobile_no' =>['required','min:12','max:20'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function merchantValidator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required','string','unique:users'],
            'mobile_no' => ['required','min:12','max:20'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
//            'is_school'    => ['required'],
            'company_name'    => ['required', 'string', 'max:255'],
            'company_phone'   => ['required'],
            'company_email'   => ['required', 'string', 'email', 'max:255', 'unique:merchant_details'],
            'company_address' => ['required'],
        ]);
    }

    /**
     * @param array $data
     * @return object
     */
    protected function create(array $data)
    {
        // customer create
        $customer = $this->_userRepo->create($this->_filterCreateUserRequest($data,true));

        // get customer role and assign to customer
        $role = $this->_roleService->getCustomerRoleExist();
        if(!empty($role))
            $customer->assignRole(IUserRole::CUSTOMER_ROLE);
        //store user image record
        $this->_storeImage($customer);

        return $customer;
    }

    /**
     * @param array $data
     * @return object
     */
    protected function merchantStore(array $data)
    {
        // merchant create
        $merchant = $this->_userRepo->create($this->_filterCreateUserRequest($data));
        $merchant->merchantDetail()->create([
            'company_name'    => $data['company_name'],
            'company_phone'   => $data['company_phone'],
            'company_email'   => $data['company_email'],
            'company_address' => $data['company_address'],
        ]);
        // get merchant role and assign to merchant
        $role = $this->_roleService->getMerchantRoleExist();
        if(!empty($role))
            $merchant->assignRole(IUserRole::MERCHANT_ROLE);
        //store user image record
        $this->_storeImage($merchant);

        return $merchant;
    }
    /**
     * @param $data
     * @return array
     */
    private function _filterCreateUserRequest($data,$customer=false)
    {
        if ($customer)
            $data['is_school'] = $customer ? true : false;
        return [
            'name'      => $data['name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'mobile_number'     => $data['mobile_no'],
            'password'  => Hash::make($data['password']),
            'is_school' => $data['is_school'] ?? false,
            'is_first_time' => IUserStatuses::IS_FIRST_TIME,
        ];
    }

    /**
     * @return string|null
     */
    public function redirectTo()
    {
        return GeneralHelper::REDIRECT_TO();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return GeneralHelper::SEND_RESPONSE($response, true, $this->redirectTo(),self::REDIRECTING_CUSTOMER_MSG);
        }
        return GeneralHelper::SEND_RESPONSE($request, true, $this->redirectTo(),self::REDIRECTING_CUSTOMER_MSG);
    }

    /**
     * @return Application|Factory|View
     */
    public function merchantCreate()
    {
        return view(self::MERCHANT_REGISTER_VIEW);
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function merchantRegister(Request $request)
    {
        $this->merchantValidator($request->all())->validate();

        $user = $this->merchantStore($request->all());

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return GeneralHelper::SEND_RESPONSE($response, true, $this->redirectTo(),self::REDIRECTING_MERCHANT_MSG);
        }
        return GeneralHelper::SEND_RESPONSE($request, true, $this->redirectTo(),self::REDIRECTING_MERCHANT_MSG);
    }

    /**
     * @param $user
     * @return mixed
     */
    private function _storeImage($user)
    {
        return $user->image()->create([
            'url'   =>  asset('images/user-img.png'),
            'type'  =>  IMediaType::IMAGE,
        ]);
    }
}
