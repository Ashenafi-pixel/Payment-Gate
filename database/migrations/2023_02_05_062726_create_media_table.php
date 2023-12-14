<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const IMAGE = 'image';
    const VIDEO = 'video';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('media_able');
            $table->enum('type',[self::IMAGE,self::VIDEO])
                  ->comment('either image or video')
                  ->default(self::IMAGE);
            $table->string('url')->comment('source');
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
        Schema::dropIfExists('media');
    }
};
