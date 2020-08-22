<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowTipeTableNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        //
        if(Schema::hasColumn('notes', 'tipe')){
            Schema::table('notes', function(Blueprint $table){
                $table->dropColumn('tipe');
            });
        }
        if(!Schema::hasColumn('notes', 'tipe')){
            Schema::table('notes', function ($table) {
                $table->enum('tipe', ['registrasi', 'verifikasi'])->nullable();
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
        if(Schema::hasColumn('notes', 'tipe')){
            Schema::table('notes', function(Blueprint $table){
                $table->dropColumn('tipe');
            });
        }
    }
}
