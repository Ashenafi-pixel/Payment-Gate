<?php

namespace App\Http\Repositories;

use App\Models\Banks;

/**
* @var BankRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class BankRepo extends BaseRepo
{
     public function __construct()
     {
           parent::__construct(Banks::class);
     }
}
