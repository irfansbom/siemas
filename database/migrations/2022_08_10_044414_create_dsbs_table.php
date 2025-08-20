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
            $table->string('tahun', 4);
            $table->string('semester', 1);
            $table->string('kd_kab', 2);
            $table->string('kd_kec', 3);
            $table->string('kd_desa', 3);
            $table->string('kd_bs', 6);
            $table->string('id_bs', 16);
            $table->string('nks', 6);
            $table->string('sls')->nullable();
            $table->integer('jml_rt')->nullable();
            $table->string('pencacah')->nullable();
            $table->string('pengawas')->nullable();
            $table->integer('flag_active')->default('1');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->unique(['kd_kab', 'kd_kec', 'kd_desa', 'kd_bs', 'tahun', 'semester'], 'dsrt');
        });


        Schema::create('dsrt', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 4);
            $table->integer('semester');
            $table->string('kd_kab', 2);
            $table->string('kd_kec', 3);
            $table->string('kd_desa', 3);
            $table->string('kd_bs', 6);
            $table->string('id_bs', 16);
            $table->integer('nu_rt');
            $table->string('nks', 6);
            $table->string('status_pencacahan')->default(0);

            $table->string('nama_krt_prelist')->nullable();
            $table->integer('jml_art_prelist')->nullable();
            $table->string('nama_krt_cacah')->nullable();
            $table->integer('jml_art_cacah')->nullable();

            $table->string('status_rumah')->nullable();
            $table->integer('jml_komoditas_makanan')->nullable();
            $table->integer('jml_komoditas_nonmakanan')->nullable();
            $table->string('makanan_sebulan', 20)->nullable();
            $table->string('nonmakanan_sebulan', 20)->nullable();
            $table->string('makanan_sebulan_bypml', 20)->nullable();
            $table->string('nonmakanan_sebulan_bypml', 20)->nullable();

            $table->string('transportasi', 20)->nullable();
            $table->string('peliharaan', 20)->nullable();
            $table->integer('art_sekolah')->nullable();
            $table->integer('art_bpjs')->nullable();
            $table->string('ijazah_krt', 30)->nullable();
            $table->string('kegiatan_seminggu')->nullable();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->integer('luas_lantai')->nullable();

            $table->integer('gsmp')->nullable();
            $table->text('gsmp_desk')->nullable();
            $table->integer('bantuan')->nullable();
            $table->text('bantuan_desk')->nullable();
            $table->string('listrik_jenis', 20)->nullable();
            $table->string('listrik_daya', 10)->nullable();
            $table->decimal('listrik_harga', 10, 2)->nullable();
            $table->decimal('listrik_kwh', 10, 2)->nullable();
            $table->integer('sekolah_rakyat')->nullable();
            $table->integer('mbg')->nullable();
            $table->text('menu_mbg')->nullable();
            $table->integer('rincian_int_1')->nullable();
            $table->integer('rincian_int_2')->nullable();
            $table->text('foto')->nullable();

            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->string('latitude_selesai', 20)->nullable();
            $table->string('longitude_selesai', 20)->nullable();

            $table->string('jam_mulai', 20)->nullable();
            $table->string('jam_selesai', 20)->nullable();
            $table->string('durasi_pencacahan', 10)->nullable();

            $table->string('pencacah')->nullable();
            $table->string('pengawas')->nullable();
            $table->integer('flag_active')->default('1');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->unique(['tahun', 'semester', 'kd_kab', 'kd_kec', 'kd_desa', 'kd_bs', 'nu_rt'], 'dsrt');
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
