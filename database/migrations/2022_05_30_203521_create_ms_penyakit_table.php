<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsPenyakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_penyakit', function (Blueprint $table) {
            $table->string('id_penyakit', 100)->primary();
            $table->string('nama_penyakit', 150);
            $table->text('penyebab');
            $table->text('solusi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_penyakit');
    }
}
