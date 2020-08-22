<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoteIlmiahAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('notes_ilmiah', 'notes')){
            Schema::table('notes', function ($table) {
                $table->text('notes_ilmiah')->nullable();
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
        if(Schema::hasColumn('notes_ilmiah', 'notes')){
            Schema::table('notes', function(Blueprint $table){
                $table->dropColumn('notes_ilmiah');
            });
        }
    }
}
