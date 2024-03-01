<?php

namespace App\Http\Services;

use App\Helpers\IUserRole;
use App\Http\Repositories\PermissionRepo;
use App\Http\Repositories\RoleRepo;
use Illuminate\Support\Collection;


/**
 * @package RoleService
 * @author Shaarif <m.shaarif@xintsolutions.com>
 */
class RoleService
{
    /**
     * @var RoleRepo
     */
    private RoleRepo $roleRepo;

    private PermissionRepo $permissionRepo;

    /**
     * @param RoleRepo $roleRepo
     */
    public function __construct(
        RoleRepo $roleRepo,
        PermissionRepo $permissionRepo
    )
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * @return object
     */
    public function getAllRoles(): object
    {
        return $this->roleRepo->model->where('name', '!=', IUserRole::ADMIN_ROLE)->latest()->paginate(10);
    }

    /**
     * @return Collection
     */
    public function getAllPermissions(): Collection
    {
        return $this->permissionRepo->all()->pluck('name');
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteRole($id):bool
    {
        return $this->roleRepo->delete($id);
    }

    /**
     * @return object|Null
     */
    public function getCustomerRoleExist(): object | Null
    {
        return $this->roleRepo->model->where('name', IUserRole::CUSTOMER_ROLE)->first();
    }

    /**
     * @return object|Null
     */
    public function getMerchantRoleExist(): object | Null
    {
        return $this->roleRepo->model->where('name', IUserRole::MERCHANT_ROLE)->first();
    }
}
