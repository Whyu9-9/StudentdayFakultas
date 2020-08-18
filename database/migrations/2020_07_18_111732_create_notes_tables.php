<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('notes');
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('notes');
            $table->enum('tipe', ['registrasi', 'verifkasi']);
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
        Schema::dropIfExists('notes');
    }
}
