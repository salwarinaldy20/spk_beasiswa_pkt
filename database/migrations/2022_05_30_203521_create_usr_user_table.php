<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsrUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usr_user', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('id_role', 100)->index('id_role');
            $table->string('nama', 150)->nullable();
            $table->string('usia', 10)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('jenis_kelamin', 100)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('username', 150);
            $table->string('password', 150);
            $table->string('foto_user', 150)->default('default.png');
            $table->string('google_id', 200)->nullable();
            $table->boolean('active')->default(false);
            $table->dateTime('last_login')->nullable();
            $table->string('created_by', 150)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('updated_by', 150)->nullable();
            $table->dateTime('updated_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usr_user');
    }
}
