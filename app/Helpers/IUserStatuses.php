<?php

namespace App\Helpers;

/**
* @var IUserStatuses
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
interface IUserStatuses
{
    const USER_ACTIVE            =   'ACTIVE';
    const USER_NON_ACTIVE        =   'IN_ACTIVE';
    const NON_ACTIVE             =   'INACTIVE';

    //check user for the first time login
    const IS_FIRST_TIME = false;

    const APPROVED = 'APPROVED';

    const IS_SCHOOL = 1;

    const GATEWAY_ACTIVE_STATUS = 1;
    const GATEWAY_INACTIVE_STATUS = 0;
}
