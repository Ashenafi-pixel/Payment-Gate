<?php

// database/migrations/xxxx_xx_xx_create_received_data_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedDataTable extends Migration
{
    public function up()
    {
        Schema::create('received_data', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->string('message')->default('Data received successfully');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('received_data');
    }
}
