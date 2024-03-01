<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\VarDumper\VarDumper;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BankSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            GatewaySeeder::class,
            TransactionTypeSeeder::class,
            DummyAccountsSeeder::class,
            TelecomCompanySeeder::class,
            CurrencySeeder::class,
        ]);
         $response = \Artisan::call('passport:install');
//        $this->call(BankSeeder::class);
//        $this->call(RolePermissionSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(GatewaySeeder::class);
//        $this->call(TransactionTypeSeeder::class);
//        $this->call(DummyAccountsSeeder::class);
//        $this->call(TelecomCompanySeeder::class);
       }
}
