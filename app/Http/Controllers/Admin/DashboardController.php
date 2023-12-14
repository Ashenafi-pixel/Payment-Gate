<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\IStatuses;
use App\Helpers\IUserStatuses;
use App\Http\Contracts\IInvoiceServiceContract;
use App\Http\Contracts\ITransactionServiceContract;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Services\InvoiceService;
use App\Http\Services\TransactionService;
use App\Http\Services\UserService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    # Admin Dashboard View
    const DASHBOARD_VIEW = 'backend.admin.dashboard';

    /**
     * @var IUserServiceContract
     */
    private IUserServiceContract $_userService;

    private IInvoiceServiceContract $_invoiceService;

    /**
     * @var ITransactionServiceContract
     */
    private ITransactionServiceContract $_transactionService;

    /**
     * @param UserService $_userService
     * @param InvoiceService $_invoiceService
     * @param TransactionService $_transactionService
     */
    public function __construct(
        UserService $_userService,
        InvoiceService $_invoiceService,
        TransactionService $_transactionService
    )
    {
        parent::__construct();
        $this->_userService = $_userService;
        $this->_invoiceService = $_invoiceService;
        $this->_transactionService = $_transactionService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $totalMerchantsCount    = $this->_userService->getAllMerchantCount();
        $totalCustomersCount    = $this->_userService->getAllCustomersCount();
        $activeMerchantsCount   = $this->_userService->getAllActiveMerchantsCount(IStatuses::APPROVED);
        $activeCustomersCount   = $this->_userService->getAllActiveCustomersCount(IStatuses::APPROVED);
        $pendingMerchantsCount  = $this->_userService->getAllActiveMerchantsCount(IStatuses::PENDING);
        $pendingCustomersCount  = $this->_userService->getAllActiveCustomersCount(IStatuses::PENDING);
        $rejectedMerchantsCount  = $this->_userService->getAllActiveMerchantsCount(IStatuses::REJECTED);
        $totalInvoicesCount     = $this->_invoiceService->getAllInvoicesCount();
        $activeInvoicesCount    = $this->_invoiceService->getAllActiveInvoicesCount();
        $pendingInvoicesCount   = $this->_invoiceService->getAllInActiveInvoicesCount();
        $transactionsCount      = $this->_transactionService->transactionStatusCount($request);
        $paymentMethodCount     = $this->_transactionService->transactionPaymentMethodCount($request);
        return view(self::DASHBOARD_VIEW,compact(
           'totalMerchantsCount',
           'activeMerchantsCount',
           'activeCustomersCount',
            'pendingMerchantsCount',
            'rejectedMerchantsCount',
            'pendingCustomersCount',
            'totalCustomersCount',
            'totalInvoicesCount',
            'activeInvoicesCount',
            'pendingInvoicesCount',
            'transactionsCount',
            'paymentMethodCount',
        ));
    }


}
