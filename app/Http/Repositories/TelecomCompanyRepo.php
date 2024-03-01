<?php

namespace App\Http\Repositories;

use App\Models\TelecomCompany;

/**
* @var TelecomCompanyRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class TelecomCompanyRepo extends BaseRepo
{

     public function __construct()
     {
           parent::__construct(TelecomCompany::class);
     }

}
