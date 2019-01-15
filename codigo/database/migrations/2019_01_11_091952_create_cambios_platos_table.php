<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCambiosPlatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios_platos', function (Blueprint $table) {
            //Campos
            $table->string('plato_Nombre', 100);
            $table->dateTime('fecha_cambio');
            $table->text("ingredientes_y_alergenos");

            //Restricciones
            $table->primary(['plato_Nombre', 'fecha_cambio'], "PK_cambios_platos");

            $table->foreign('plato_Nombre', "FK_cambios_platos-plato")
                  ->references('Nombre')->on('platos')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cambios_platos');
    }
}
