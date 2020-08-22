<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnScanSakit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('users', 'scan_penyakit') || !Schema::hasColumn('users', 'koordinator')){
            Schema::table('users', function ($table) {
                $table->text('scan_penyakit')->nullable();
                $table->tinyInteger('koordinator')->default(0);
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
        if(Schema::hasColumn('users', 'scan_penyakit')){
            Schema::table('users', function(Blueprint $table){
                $table->dropColumn('scan_penyakit');
            });
        }
        
        if(Schema::hasColumn('users', 'koordinator')){
            Schema::table('users', function(Blueprint $table){
                $table->dropColumn('koordinator');
            });
        }
    }
}
