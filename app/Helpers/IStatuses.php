<?php

namespace App\Helpers;

/**
* @var IStatuses
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
interface IStatuses
{

    const TRANSACTION_PENDING    = 'PENDING';
    const TRANSACTION_SUCCESS    = 'SUCCESS';
    const TRANSACTION_DECLINED   = 'DECLINED';
    const MERCHANT_PENDING       =   'PENDING';
    const MERCHANT_APPROVED      =   'APPROVED';
    const MERCHANT_REJECTED      =   'REJECTED';
    const CREDIT    =   'CREDIT';
    const DEBIT     =   'DEBIT';
    const WITHDRAW = 1;
    const DEPOSIT  = 2;

    const PENDING = 'PENDING';
    const APPROVED = 'APPROVED';
    const REJECTED = 'REJECTED';

    const ACTIVE   = 'ACTIVE';
    const INACTIVE = 'IN_ACTIVE';

}
