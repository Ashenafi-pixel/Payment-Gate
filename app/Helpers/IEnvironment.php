<?php

namespace App\Helpers;

interface IEnvironment
{
    /**
    * @var IEnvironment
    * @author Shaarif <m.shaarif@xintsolutions.com>
    */

    const SANDBOX       =   'SANDBOX';

    const PRODUCTION    =   'PRODUCTION';

    const WITHDRAW = 'WITHDRAW';

    const DEPOSIT = 'DEPOSIT';
}
