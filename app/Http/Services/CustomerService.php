<?php

namespace App\Http\Services;

use App\Helpers\GeneralHelper;
use App\Helpers\IStatuses;
use App\Http\Contracts\ICustomerServiceContract;
use App\Http\Repositories\MerchantCustomerRepo;
use App\Http\Repositories\MerchantStudentRepo;
use App\Http\Repositories\UserRepo;

/**
 * @var CustomerService
 * @author Shaarif <m.shaarif@xintsolutions.com>
 */
class CustomerService implements ICustomerServiceContract
{

    /**
     * @var UserRepo
     */
    private UserRepo $_userRepo;
    /**
     * @var MerchantCustomerRepo
     */
    private MerchantCustomerRepo $_merchantCustomerRepo;

    /**
     * @var MerchantStudentRepo
     */
    private MerchantStudentRepo $_merchantStudentRepo;

    /**
     * @param UserRepo $_userRepo
     * @param MerchantCustomerRepo $_merchantCustomerRepo
     * @param MerchantStudentRepo $_merchantStudentRepo
     */
    public function __construct(
        UserRepo             $_userRepo,
        MerchantCustomerRepo $_merchantCustomerRepo,
        MerchantStudentRepo  $_merchantStudentRepo
    )
    {
        $this->_userRepo = $_userRepo;
        $this->_merchantCustomerRepo = $_merchantCustomerRepo;
        $this->_merchantStudentRepo = $_merchantStudentRepo;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveCustomer($request): mixed
    {
        return $this->_userRepo->findById(auth()->id())->merchantCustomer()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile_number' => $request['mobile_number'],
            'status' => $request['status'],
        ]);
    }

    /**
     * @return mixed
     */
    public function getAllCustomers(): mixed
    {
        return $this->_userRepo->findById(auth()->id())->merchantCustomer;
    }

    /**
     * @return mixed
     */
    public function getAllActiveCustomers(): mixed
    {
        return $this->_merchantCustomerRepo->model()->where('user_id', auth()->id())
            ->where('status', IStatuses::ACTIVE)->latest()->get();
    }

    /**
     * @return mixed
     */
    public function getAllStudents(): mixed
    {
        return $this->_userRepo->findById(auth()->id())->merchantStudent;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveStudent($request): mixed
    {
        return $this->_merchantStudentRepo->create($request);
    }

    /**
     * @param $request
     * @param $student_id
     * @return mixed
     */
    public function updateStudent($request, $student_id): mixed
    {
        return $this->_merchantStudentRepo->update($student_id, $request);
    }

    /**
     * @param $student_id
     * @return object
     */
    public function getStudent($student_id): object
    {
        return $this->_merchantStudentRepo->find(decrypt($student_id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomer($id): mixed
    {
        return $this->_merchantCustomerRepo->findById($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function updateCustomer($request): bool
    {
        $customer_id = decrypt($request->customer_id);
        $customer = $this->_merchantCustomerRepo->findById($customer_id);
        if ($request['recurringInvoice'] && $request['recurringDays']) {
            if (empty($customer->recurringInvoice))
                $customer->recurringInvoice()->create([
                   'customer_id'    =>  $customer_id,
                   'invoice_id'     =>  $request->recurringInvoice,
                   'recurring_days' =>  $request->recurringDays,
                ]);
            else
                $customer->recurringInvoice()->update([
                    'invoice_id'     =>  $request->recurringInvoice,
                    'recurring_days' =>  $request->recurringDays,
                ]);
        }
        return $this->_merchantCustomerRepo->update($customer_id, $this->_filterUpdateCustomerRequest($request->all()));
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterUpdateCustomerRequest($request): array
    {
        return [
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile_number' => $request['mobile_number'],
            'status' => $request['status'],
        ];
    }

    /**
     * @param $merchant
     * @return mixed
     */
    public function getAllCustomersOfMerchant($merchant = null, $count = false): mixed
    {
        $user = $merchant ?? auth()->user();
        return $user->merchantCustomer;
    }

    /**
     * @return mixed
     */
    public function getAllMerchantCustomersCount(): mixed
    {
        return $this->getAllCustomersOfMerchant()->count();
    }
}
