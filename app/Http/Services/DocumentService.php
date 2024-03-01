<?php

namespace App\Http\Services;

use App\Helpers\IUserRole;
use App\Helpers\IUserStatuses;
use App\Http\Repositories\MerchantDetailRepo;
use Carbon\Carbon;
use App\Helpers\IDocTypes;
use App\Helpers\IStatuses;
use App\Helpers\GeneralHelper;
use App\Http\Repositories\UserRepo;
use App\Http\Repositories\CustomerDetailRepo;
use App\Http\Contracts\IDocumentServiceContract;
use http\Env\Request;

class DocumentService implements IDocumentServiceContract
{
    /**
     * @var UserRepo
     */
    private UserRepo $_userRepo;

    /**
     * @var CustomerDetailRepo $_customerDetailRepo ;
     */
    private CustomerDetailRepo $_customerDetailRepo;

    /**
     * @var MerchantDetailRepo $_merchantDetailRepo ;
     */
    private MerchantDetailRepo $_merchantDetailRepo;

    /**
     * @param UserRepo $_userRepo
     * @param CustomerDetailRepo $_customerDetailRepo
     */
    public function __construct(
        UserRepo           $_userRepo,
        CustomerDetailRepo $_customerDetailRepo,
        MerchantDetailRepo $_merchantDetailRepo
    )
    {
        $this->_userRepo = $_userRepo;
        $this->_customerDetailRepo = $_customerDetailRepo;
        $this->_merchantDetailRepo = $_merchantDetailRepo;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function storeMerchantDocument($request): mixed
    {
        # get merchant detail
        $merchant = GeneralHelper::USER();

        # unlink document if exist
        $documents = !empty(json_decode($merchant->merchantDetail->document_details)) ? json_decode($merchant->merchantDetail->document_details) : null;
        if (!empty($documents)) {
            $oldCnic = $documents->cnic_doc ?? null;
            $unlinkTrueCnic = isset($oldCnic) ?? false;

            $oldLicense = $documents->license_doc ?? null;
            $unlinkTrueLicense = isset($oldLicense) ?? false;

            $oldRegistrationForm = $documents->registration_form_doc ?? null;
            $unlinkTrueForm = isset($oldRegistrationForm) ?? false;
        }

        # save document
        if ($request->has('cnic'))
            $cnic = GeneralHelper::UPLOAD_FILE($request->cnic, 'uploads/document', true, $unlinkTrueCnic ?? false, $oldCnic ?? null);
        else
            $cnic = !empty(json_decode($merchant->merchantDetail->document_details)->cnic_doc) ? json_decode($merchant->merchantDetail->document_details)->cnic_doc : null;

        if ($request->has('license'))
            $license = GeneralHelper::UPLOAD_FILE($request->license, 'uploads/document', true, $unlinkTrueLicense ?? false, $oldLicense ?? null);
        else
            $license = !empty(json_decode($merchant->merchantDetail->document_details)->license_doc) ? json_decode($merchant->merchantDetail->document_details)->license_doc : null;

        if ($request->has('registration_form'))
            $registrationForm = GeneralHelper::UPLOAD_FILE($request->registration_form, 'uploads/document', true, $unlinkTrueForm ?? false, $oldRegistrationForm ?? null);
        else
            $registrationForm = !empty(json_decode($merchant->merchantDetail->document_details)->registration_form_doc) ? json_decode($merchant->merchantDetail->document_details)->registration_form_doc : null;

        # filter merchant document request
        $merchantDocument = $this->_filterMerchantDocument($cnic, $license, $registrationForm, $merchant);

        # update merchant details
        return $merchant->merchantDetail()->update([
            'document_details' => json_encode($merchantDocument),
        ]);
    }

    /**
     * @param $cnic
     * @param $license
     * @param $registrationForm
     * @param $merchant
     * @return array
     */
    private function _filterMerchantDocument($cnic, $license, $registrationForm, $merchant): array
    {
        return [
            IDocTypes::CNIC_DOC => ($cnic) ?? null,
            IDocTypes::CNIC_STATUS => !empty(json_decode($merchant->merchantDetail->document_details)->cnic_doc_status) ? (json_decode($merchant->merchantDetail->document_details)->cnic_doc_status) : IStatuses::PENDING,
            IDocTypes::CNIC_CREATE_DATE => Carbon::now(),
            IDocTypes::LICENSE_DOC => ($license) ?? null,
            IDocTypes::LICENSE_STATUS => !empty(json_decode($merchant->merchantDetail->document_details)->license_doc_status) ? (json_decode($merchant->merchantDetail->document_details)->license_doc_status) : IStatuses::PENDING,
            IDocTypes::LICENSE_CREATE_DATE => Carbon::now(),
            IDocTypes::REGISTER_DOC => ($registrationForm) ?? null,
            IDocTypes::REGISTER_STATUS => !empty(json_decode($merchant->merchantDetail->document_details)->registration_form_doc_status) ? (json_decode($merchant->merchantDetail->document_details)->registration_form_doc_status) : IStatuses::PENDING,
            IDocTypes::REGISTER_CREATE_DATE => Carbon::now(),
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function storeCustomerDocument($request): mixed
    {

        try {
            $customer = GeneralHelper::USER();
            $cnic = '';
            $license = '';
            if (isset($customer->customerDetail)) {
                $cnic_oldpath = json_decode($customer->customerDetail->document_details)->cnic_doc;
                $unlink = true;
                $license_oldpath = json_decode($customer->customerDetail->document_details)->license_doc;
            } else {
                $cnic_oldpath = null;
                $unlink = false;
                $license_oldpath = null;
            }
            # save document
            if ($request->has('cnic'))
                $cnic = GeneralHelper::UPLOAD_FILE($request->cnic, 'uploads/document', true, $unlink, $cnic_oldpath);

            if ($request->has('license'))
                $license = GeneralHelper::UPLOAD_FILE($request->license, 'uploads/document', true, $unlink, $license_oldpath);

            # filter merchant document request
            $customerDocument = $this->_filterCustomerDocument($cnic, $license, $customer);

            # update customer details
            if ($customer->customerDetail) {
                return $customer->customerDetail()->update([
                    'document_details' => json_encode($customerDocument),
                ]);
            } else {
                return $customer->customerDetail()->create([
                    'balance' => GeneralHelper::RANDOM_NO(),
                    'document_details' => json_encode($customerDocument),
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $cnic
     * @param $license
     * @param $customer
     * @return array
     */
    private function _filterCustomerDocument($cnic, $license, $customer): array
    {

        return [
            IDocTypes::CNIC_DOC => $cnic != '' ? $cnic : (json_decode($customer->customerDetail->document_details)->cnic_doc),
            IDocTypes::CNIC_STATUS => isset($customer->customerDetail) ? (json_decode($customer->customerDetail->document_details)->cnic_doc_status) : IStatuses::PENDING,
            IDocTypes::CNIC_CREATE_DATE => isset($customer->customerDetail) ? (json_decode($customer->customerDetail->document_details)->cnic_created_date) : Carbon::now(),
            IDocTypes::LICENSE_DOC => $license != '' ? $license : (json_decode($customer->customerDetail->document_details)->license_doc),
            IDocTypes::LICENSE_STATUS => isset($customer->customerDetail) ? (json_decode($customer->customerDetail->document_details)->license_doc_status) : IStatuses::PENDING,
            IDocTypes::LICENSE_CREATE_DATE => isset($customer->customerDetail) ? (json_decode($customer->customerDetail->document_details)->license_created_date) : Carbon::now(),
        ];
    }

    /**
     * @return mixed
     */
    public function getAllPendingCustomers(): mixed
    {
        return $this->_customerDetailRepo->model()
               ->where('document_details', '!=', null)
               ->where('status', IStatuses::PENDING)
               ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function adminCustomerDocumentView($id): mixed
    {
        $customerDocument = $this->_customerDetailRepo->find($id);
        return (object)[
            'user_id' => $customerDocument->user_id,
            'document_detail' => json_decode($customerDocument->document_details),
        ];
    }

    /**
     * @return mixed
     */
    public function getAllMerchantDocuments(): mixed
    {
        return $this->_merchantDetailRepo->model()->get();
    }

    /**
     * @return mixed
     */
    public function getAllPendingMerchant(): mixed
    {
        return $this->_merchantDetailRepo->model()->where('status', IStatuses::MERCHANT_PENDING)->where('document_details', '!=', null)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function adminMerchantDocumentView($id): mixed
    {
        $merchantDocument = $this->_merchantDetailRepo->find($id);
        return (object)[
            'user_id' => $merchantDocument->user_id,
            'document_detail' => json_decode($merchantDocument->document_details),
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function approveDocuments($request): mixed
    {
        $user_id = decrypt($request->user_id);
        if ($request->type == IUserRole::CUSTOMER_ROLE) {
            $customer = $this->_customerDetailRepo->findByClause([
                'user_id' => $user_id
            ])->first();
            if ($request->cnic_doc == IStatuses::APPROVED && $request->license_doc == IStatuses::APPROVED) {
                $user_status = IStatuses::APPROVED;
            } else {
                $user_status = IStatuses::PENDING;
            }
            $documents = json_decode($customer->document_details);
            if ($request->cnic_doc)
                $documents->cnic_doc_status = $request->cnic_doc;
            if ($request->license_doc)
                $documents->license_doc_status = $request->license_doc;
            return $customer->update([
                'document_details' => json_encode($documents),
                'status' => $user_status,
            ]);
        } elseif ($request->type == IUserRole::MERCHANT_ROLE) {
            $merchant = $this->_merchantDetailRepo->findByClause([
                'user_id' => $user_id
            ])->first();

            if ($request->cnic_doc == IStatuses::APPROVED && $request->license_doc == IStatuses::APPROVED
                || $request->registration_form_doc == IStatuses::APPROVED) {
                $user_status = IStatuses::APPROVED;
            } else {
                $user_status = IStatuses::PENDING;
            }
            $documents = json_decode($merchant->document_details);
            $documents->cnic_doc_status = $request->cnic_doc;
            $documents->license_doc_status = $request->license_doc;
            $documents->registration_form_doc_status = $request->registration_form_doc;
            return $merchant->update([
                'document_details' => json_encode($documents),
                'status' => $user_status,
            ]);
        }

    }
}
