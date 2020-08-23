<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowPenugasan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('notes', 'tugas')){
            Schema::table('notes', function ($table) {
                $table->text('tugas')->nullable();
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
        if(Schema::hasColumn('notes', 'tugas')){
            Schema::table('notes', function(Blueprint $table){
                $table->dropColumn('tugas');
            });
        }
    }
}
