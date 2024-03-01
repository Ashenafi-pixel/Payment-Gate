<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Services\TransactionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        //the privious code
        $allTransactions = $this->_transactionService->getMerchantsAllTransactions();
        /*$merchant=auth()->user()->merchantDetail()->first();
        $url = 'http://localhost:5000/get-all-transactions?merchant_id='.$merchant->id;
        $response = Http::get($url);
        $responseData = $response->json();
        $allTransactions=$responseData['transactions'];
        //dd($allTransactions['amount']);*/
        return view('backend.merchant.transactions.index',compact(
            'allTransactions'
        ));
    }
}
