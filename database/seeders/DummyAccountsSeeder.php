<?php

namespace Database\Seeders;

use App\Helpers\GeneralHelper;
use App\Models\DummyAccounts;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @var DummyAccountsSeeder
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class DummyAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 4; $i++) {
            $account_number = "1234".$i;
            $array = [
                'account_number' => $account_number,
                'name' => fake()->name,
                'email' => fake()->email,
                'mobile_number' => fake()->phoneNumber,
            ];
            $create = DummyAccounts::create($array);
            VarDumper::dump('User dummy account ' . $create->account_number . ':: ' . $create->name);
        }
    }
}
