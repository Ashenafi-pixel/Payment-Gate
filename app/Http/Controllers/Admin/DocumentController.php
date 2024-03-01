<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHelper;
use App\Helpers\IStatuses;
use App\Helpers\IUserRole;
use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepo;
use App\Http\Services\DocumentService;
use App\Models\CustomerDetail;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * @author umer.masood@mytm.pk
 */
class DocumentController extends Controller
{
    const CUSTOMER_VIEW = 'backend.admin.customer.document.pending-customer';
    const CUSTOMER_DOCUMENT_VIEW = 'backend.admin.customer.document.view';
    const MERCHANT_VIEW = 'backend.admin.merchant.document.pending-merchant';
    const MERCHANT_DOCUMENT_VIEW = 'backend.admin.merchant.document.view';
    const DOCUMENT_UPDATE = 'Document has been updated';
    const DOCUMENT_ERROR = 'Something went wrong !!!';
    const CUSTOMER_DOCUMENT_ROUTE = IUserRole::ADMIN_ROLE.'.customer.documents.index';
    const MERCHANT_DOCUMENT_ROUTE = IUserRole::ADMIN_ROLE.'.merchant.documents.index';

    /**
     * @var DocumentService
     */
    private DocumentService $_documentService;

    /**
     * @var UserRepo
     */
    private UserRepo $_userRepo;

    /**
     * @param DocumentService $documentService
     * @param UserRepo $_userRepo
     */
    public function __construct(DocumentService $documentService,UserRepo $_userRepo)
    {
        parent::__construct();
        $this->_documentService = $documentService;
        $this->_userRepo = $_userRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function pendingMerchants()
    {
        $documents = $this->_documentService->getAllPendingMerchant();
        return view(self::MERCHANT_VIEW,get_defined_vars());
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function merchantDocumentView($id)
    {
        $title     = 'All Pending Merchants';
        $documents = $this->_documentService->adminMerchantDocumentView(decrypt($id));
        $user = $this->_userRepo->find($documents->user_id);
        return view(self::MERCHANT_DOCUMENT_VIEW,get_defined_vars());
    }


    /**
     * @return Application|Factory|View
     */
    public function pendingCustomers()
    {
        $title     = 'All Pending Customers';
        $documents = $this->_documentService->getAllPendingCustomers();
        return view(self::CUSTOMER_VIEW,get_defined_vars());
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function customerDocumentView($id)
    {
        $documents = $this->_documentService->adminCustomerDocumentView(decrypt($id));
        $user = $this->_userRepo->find($documents->user_id);
        return view(self::CUSTOMER_DOCUMENT_VIEW,get_defined_vars());
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function approveDocuments(Request $request)
    {
        $response = $this->_documentService->approveDocuments($request);
        if($request->type == IUserRole::CUSTOMER_ROLE)
            $link = self::CUSTOMER_DOCUMENT_ROUTE;
        else
            $link = self::MERCHANT_DOCUMENT_ROUTE;
        if($response)
            return GeneralHelper::SEND_RESPONSE($request,$response,$link,self::DOCUMENT_UPDATE);
        return GeneralHelper::SEND_RESPONSE($request,'','','',self::DOCUMENT_ERROR);
    }
}
