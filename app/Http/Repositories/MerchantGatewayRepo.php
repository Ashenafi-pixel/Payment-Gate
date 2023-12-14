<?php

namespace App\Http\Repositories;

use App\Models\MerchantGateway;

/**
* @var MerchantGatewayRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class MerchantGatewayRepo extends BaseRepo
{

     public function __construct()
     {
           parent::__construct(MerchantGateway::class);
     }

}
