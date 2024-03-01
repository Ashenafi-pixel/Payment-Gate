<?php

namespace App\Http\Repositories;

use App\Models\MerchantDetail;

/**
 * @var MerchantDetailRepo
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class MerchantDetailRepo extends BaseRepo
{

    public function __construct()
    {
        parent::__construct(MerchantDetail::class);
    }
}
