<?php

namespace App\Http\Repositories;

use App\Models\Transaction;

/**
* @var TransactionRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class TransactionRepo extends BaseRepo
{

     public function __construct()
     {
           parent::__construct(Transaction::class);
     }

}
