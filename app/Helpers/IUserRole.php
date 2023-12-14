<?php

namespace App\Helpers;

/**
* @var IUserRole
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
interface IUserRole
{
    const ADMIN     = 1;
    const BUSINESS  = 2;
    const CUSTOMER  = 3;

    const ADMIN_ROLE    =   'admin';

    const MERCHANT_ROLE =   'merchant';
    const CUSTOMER_ROLE =   'customer';
}
