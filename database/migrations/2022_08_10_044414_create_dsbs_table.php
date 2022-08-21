<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsbs', function (Blueprint $table) {
            $table->id();
            $table->char('kd_kab', 3);
            $table->char('kd_kec', 4);
            $table->char('kd_desa', 4);
            $table->char('nbs', 5);
            $table->char('id_bs', 15)->unique();
            $table->char('nks', 6)->unique();
            $table->string('status')->nullable();
            $table->integer('jumlah_rt_c1')->nullable();
            $table->integer('sumber')->nullable();
            $table->string('pencacah')->nullable();
            $table->string('pengawas')->nullable();
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });


        Schema::create('dsrt', function (Blueprint $table) {
            $table->id();
            $table->char('id_bs', 15);
            $table->char('kd_kab', 3);
            $table->char('nks', 6);
            $table->integer('nu_rt');
            $table->integer('semester');
            $table->string('alamat', 100)->nullable();
            $table->string('nuc1')->nullable();

            $table->string('nama_krt', 100)->nullable();
            $table->string('jml_art', 4)->nullable();
            $table->string('nama_krt2', 100)->nullable();
            $table->string('jml_art2', 4)->nullable();

            $table->string('status_rumah', 2)->nullable();
            $table->string('makanan_sebulan', 15)->nullable();
            $table->string('nonmakanan_sebulan', 15)->nullable();
            $table->string('transportasi', 15)->nullable();
            $table->string('peliharaan', 15)->nullable();
            $table->integer('art_sekolah')->nullable();
            $table->integer('art_bpjs')->nullable();
            $table->string('ijazah_krt', 30)->nullable();
            $table->string('kegiatan_seminggu')->nullable();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->integer('luas_lantai')->nullable();

            $table->string('status_pencacahan')->nullable();
            $table->string('lama_pencacahan', 10)->nullable();

            $table->integer('gsmp')->nullable();
            $table->text('foto')->nullable();
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->string('pencacah')->nullable();
            $table->string('pengawas')->nullable();

            $table->integer('jumlah_rt_c1')->nullable();
            $table->integer('sumber')->nullable();

            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();

            $table->unique(["id_bs", "nu_rt", 'semester'], 'dsrt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dsbs');
    }
}
