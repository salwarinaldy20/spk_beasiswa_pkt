<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_rules', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('id_penyakit', 100)->index('id_penyakit');
            $table->string('id_gejala', 100)->index('id_gejala');
            $table->double('bobot');
            $table->string('created_by', 100);
            $table->dateTime('created_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_rules');
    }
}
