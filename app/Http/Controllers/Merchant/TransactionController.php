<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Services\TransactionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    const TRANSACTIONS_INDEX_VIEW = '';

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
    public function getMerchantsAllTransactions()
    {
        $allTransactions = $this->_transactionService->getMerchantsAllTransactions();
        return view('backend.merchant.transactions.index',compact(
            'allTransactions'
        ));
    }
}
