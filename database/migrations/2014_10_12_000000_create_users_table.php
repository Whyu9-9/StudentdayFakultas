<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim', 10);
            $table->string('password', 100);
            $table->string('nama', 50);
            $table->string('nama_panggilan',15)->nullable();
            $table->tinyInteger('program_studi')->nullable();
            $table->tinyInteger('jenis_kelamin')->nullable();
            $table->tinyInteger('agama')->nullable();
            $table->string('alasan_kuliah', 100)->nullable();
            $table->tinyInteger('gol_darah')->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('alamat_sekarang', 100)->nullable();
            $table->string('no_telepon', 15)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('email',50)->unique()->nullable();
            $table->string('asal_sekolah', 20)->nullable();
            $table->string('hobi', 50)->nullable();
            $table->string('cita_cita', 50)->nullable();
            $table->string('idola', 50)->nullable();
            $table->string('moto', 50)->nullable();
            $table->tinyInteger('jumlah_saudara')->nullable();
            $table->string('nama_ayah', 50)->nullable();
            $table->string('nama_ibu', 50)->nullable();
            $table->tinyInteger('vegetarian')->nullable();
            $table->string('penyakit_khusus', 50)->nullable();
            $table->tinyInteger('mahasiswa_baru')->nullable();
            $table->integer('angkatan')->nullable();
            $table->tinyInteger('ganti_pass')->default(0);
            $table->tinyInteger('lengkap')->default(0);
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
