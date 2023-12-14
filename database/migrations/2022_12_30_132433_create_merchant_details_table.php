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
        Schema::create('merchant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->unique()->nullable();
            $table->text('company_address')->nullable();
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
        Schema::dropIfExists('merchant_details');
    }
};
