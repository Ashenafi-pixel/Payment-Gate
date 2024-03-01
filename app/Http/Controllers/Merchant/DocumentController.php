<?php

namespace App\Http\Controllers\Merchant;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\Document\UpdateDocumentRequest;
use App\Http\Services\DocumentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    const DOCUMENT_VIEW = 'backend.merchant.document.index';
    const DOCUMENT_ROUTE = IUserRole::MERCHANT_ROLE.'.approval.documents';
    const DOCUMENT_UPDATE = 'Document has been updated';
    const DOCUMENT_ERROR = 'Document error';

    /**
     * @var DocumentService
     */
    private DocumentService $_documentService;

    /**
     * @param DocumentService $_documentService
     */
    public function __construct(DocumentService $_documentService)
    {
        parent::__construct();
        $this->_documentService = $_documentService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = GeneralHelper::USER();
        $documents = !empty($user->merchantDetail) ? json_decode($user->merchantDetail->document_details) : null;
        return view(self::DOCUMENT_VIEW, get_defined_vars());
    }

    /**
     * @param UpdateDocumentRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(UpdateDocumentRequest $request)
    {
        $response = $this->_documentService->storeMerchantDocument($request);
        if($response)
            return GeneralHelper::SEND_RESPONSE($request,$response,self::DOCUMENT_ROUTE,self::DOCUMENT_UPDATE);
        return GeneralHelper::SEND_RESPONSE($request,'','','',self::DOCUMENT_ERROR);
    }
}
