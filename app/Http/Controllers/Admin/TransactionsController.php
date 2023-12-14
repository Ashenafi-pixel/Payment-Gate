<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\TransactionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{

    /**
     * @var TransactionService $_transactionService
     */
    private TransactionService $_transactionService;

    /**
     * @param TransactionService $_transactionService
     */
    public function __construct(TransactionService $_transactionService)
    {
        parent::__construct();
        $this->_transactionService = $_transactionService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $allInvoices = $this->_transactionService->getAllMerchantsTransactions();
        return view('backend.admin.ledger.index',compact(
            'allInvoices'
        ));
    }

    /**
     * @return Application|Factory|View
     */
    public function customerLedgers()
    {
        $allTransactions = $this->_transactionService->getAllCustomerTransactions();
        return view('backend.admin.customer-ledger.index',compact(
            'allTransactions'
        ));
    }
}
