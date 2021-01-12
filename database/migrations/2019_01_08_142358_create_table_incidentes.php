<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIncidentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('detalle');
            $table->string('estado');
            $table->string('caracter');
            $table->integer('reporter_id')->unsigned();
            $table->foreign('reporter_id')->references('id')->on('users');
            $table->integer('resolver_id')->unsigned()->nullable();
            $table->foreign('resolver_id')->references('id')->on('users');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->string('imagen')->nullable();
            $table->timestamp('finalizado')->nullable();
            
            

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
        Schema::dropIfExists('incidentes');
    }
}
