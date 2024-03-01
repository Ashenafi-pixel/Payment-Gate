<?php

namespace App\Http\Services;

use App\Helpers\IUserRole;
use App\Helpers\IMediaType;
use App\Helpers\GeneralHelper;
use App\Helpers\IUserStatuses;
use App\Http\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Http\Requests\Merchant\Profile\UpdateProfileRequest as MerchantUpdateProfileRequest;
use App\Http\Requests\Merchant\Profile\UpdatePasswordRequest as MerchantUpdatePasswordRequest;
use App\Http\Requests\Customer\Profile\UpdateProfileRequest as CustomerRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


/**
 * @package   UserService
 * @author    Shaarif@xintsolutions.com
 */
class UserService implements IUserServiceContract
{

    /**
     * @var UserRepo
     */
    private UserRepo $_userRepo;

    /**
     * @var RoleService
     */
    private RoleService $_roleService;

    /**
     * @param UserRepo $_userRepo
     */
    public function __construct(UserRepo $_userRepo,RoleService $_roleService)
    {
        $this->_userRepo = $_userRepo;
        $this->_roleService = $_roleService;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->_userRepo->all();
    }

    /**
     * @param array $array
     * @return object
     */
    public function store(array $array): object
    {
        return $this->_userRepo->create($array);
    }

    /**
     * @param $id
     * @param $array
     * @return bool
     */
    public function update($id, $array): bool
    {
        return $this->_userRepo->update($id, $array);
    }

