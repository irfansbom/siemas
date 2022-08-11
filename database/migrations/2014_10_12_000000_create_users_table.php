<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pengawas')->nullable();
            $table->string('alamat')->nullable();
            $table->char('kd_wilayah', 6)->nullable();
            $table->char('no_hp', 15)->nullable();
            $table->char('flag', 2)->default('1');;
            $table->rememberToken();
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
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
        Schema::dropIfExists('users');
    }
}
