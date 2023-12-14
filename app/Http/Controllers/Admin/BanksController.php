<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Http\Services\BankService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * @var BanksController
 * @author Shaarif<shaarifsabah5299@gmail.com>
 */
class BanksController extends Controller
{

    /**
     * @var BankService $_bankService
     */
    private BankService $_bankService;

    /**
     * @param BankService $_bankService
     */
    public function __construct(BankService $_bankService)
    {
        parent::__construct();
        $this->_bankService = $_bankService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $banks = $this->_bankService->getAllBanks();
        return view('backend.admin.banks.index',compact(
            'banks',
        ));
    }

}
