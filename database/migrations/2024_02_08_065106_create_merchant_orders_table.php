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
    Schema::create('merchant_orders', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('amount', 8, 2);
        $table->string('email');
        $table->string('tx_ref')->unique();
        $table->string('currency');
        $table->string('first_name');
        $table->string('last_name');
        $table->json('order_detail');
        $table->string('message')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_orders');
    }
};
