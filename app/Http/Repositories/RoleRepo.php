<?php

namespace App\Http\Repositories;

use Spatie\Permission\Models\Role;

/**
* @var RoleRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class RoleRepo extends BaseRepo
{
    public function __construct()
    {
        parent::__construct(Role::class);
    }
}
