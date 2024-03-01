<?php

namespace Database\Seeders;

use App\Helpers\IUserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\VarDumper\VarDumper;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            array(
                'name' => 'admin_read',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'admin_create',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'admin_edit',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'admin_delete',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'merchant_read',
                'guard_name' => 'web',
            ), array(
                'name' => 'merchant_index',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'merchant_create',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'merchant_edit',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'merchant_delete',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'merchant_settings',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'customer_read',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'customer_create',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'customer_edit',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'customer_delete',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'role_read',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'role_create',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'role_edit',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'role_delete',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'ledger_read',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'ledger_delete',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'gateway_read',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'gateway_edit',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'report_read',
                'guard_name' => 'web',
            ),
            array(
                'name' => 'report_delete',
                'guard_name' => 'web',
            ), array(
                'name' => 'theme_create',
                'guard_name' => 'web',
            ), array(
                'name' => 'theme_read',
                'guard_name' => 'web',
            ), array(
                'name' => 'theme_edit',
                'guard_name' => 'web',
            ), array(
                'name' => 'theme_delete',
                'guard_name' => 'web',
            ), array(
                'name' => 'logs_delete',
                'guard_name' => 'web',
            ), array(
                'name' => 'logs_read',
                'guard_name' => 'web',
            ), array(
                'name' => 'logs_download',
                'guard_name' => 'web',
            ), array(
                'name' => 'withdrawal_request_create',
                'guard_name' => 'web',
            ), array(
                'name' => 'withdrawal_request_read',
                'guard_name' => 'web',
            ), array(
                'name' => 'withdrawal_request_edit',
                'guard_name' => 'web',
            ), array(
                'name' => 'withdrawal_request_delete',
                'guard_name' => 'web',
            ), array(
                'name' => 'withdrawal_request_list',
                'guard_name' => 'web',
            ), array(
                'name' => 'currency_read',
                'guard_name' => 'web',
            ), array(
                'name' => 'currency_edit',
                'guard_name' => 'web',
            ), array(
                'name' => 'currency_list',
                'guard_name' => 'web',
            ), array(
                'name' => 'currency_delete',
                'guard_name' => 'web',
            ), array(
                'name' => 'bank_create',
                'guard_name' => 'web',
            ), array(
                'name' => 'bank_edit',
                'guard_name' => 'web',
            ), array(
                'name' => 'bank_delete',
                'guard_name' => 'web',
            ),array(
                'name' => 'bank_read',
                'guard_name' => 'web',
            ),array(
                'name' => 'bank_list',
                'guard_name' => 'web',
            ),
        ];

        $role_create = Role::create(['name' => IUserRole::ADMIN_ROLE, 'guard_name' => 'web']);
        VarDumper::dump('Role ' . $role_create->name . ' has been created');
        $merchant_role = Role::create(['name' => IUserRole::MERCHANT_ROLE, 'guard_name' => 'web']);
        VarDumper::dump('Role ' . $merchant_role->name . ' has been created');
        $merchant_role = Role::create(['name' => IUserRole::CUSTOMER_ROLE, 'guard_name' => 'web']);
        VarDumper::dump('Role ' . $merchant_role->name . ' has been created');

        foreach ($permissions as $permission) {
            $created_permission = Permission::create($permission);
            VarDumper::dump('Permission ' . $created_permission->name . ' has been created');
            $role_create->givePermissionTo($created_permission);
            VarDumper::dump("Assign Permission " . $created_permission->name . " to " . $role_create->name);
        }

        //Merchant permissions set
        $merchant_permissions = 'merchant_settings';
        $merchant_role->givePermissionTo($merchant_permissions);
    }
}
