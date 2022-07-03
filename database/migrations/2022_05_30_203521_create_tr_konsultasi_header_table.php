<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrKonsultasiHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_konsultasi_header', function (Blueprint $table) {
            $table->string('id_header', 100)->primary();
            $table->string('id_user', 100)->index('id_user');
            $table->text('catatatan_pasien');
            $table->text('keterangan');
            $table->boolean('active');
            $table->dateTime('created_on');
            $table->string('created_by', 150);
            $table->string('updated_by', 150);
            $table->dateTime('updated_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_konsultasi_header');
    }
}
