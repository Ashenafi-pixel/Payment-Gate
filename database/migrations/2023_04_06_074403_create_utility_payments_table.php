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
        Schema::create('utility_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id')
                  ->nullable()
                  ->constrained('transactions')
                  ->cascadeOnDelete();
            $table->string('manifest_id')->nullable();
            $table->string('bill_id')->nullable();
            $table->string('name')->nullable();
            $table->string('amount_due')->nullable();
            $table->date('due_date')->nullable();
            $table->string('paid_at')->nullable();
            $table->json('response_object')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('utility_payments');
    }
};
