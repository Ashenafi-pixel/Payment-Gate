<?php

namespace App\Http\Repositories;

use App\Models\MerchantCustomer;

/**
* @var MerchantCustomerRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class MerchantCustomerRepo extends BaseRepo
{

     public function __construct()
     {
           parent::__construct(MerchantCustomer::class);
     }

}
