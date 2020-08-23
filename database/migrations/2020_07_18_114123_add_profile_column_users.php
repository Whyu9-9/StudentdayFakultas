<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('users', 'profile') || !Schema::hasColumn('users', 'youtube')){
            Schema::table('users', function ($table) {
                $table->text('profile')->nullable();
                $table->text('youtube')->nullable();
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
        if(Schema::hasColumn('users', 'profile')){
            Schema::table('users', function(Blueprint $table){
                $table->dropColumn('profile');
            });
        }
        
        if(Schema::hasColumn('users', 'youtube')){
            Schema::table('users', function(Blueprint $table){
                $table->dropColumn('youtube');
            });
        }
    }
}
