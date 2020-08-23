<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResumeTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('resume_time');

        Schema::create('resume_time', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prodi_id');
            $table->timestamp('mulai');
            $table->timestamp('berakhir');
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
        Schema::dropIfExists('resume_time');
    }
}
