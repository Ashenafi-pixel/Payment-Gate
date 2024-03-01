<?php

use App\Helpers\IGatewayRate;
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
        Schema::create('merchant_gateway_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('gateway_id')->constrained('gateways')->cascadeOnDelete();
            $table->enum('key',[IGatewayRate::FIX, IGatewayRate::PERCENTAGE]);
            $table->bigInteger('value')->comment('amount to be charged on specific rate by admin');
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
        Schema::dropIfExists('merchant_gateway_rates');
    }
};
