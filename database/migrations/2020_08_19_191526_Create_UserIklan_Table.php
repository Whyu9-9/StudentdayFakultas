<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserIklanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('useriklan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('kegiatan', ['dies', 'granat', 'bursa', 'sd']);
            $table->integer('flag');
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
        //
        Schema::dropIfExists('useriklan');
    }
}
