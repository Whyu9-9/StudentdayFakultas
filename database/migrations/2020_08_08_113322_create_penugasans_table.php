<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenugasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('penugasans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prodi_id');
            $table->integer('user_id');
            $table->text('file');
            $table->enum('tipe', ['jawab_soal', 'essay', 'tugas_khusus']);
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
        Schema::dropIfExists('penugasans');
    }
}
