<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporan212Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_212', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 4);
            $table->integer('semester');
            $table->string('kd_kab', 2);
            $table->string('kd_kec', 3);
            $table->string('kd_desa', 3);
            $table->string('kd_bs', 4);
            $table->integer('nu_rt');
            $table->string('nks', 6);
            $table->string('nama_krt', 255);
            $table->string('pengawas', 255);
            $table->date('tanggal');
            $table->integer('status');
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
        Schema::dropIfExists('laporan_212');
    }
}
