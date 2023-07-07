<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsArtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsart', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 4);
            $table->integer('semester');
            $table->string('kd_kab', 2);
            $table->string('kd_kec', 3);
            $table->string('kd_desa', 3);
            $table->string('kd_bs', 4);
            $table->string('nks', 6);
            $table->integer('nu_rt');
            $table->integer('nu_art');
            $table->string('nama_art', 100);
            $table->string('pekerjaan', 30);
            $table->string('pendapatan', 20);
            $table->string('pendidikan', 50);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->unique(['tahun', 'semester', 'kd_kab', 'kd_kec', 'kd_desa', 'kd_bs', "nu_rt", "nu_art"], 'dsart');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dsart');
    }
}
