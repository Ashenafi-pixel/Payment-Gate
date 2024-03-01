<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @var TransactionTypeSeeder
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction_types = config('transaction-types.transaction_type');
        foreach ($transaction_types as $name => $transaction_type) {
            $transaction = TransactionType::where('name',$name)->first();
            if (!$transaction){
                $create_record = TransactionType::create([
                    'name' => $name
                ]);
                VarDumper::dump('Adding Transaction type ' . $name . ' :: ' . $transaction_type);
            }else{
                VarDumper::dump('Already Exists Transaction type ' . $name . ' :: ' . $transaction_type);
            }
        }
    }
}
