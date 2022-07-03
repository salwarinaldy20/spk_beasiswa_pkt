<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrKonsultasiHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_konsultasi_hasil', function (Blueprint $table) {
            $table->string('id_hasil', 100)->primary();
            $table->string('id_header', 100)->index('id_header');
            $table->string('id_penyakit', 100)->index('id_penyakit');
            $table->string('persentase', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_konsultasi_hasil');
    }
}
