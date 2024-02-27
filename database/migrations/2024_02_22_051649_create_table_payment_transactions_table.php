<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            //
            $table->id()->primary();
            $table->string('name');
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('session_id');
            $table->string('amount');
            $table->string('customer_account');
            $table->string('customer_name');
            $table->string('transaction_type');
            $table->string('payment_status');
            $table->string('settlment_status');
            $table->date('date');
            $table->float('commission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            //
            Schema::dropIfExists('payment_transactions');
        });
    }
};
