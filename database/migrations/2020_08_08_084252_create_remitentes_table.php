<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemitentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remitentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('entrada_id');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('codigo_postal')->nullable();
            $table->string('ciudad');
            $table->string('estado');
            $table->string('pais');
            $table->string('telefono')->nullable();
            $table->unsignedSmallInteger('created_by_user');
            $table->unsignedSmallInteger('updated_by_user');
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
        Schema::dropIfExists('remitentes');
    }
}