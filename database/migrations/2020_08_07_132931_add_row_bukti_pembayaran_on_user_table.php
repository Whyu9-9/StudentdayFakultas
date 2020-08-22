<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowBuktiPembayaranOnUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('users', 'bukti_pembayaran')){
            Schema::table('users', function ($table) {
                $table->text('bukti_pembayaran')->nullable();
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
        if(Schema::hasColumn('users', 'bukti_pembayaran')){
            Schema::table('users', function(Blueprint $table){
                $table->dropColumn('bukti_pembayaran');
            });
        }
    }
}
