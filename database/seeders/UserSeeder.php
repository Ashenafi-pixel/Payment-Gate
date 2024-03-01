<?php

namespace Database\Seeders;

use App\Helpers\IStatuses;
use App\Models\User;
use App\Helpers\IUserRole;
use App\Helpers\IMediaType;
use App\Helpers\IUserStatuses;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'      => 'admin',
            'username'  => 'adminUser',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('rootadmin'),
            'status'    => IUserStatuses::USER_ACTIVE,
            'is_first_time' => IUserStatuses::IS_FIRST_TIME,
        ]);
        $admin->assignRole(IUserRole::ADMIN_ROLE);
        $admin->image()->create([
            'url'   =>  'http://127.0.0.1:8000/images/user-img.png',
            'type'  =>  IMediaType::IMAGE
        ]);

        $merchant = User::create([
           'name'       => 'merchant',
           'username'   => 'merchantUser',
           'email'      => 'merchant@merchant.com',
           'password'   => bcrypt('rootadmin'),
           'status'      => IUserStatuses::USER_ACTIVE,
           'is_first_time' => IUserStatuses::IS_FIRST_TIME,
        ]);
        $merchant->assignRole(IUserRole::MERCHANT_ROLE);
        $merchant->image()->create([
            'url'   =>  'http://127.0.0.1:8000/images/user-img.png',
            'type'  =>  IMediaType::IMAGE
        ]);
        $merchant->merchantDetail()->create([
            'document_details' => '{"cnic_doc":"\/storage\/uploads\/document\/vjKrdpn90g-1680152570.pdf","cnic_doc_status":"APPROVED","cnic_created_date":"2023-03-30T05:02:50.635068Z","license_doc":"\/storage\/uploads\/document\/KNHxly0K7X-1680152570.png","license_doc_status":"APPROVED","license_created_date":"2023-03-30T05:02:50.635309Z","registration_form_doc":"\/storage\/uploads\/document\/gyEA8y1eUj-1680152570.pdf","registration_form_doc_status":"APPROVED","registration_form_created_date":"2023-03-30T05:02:50.635491Z"}',
            'status' => IStatuses::APPROVED,
        ]);

        $customer = User::create([
            'name'       => 'customer',
            'username'   => 'customerUser',
            'email'      => 'customer@customer.com',
            'password'   => bcrypt('rootadmin'),
            'status'      => IUserStatuses::USER_ACTIVE,
            'is_first_time' => IUserStatuses::IS_FIRST_TIME,
            'is_verified' => true
        ]);
        $customer->assignRole(IUserRole::CUSTOMER_ROLE);
        $customer->customerDetail()->create([
           'balance'    =>  10000,
            'document_details' => '{"cnic_doc":"\/storage\/uploads\/document\/vjKrdpn90g-1680152570.pdf","cnic_doc_status":"APPROVED","cnic_created_date":"2023-03-30T05:02:50.635068Z","license_doc":"\/storage\/uploads\/document\/KNHxly0K7X-1680152570.png","license_doc_status":"APPROVED","license_created_date":"2023-03-30T05:02:50.635309Z","registration_form_doc":"\/storage\/uploads\/document\/gyEA8y1eUj-1680152570.pdf","registration_form_doc_status":"APPROVED","registration_form_created_date":"2023-03-30T05:02:50.635491Z"}',
           'status'     =>  IUserStatuses::APPROVED,
        ]);
        $customer->image()->create([
            'url'   =>  'http://127.0.0.1:8000/images/user-img.png',
            'type'  =>  IMediaType::IMAGE
        ]);
    }
}
