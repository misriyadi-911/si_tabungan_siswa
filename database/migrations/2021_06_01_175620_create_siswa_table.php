<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->integer('id_orangtua');
            $table->string('nis', 15);
            $table->string('nama_siswa', 100);
            $table->string('alamat_siswa', 500);
            $table->string('nohp_siswa', 15);
            $table->string('jenis_kelamin_siswa', 50);
            $table->integer('id_kelas');
            $table->string('no_rekening', 50);
            $table->string('foto_siswa', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
