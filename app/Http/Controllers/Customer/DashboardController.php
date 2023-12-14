<?php

namespace App\Http\Controllers\Customer;

use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Services\TransactionService;
use App\Http\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
* @package  Customer/DashboardController
* @author    Shaarif@xintsolutions.com
*/
class DashboardController extends Controller
{

    # Customer Dashboard View
    const DASHBOARD_VIEW = 'backend.customer.dashboard';

    /**
     * @var ITransactionServiceContract
     */
    private ITransactionServiceContract $_transactionService;

    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    public function __construct(TransactionService $transactionService, UserService $userService)
    {
        $this->_transactionService = $transactionService;
        $this->_userService = $userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $totalTransactionsCount = $this->_transactionService->getCustomerAllTransactionCount();
        $TransactionsAmount = $this->_transactionService->getCustomerTransactionAmount();
        $totalDebitTransactionsAmount = $TransactionsAmount['debit'];
        $totalCreditTransactionsAmount = $TransactionsAmount['credit'];
        $totalTransactionsAmount = $TransactionsAmount['total'];
        $totalBalance = $this->_userService->getCustomerAvailableBalance();
        return view(self::DASHBOARD_VIEW,compact(
            'totalTransactionsCount',
            'totalDebitTransactionsAmount',
            'totalCreditTransactionsAmount',
            'totalTransactionsAmount',
            'totalBalance',
        ));
    }
}
