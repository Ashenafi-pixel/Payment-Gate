<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CurrencyService;
use Illuminate\Http\Request;

/**
 * @var CurrencyController
 * @author Shaarif<shaarifsabah5299@gmail.com>
 */
class CurrencyController extends Controller
{

    /**
     * @var CurrencyService $_currencyService
     */
    private CurrencyService $_currencyService;

    /**
     * @param CurrencyService $_currencyService
     */
    public function __construct(CurrencyService $_currencyService)
    {
        parent::__construct();
        $this->_currencyService = $_currencyService;
    }

    public function index()
    {
        $currencies = $this->_currencyService->getAllCurrencies();
        return view('backend.admin.currency.index',compact(
            'currencies'
        ));
    }
}
