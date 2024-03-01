<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Document\UpdateDocumentRequest;
use App\Http\Services\DocumentService;
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

    const DOCUMENT_VIEW = 'backend.customer.document.index';
    const DOCUMENT_ROUTE = IUserRole::CUSTOMER_ROLE.'.approval.documents';
    const DOCUMENT_UPDATE = 'Document has been updated';
    const DOCUMENT_ERROR = 'Something went wrong !!!';

    private DocumentService $_customerDocumentService;

    /**
     * @param DocumentService $customerDocumentService
     */
    public function __construct(DocumentService $customerDocumentService)
    {
        parent::__construct();
        $this->_customerDocumentService = $customerDocumentService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = GeneralHelper::USER();
        $documents = isset($user->customerDetail) ? json_decode($user->customerDetail->document_details) : null ;
        return view(self::DOCUMENT_VIEW,compact('documents'));
    }

    /**
     * @param UpdateDocumentRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(UpdateDocumentRequest $request){
        $response = $this->_customerDocumentService->storeCustomerDocument($request);
        if($response)
            return GeneralHelper::SEND_RESPONSE($request,$response,self::DOCUMENT_ROUTE,self::DOCUMENT_UPDATE);
        return GeneralHelper::SEND_RESPONSE($request,'','','',self::DOCUMENT_ERROR);
    }

}
