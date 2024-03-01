<?php

namespace App\Http\Repositories;

use App\Helpers\IStatuses;
use App\Models\User;

/**
 * @var UserRepo
 * @author farhan.akram@xintsolutions.com>
 */

class UserRepo extends BaseRepo
{

    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateMerchantDetails($id,$data): mixed
    {
        $update = $this->model()->find($id)->merchantDetail()->update(['details' => json_encode($data)]);
        if ($update && !in_array(IStatuses::MERCHANT_REJECTED, $data))
            return $this->model()->find($id)->merchantDetail()->update(['status' => IStatuses::MERCHANT_APPROVED]);
        else
            return $this->model()->find($id)->merchantDetail()->update(['status' => IStatuses::MERCHANT_PENDING]);
    }
}
