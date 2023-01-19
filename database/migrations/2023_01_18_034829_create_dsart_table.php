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
            $table->char('id_bs', 15);
            $table->char('kd_kab', 3);
            $table->char('nks', 6);
            $table->char('tahun',5);
            $table->integer('semester');
            $table->integer('nu_rt');

            $table->integer('nu_art');
            $table->char('nama_art', 30);
            $table->char('pekerjaan', 15);
            $table->char('pendapatan', 20);
            $table->char('pendidikan', 30);

            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
            $table->unique(["id_bs",'tahun', 'semester',"nu_rt", "nu_art"], 'dsart');
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
