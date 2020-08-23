<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowKegiatanPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('pembelian_baju', 'kegiatan')){
            Schema::table('pembelian_baju', function ($table) {
                $table->enum('kegiatan', ['dies', 'granat', 'bursa', 'sd'])->nullable()->default(null);
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
        if(Schema::hasColumn('pembelian_baju', 'kegiatan')){
            Schema::table('pembelian_baju', function(Blueprint $table){
                $table->dropColumn('kegiatan');
            });
        }
    }
}
