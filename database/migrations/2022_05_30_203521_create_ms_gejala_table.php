<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsGejalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_gejala', function (Blueprint $table) {
            $table->string('id_gejala', 100)->primary();
            $table->string('nama_gejala', 200);
            $table->dateTime('created_on');
            $table->string('created_by', 150);
            $table->dateTime('updated_on');
            $table->string('updated_by', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_gejala');
    }
}
