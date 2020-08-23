<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMinatBakatAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('users', 'minat_bakat')){
            Schema::table('users', function ($table) {
                $table->text('minat_bakat')->nullable();
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
        if(Schema::hasColumn('users', 'minat_bakat')){
            Schema::table('users', function(Blueprint $table){
                $table->dropColumn('minat_bakat');
            });
        }
    }
}
