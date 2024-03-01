<?php

use App\Helpers\IEnvironment;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->comment('customer id who is paying')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('gateway_id')->nullable()
                  ->constrained('gateways')
                  ->cascadeOnDelete();
            $table->foreignId('invoice_id')->nullable()
                  ->constrained('invoices')
                  ->cascadeOnDelete();
            $table->foreignId('transaction_type')->comment('mobile top-up or load or transfer etc')
                  ->constrained('transaction_types')
                  ->cascadeOnDelete();
            $table->decimal('debit',20,2)->default(0);
            $table->decimal('credit',20,2)->default(0);
            $table->enum('type',[IStatuses::WITHDRAW,IStatuses::DEPOSIT])
                  ->default(IStatuses::DEPOSIT)
                  ->comment('1 means withdraw 2 means deposit');
            $table->decimal('addispay_commission',20,2)->default(0)
                  ->comment('will be set by admin on base of gateway and will included in final amount');
            $table->string('trx_id')->comment('transaction id')->nullable();
            $table->enum('status',[IStatuses::TRANSACTION_PENDING, IStatuses::TRANSACTION_DECLINED,
                    IStatuses::TRANSACTION_SUCCESS])
                  ->default(IStatuses::TRANSACTION_PENDING);
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
        Schema::dropIfExists('transactions');
    }
};
