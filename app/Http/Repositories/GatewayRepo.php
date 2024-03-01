<?php

namespace App\Http\Repositories;

use App\Models\Gateway;

/**
 * @var GatewayRepo
 * @author farhan.akram@xintsolutions.com>
 */
class GatewayRepo extends BaseRepo
{
    public function __construct()
    {
        parent::__construct(Gateway::class);
    }
}
