<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantBankTable extends Migration
{
    public function up()
    {
        Schema::create('merchant_bank', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchant_details');
            $table->foreignId('bank_id')->constrained('banks');
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('account_number')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('merchant_bank');
    }
}
