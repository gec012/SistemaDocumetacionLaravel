<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleDeIncidenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_de_incidentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incidente_id')->unsigned();
            $table->foreign('incidente_id')->references('id')->on('incidentes');
            $table->integer('send_id')->unsigned();
            $table->foreign('send_id')->references('id')->on('users');
            $table->integer('recived_id')->unsigned()->nullable()->default(null);
            $table->foreign('recived_id')->references('id')->on('users');
            $table->timestamp('hora_de_recibido')->nullable();
            $table->string('estado');
            $table->integer('sector_id')->unsigned()->nullable();
            $table->foreign('sector_id')->references('id')->on('sectores');
            $table->string('observaciones');
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
        Schema::dropIfExists('detalles_de_incidentes');
    }
}
