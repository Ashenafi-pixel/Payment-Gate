<?php

namespace Database\Seeders;

use App\Helpers\GeneralHelper;
use App\Helpers\IMediaType;
use App\Helpers\IUserStatuses;
use App\Models\Gateway;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('gateways')->truncate();
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $gateways = array(
            array('id' => '1','name' => 'Visa Master Card','currency_name' => 'BIR','status' => IUserStatuses::USER_ACTIVE,'created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('id' => '2','name' => 'Online Banking','currency_name' => 'BIR','status' => IUserStatuses::USER_ACTIVE,'created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('id' => '3','name' => 'PayTabs','currency_name' => 'BIR','status' => IUserStatuses::USER_ACTIVE,'created_at' => Carbon::now(),'updated_at' => Carbon::now()),
        );

        foreach ($gateways as $gateway)
        {
           $create = Gateway::create($gateway);
           $image = "images/site/icons/visa.svg";
           $create->image()->create([
               'url' => $image,
               'type' => IMediaType::IMAGE,
           ]);
        }
    }
}
