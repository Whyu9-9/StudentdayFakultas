<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenugasanRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('penugasansetting', function (Blueprint $table) {
            $table->increments('id');
            $table->text('keterangan');
            $table->text('file')->nullable();
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
        Schema::dropIfExists('penugasansetting');
    }
}
