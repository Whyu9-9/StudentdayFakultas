<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBerkasPrestasiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('prestasis', 'berkas')){
            Schema::table('prestasis', function ($table) {
                $table->text('berkas')->nullable();
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
        if(Schema::hasColumn('prestasis', 'berkas')){
            Schema::table('prestasis', function(Blueprint $table){
                $table->dropColumn('berkas');
            });
        }
    }
}
