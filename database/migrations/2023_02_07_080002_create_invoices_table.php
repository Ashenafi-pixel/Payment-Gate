<?php

use App\Helpers\IEnvironment;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->comment('merchant as user id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('customer_id')->comment('payer of invoices')->nullable()
                  ->constrained('merchant_customers')
                  ->cascadeOnDelete();
            $table->foreignId('student_id')->comment('payer of invoices')->nullable()
                  ->constrained('merchant_students')
                  ->cascadeOnDelete();
            $table->string('purpose')->nullable();
            $table->decimal('amount',20,2)->nullable();
            $table->boolean('status')->default(true)
                  ->comment('invoices active or inactive')
                  ->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
