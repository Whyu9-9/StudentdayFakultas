<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('materis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->enum('jenis', ['jurusan', 'kelompok_studi', 'lembaga']);
            $table->text('gambar');
            $table->text('link');
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
        Schema::dropIfExists('materis');
    }
}
