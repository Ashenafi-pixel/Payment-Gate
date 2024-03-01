<?php

use App\Helpers\IEnvironment;
use App\Helpers\IStatuses;
use App\Helpers\IUserStatuses;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('public_key')->nullable();
            $table->string('private_key')->nullable();
            $table->string('email_otp')->nullable();
            $table->string('phone_otp')->nullable();
            $table->boolean('is_first_time')->default(true)->comment('check is user first time');
            $table->enum('status',[IUserStatuses::USER_ACTIVE,IUserStatuses::USER_NON_ACTIVE])
                    ->comment('to check user is active or inactive')
                    ->default(IUserStatuses::USER_NON_ACTIVE);
            $table->string('api_token')->nullable()->default(null);
            $table->string('device_token')->nullable()->default(null);
            $table->string('email_verified_token')->nullable();
            $table->boolean('is_verified')->default(false)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_school')->default(false);
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
