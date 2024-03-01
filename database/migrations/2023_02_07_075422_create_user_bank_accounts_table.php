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
        Schema::create('user_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('can be user or merchant')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('bank_id')->comment('banks table')
                  ->constrained('banks')
                  ->cascadeOnDelete();
            $table->string('account_no')->nullable()->comment('encrypted');
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
        Schema::dropIfExists('user_bank_accounts');
    }
};
