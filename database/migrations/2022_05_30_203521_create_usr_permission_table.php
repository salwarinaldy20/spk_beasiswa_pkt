<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsrPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usr_permission', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('permission_key', 150);
            $table->text('keterangan')->nullable();
            $table->string('kategori', 150)->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('usr_permission');
    }
}
