<?php

namespace Database\Seeders;

use App\Models\TelecomCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class TelecomCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $telecom_companies = [
          'Ethiotelcom Burayu Shope',
          'Broadcom Networks Consultancy Service Plc',
          'Glow Network Ltd (Ethiopian Branch)',
          'Water Ethio Telecom Station',
          'Habtel ሀብቴል 哈布特',
          'Ethiotelecom Mercato Branch',
          'Moss Com',
          'Arba Minch Telecommunication'
        ];
        foreach ($telecom_companies as $company)
        {
            TelecomCompany::create([
               'name'   =>  $company
            ]);
            VarDumper::dump('Network company '.$company.' :: has been added');
        }
    }
}
