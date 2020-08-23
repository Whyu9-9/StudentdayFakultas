<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPenugasanId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('penugasans', 'penugasan_id')){
            Schema::table('penugasans', function ($table) {
                $table->integer('penugasan_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if(Schema::hasColumn('penugasans', 'penugasan_id')){
            Schema::table('penugasans', function(Blueprint $table){
                $table->dropColumn('penugasan_id');
            });
        }
    }
}
