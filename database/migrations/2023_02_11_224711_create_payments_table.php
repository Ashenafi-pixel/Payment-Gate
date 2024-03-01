<?php

use App\Helpers\IStatuses;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')
                  ->constrained('transactions')
                  ->cascadeOnDelete();
            $table->string('payment_code')->comment('payment code by gateway');
            $table->enum('status',[IStatuses::TRANSACTION_SUCCESS, IStatuses::TRANSACTION_DECLINED])
                  ->default(IStatuses::TRANSACTION_SUCCESS);
            $table->json('response')->comment('response from gateway can be modified');
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
        Schema::dropIfExists('payments');
    }
};