    /**
     * @param $id
     * @return object
     */
    public function find($id): object
    {
        return $this->_userRepo->find($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->_userRepo->delete($id);
    }

    /**
     * @return mixed
     */
    public function getAllMerchants(): mixed
    {
        return $this->_userRepo->model()->whereHas('roles', function ($role) {
            $role->whereIn('name', [IUserRole::MERCHANT_ROLE]);
        })->paginate(10);
    }

    /**
     * @return mixed
     */
    public function getAllCustomers(): mixed
    {
        return $this->_userRepo->model()->whereHas('roles', function ($role) {
            $role->whereIn('name', [IUserRole::CUSTOMER_ROLE]);
        })->orderBy('id','desc')->get();
    }

    /**
     * Find User By Email
     *
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email): mixed
    {
        return $this->_userRepo->findByClause(['email' => $email])->first();
    }

    /**
     * Fetch User By Token
     *
     * @param string $token
     *
     * @return mixed
     */
    public function findByToken(string $token): mixed
    {
        return $this->_userRepo->findByClause(['remember_token' => $token])->first();
    }

    /**
     * @param UpdateProfileRequest $request
     */
    public function updateAdmin(UpdateProfileRequest $request)
    {
        if ($request->has('profile_image')) {
            $image = GeneralHelper::UPLOAD_FILE($request->profile_image, 'uploads/admin/profile-img');
            if ($image) {
                $this->_userRepo->model->where('id', auth()->id())->update($this->_filterUpdateAdminRequest($request->all()));
                return auth()->user()->image()->update([
                    'url' => $image,
                    'type' => IMediaType::IMAGE,
                ]);
            }
        } else
            return $this->_userRepo->model->where('id', auth()->id())->update($this->_filterUpdateAdminRequest($request->all()));
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterUpdateAdminRequest($request): array
    {
        return [
            'name' => $request['name'],
            'mobile_number' => $request['mobile_number'] ?? null,
        ];
    }

    /**
     * @param CustomerRequest $request
     * @return void
     */
    public function updateCustomer(CustomerRequest $request)
    {
        if ($request->has('profile_image')) {
            $image = GeneralHelper::UPLOAD_FILE($request->profile_image, 'uploads/customer/profile-img');
            if ($image) {
                $this->_userRepo->model->where('id', auth()->id())->update($this->_filterUpdateCustomerRequest($request->all()));
                return auth()->user()->image()->update([
                    'url' => $image,
                    'type' => IMediaType::IMAGE,
                ]);
            }
        } else {
            return $this->_userRepo->model->where('id', auth()->id())->update($this->_filterUpdateCustomerRequest($request->all()));
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterUpdateCustomerRequest($request): array
    {
        return [
            'name' => $request['name'],
            'mobile_number' => $request['mobile_number'] ?? null,
        ];
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return bool
     */
    public function updatePassword(UpdatePasswordRequest $request): bool
    {
        if (!Hash::check($request->get('old_password'), GeneralHelper::USER('password')))
            return false;
        return $this->_userRepo->update(auth()->id(), ['password' => bcrypt($request->get('password'))]);
    }

    // Merchant Profile

    /**
     * @param $request
     * @return void
     */
    public function updateMerchant($request)
    {
        if ($request->has('profile_image')) {
            $image = GeneralHelper::UPLOAD_FILE($request->profile_image, 'uploads/merchant/profile-img');
            if ($image) {
                $this->_userRepo->model->where('id', auth()->id())->update($this->_filterUpdateMerchantRequest($request->all()));
                return auth()->user()->image()->update([
                    'url' => $image,
                    'type' => IMediaType::IMAGE,
                ]);
            }
        } else
            return $this->_userRepo->model->where('id', auth()->id())->update($this->_filterUpdateMerchantRequest($request->all()));
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterUpdateMerchantRequest($request): array
    {
        return [
            'name' => $request['name'],
            'mobile_number' => $request['mobile_number'] ?? null,
        ];
    }

    /**
     * @param $request
     * @return bool
     */
    public function updateMerchantPassword($request): bool
    {
        if (!Hash::check($request->get('old_password'), GeneralHelper::USER('password')))
            return false;
        return $this->_userRepo->update(auth()->id(), ['password' => bcrypt($request->get('password'))]);
    }

    /**
     * @return mixed
     */
    public function getAllMerchantCount(): mixed
    {
        return $this->getAllMerchants()->count();
    }

    /**
     * @return mixed
     */
    public function getAllCustomersCount(): mixed
    {
        return $this->getAllCustomers()->count();
    }

    /**
     * @return mixed
     */
    public function getAllMerchantsByStatus($status): mixed
    {
        return $this->_userRepo->model()->whereHas('merchantDetail', function ($query) use ($status) {
            $query->where('status',$status);
        });
    }

    /**
     * @return mixed
     */
    public function getAllCustomersByStatus($status): mixed
    {
        return $this->_userRepo->model()->whereHas('customerDetail', function ($query) use ($status) {
            $query->where('status', $status);
        });
    }

    /**
     * @return mixed
     */
    public function getAllActiveMerchantsCount($status = null): mixed
    {
        return $this->getAllMerchantsByStatus($status)->count();
    }

    /**
     * @return mixed
     */
    public function getAllActiveCustomersCount($status = null): mixed
    {
        return $this->getAllCustomersByStatus($status)->count();
    }

    /**
     * @return int
     */
    public function getCustomerAvailableBalance()
    {
        $customer =  $this->_userRepo->model()->where('id',Auth::id())->with('customerDetail')->first();
        return $customer->customerDetail ? $customer->customerDetail->balance : 0;
    }

    /**
     * @param $pin
     * @return bool
     */
    public function setPin($pin)
    {
        $condition = ['id'=>Auth::id()];
        $data = ['pin_code' => $pin];
        $user = $this->_userRepo->updateByClause($condition,$data);
        return $user;
    }

    /**
     * @param $request
     * @return object
     */
    public function merchantStore($merchant)
    {
        $this->merchantValidator($merchant)->validate();

        $data = $this->_filterCreateUserRequest($merchant);
        $companyData = [
            'company_name' => $merchant['company_name'],
            'company_phone' => $merchant['company_phone'],
            'company_email' => $merchant['company_email'],
            'company_address' => $merchant['company_address'],
        ];

        if (isset($merchant['license'])) {
            $companyData['license'] = $merchant['license'];
        }

        if (isset($merchant['passport']) ) {
           $companyData['passport'] = $merchant['passport'];
        }

        $merchant = $this->_userRepo->create($data);
        $merchant->merchantDetail()->create($companyData);

        $role = $this->_roleService->getMerchantRoleExist();
        if (!empty($role)) {
            $merchant->assignRole(IUserRole::MERCHANT_ROLE);
        }

        $this->_storeImage($merchant);

        $merchant->remember_token = GeneralHelper::STR_RANDOM(60);
        $merchant->save();
        $merchant->sendPasswordSetLink();

        return $merchant;
    }

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function merchantValidator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required','string','unique:users'],
            'mobile_no' => ['required','digits_between:12,20'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_name'    => ['required', 'string', 'max:255'],
            'company_phone'   => ['required'],
            'company_email'   => ['required', 'string', 'email', 'max:255', 'unique:merchant_details'],
            'company_address' => ['required'],
            'license' => ['string'],
            'passport' => ['string'],
        ]);
    }

    /**
     * @param $data
     * @param $customer
     * @return array
     */
    private function _filterCreateUserRequest($data,$customer=false): array
    {
        $rand_pass = Str::random(8);
        if ($customer)
            $data['is_school'] = $customer ? true : false;
        return [
            'name'      => $data['name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'mobile_number'     => $data['mobile_no'],
            'password'  => Hash::make($rand_pass),
            'is_school' => $data['is_school'] ?? false,
            'is_first_time' => IUserStatuses::IS_FIRST_TIME,
        ];
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

    /**
     * @param $request
     * @return object
     */
    public function customerStore($request)
    {
        $this->customerValidator($request)->validate();
        // customer create
        $customer = $this->_userRepo->create($this->_filterCreateUserRequest($request));
        // get merchant role and assign to merchant
        $role = $this->_roleService->getMerchantRoleExist();
        if(!empty($role))
            $customer->assignRole(IUserRole::CUSTOMER_ROLE);
        //store user image record
        $this->_storeImage($customer);
        $customer->remember_token = GeneralHelper::STR_RANDOM(60);
        $customer->save();
        $customer->sendPasswordSetLink();
        return $customer;
    }

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function customerValidator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required','string','unique:users'],
            'mobile_no' => ['required','digits_between:12,20'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
}
