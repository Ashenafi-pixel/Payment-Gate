<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\GeneralHelper;
use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * @author Umer <umer.masood@mytm.pk>
 */
class LedgerController extends Controller
{
    const LEDGER_VIEW = 'backend.customer.ledger.index';
    /**
     * @var ITransactionServiceContract
     */
    private ITransactionServiceContract $_transactionService;

    /**
     * @param ITransactionServiceContract $transactionService
     */
    public function __construct(ITransactionServiceContract $transactionService)
    {
        parent::__construct();
        $this->_transactionService = $transactionService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $ledger_details = $this->_transactionService->getTransaction();
        return view(self::LEDGER_VIEW,compact('ledger_details'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function getTransactions(Request $request)
    {
        $transactions = $this->_transactionService->getTransaction();
        return GeneralHelper::SEND_RESPONSE_API($request,$transactions,config('constants.generalMessages.customer_transaction_found'));
    }
}
