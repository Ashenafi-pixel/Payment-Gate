<?php

namespace App\Http\Repositories;

use App\Models\Currency;

/**
* @var CurrencyRepo
* @author Shaarif <shaarifsabah5299@gmail.com>
*/
class CurrencyRepo extends BaseRepo
{
    public function __construct()
     {
           parent::__construct(Currency::class);
     }

}
