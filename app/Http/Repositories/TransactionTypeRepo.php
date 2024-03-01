<?php

namespace App\Http\Repositories;

use App\Models\TransactionType;

/**
 * @var TransactionTypeRepo
 * @author Shaarif<shaarifsabah5299@gmail.com>
 */
class TransactionTypeRepo extends BaseRepo
{

    public function __construct()
    {
        parent::__construct(TransactionType::class);
    }
}
