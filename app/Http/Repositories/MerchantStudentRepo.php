<?php

namespace App\Http\Repositories;

use App\Models\MerchantStudent;

/**
 * @var MerchantStudentRepo
 * @author Farhan <farhan.akram@xintsolutions.com>
 */
class MerchantStudentRepo extends BaseRepo
{
    public function __construct()
    {
        parent::__construct(MerchantStudent::class);
    }
}
