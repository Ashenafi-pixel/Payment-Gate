<?php

namespace App\Http\Services;

use App\Http\Contracts\ICurrencyServiceContract;
use App\Http\Repositories\CurrencyRepo;

/**
 * @var CurrencyService
 * @author Shaarif <shaarifsabah5299@gmail.com>
 */
class CurrencyService implements ICurrencyServiceContract
{

    /**
     * @var CurrencyRepo $_currencyRepo
     */
    private CurrencyRepo $_currencyRepo;

    /**
     * @param CurrencyRepo $_currencyRepo
     */
    public function __construct(CurrencyRepo $_currencyRepo)
    {
        $this->_currencyRepo = $_currencyRepo;
    }

    /**
     * @return mixed
     */
    public function getAllCurrencies(): mixed
    {
        return $this->_currencyRepo->all();
    }

}
