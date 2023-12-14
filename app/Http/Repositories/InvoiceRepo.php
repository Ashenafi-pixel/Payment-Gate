<?php

namespace App\Http\Repositories;

use App\Models\Invoice;

/**
* @var InvoiceRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class InvoiceRepo extends BaseRepo
{

     /**
      *
      */
     public function __construct()
     {
           parent::__construct(Invoice::class);
     }

}
