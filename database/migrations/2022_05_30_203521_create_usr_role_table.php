<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsrRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usr_role', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('role', 50)->nullable();
            $table->text('priviledges')->nullable();
            $table->boolean('active')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('updated_by', 50)->nullable();
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
        Schema::dropIfExists('usr_role');
    }
}
