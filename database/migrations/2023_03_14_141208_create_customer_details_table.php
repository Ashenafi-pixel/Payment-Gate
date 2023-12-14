<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\IStatuses;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->bigInteger('balance')->nullable()->comment('customer current balance');
            $table->longText('document_details')->nullable();
            $table->enum('status', [IStatuses::MERCHANT_PENDING, IStatuses::MERCHANT_APPROVED, IStatuses::MERCHANT_REJECTED])
                ->default(IStatuses::MERCHANT_PENDING);
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
        Schema::dropIfExists('customer_details');
    }
};
