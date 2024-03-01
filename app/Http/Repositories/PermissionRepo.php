<?php

namespace App\Http\Repositories;

use Spatie\Permission\Models\Permission;

/**
* @var PermissionRepo
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class PermissionRepo extends BaseRepo
{
    public function __construct()
     {
           parent::__construct(Permission::class);
     }

}
