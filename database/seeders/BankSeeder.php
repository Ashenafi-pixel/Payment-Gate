<?php

namespace Database\Seeders;

use App\Models\Banks;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = config('banks.Banks');
        $array = [];
        foreach ($banks as $name => $bank){
            $array[] = [
                'name'       => $name,
                'swift_code' => $bank,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            VarDumper::dump('Bank '. $name . 'is created with Swift code '.$bank);
        }
        Banks::insert($array);
    }
}
