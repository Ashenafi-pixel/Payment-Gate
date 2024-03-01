<?php

namespace App\Http\Repositories;

use App\Models\CustomerDetail;

/**
* @var CustomerDetailRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class CustomerDetailRepo extends BaseRepo
{

     public function __construct()
     {
           parent::__construct(CustomerDetail::class);
     }



}
