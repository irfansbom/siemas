<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabs', function (Blueprint $table) {
            $table->char('id_prov', 2);
            $table->char('id_kab', 2);
            $table->string('nama_kab', 255);
            $table->string('alias', 50);
        });
        
        Schema::create('kecs', function (Blueprint $table) {
            $table->char('id_prov', 2);
            $table->char('id_kab', 2);
            $table->char('id_kec', 3);
            $table->string('nama_kec', 255);
        });
        
        Schema::create('desas', function (Blueprint $table) {
            $table->char('id_prov', 2);
            $table->char('id_kab', 2);
            $table->char('id_kec', 3);
            $table->char('id_desa', 3);
            $table->string('nama_desa', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kabs');
        Schema::dropIfExists('kecs');
        Schema::dropIfExists('desas');
    }
}
