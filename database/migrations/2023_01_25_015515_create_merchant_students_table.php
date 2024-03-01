<?php

use App\Helpers\IStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    const ACTIVE = true;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('merchant_id')->constrained('users')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->text('address')->nullable();
            $table->enum('status',[IStatuses::ACTIVE,IStatuses::INACTIVE])->default(IStatuses::ACTIVE);
            $table->string('email')->nullable();
            $table->bigInteger('mobile_number')->nullable();
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
        Schema::dropIfExists('merchant_students');
    }
};
