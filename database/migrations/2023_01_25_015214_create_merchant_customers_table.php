<?php

use App\Helpers\IStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('merchant_id')->constrained('users')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('mobile_number')->nullable();
            $table->enum('status',[IStatuses::ACTIVE,IStatuses::INACTIVE])->default(IStatuses::ACTIVE);
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
        Schema::dropIfExists('merchant_customers');
    }
};
