<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientePlato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingrediente_plato', function (Blueprint $table) {
            //Campos
            $table->string('plato_Nombre', 100);
            $table->string('ingrediente_Nombre', 100);

            //Restricciones
            $table->primary(['plato_Nombre', 'ingrediente_Nombre'], "PK_plato_ingrediente");

            $table->foreign('plato_Nombre', "FK_plato_ingrediente-plato")
                  ->references('Nombre')->on('platos')
                  ->onDelete('restrict');

            $table->foreign('ingrediente_Nombre', "FK_plato_ingrediente-ingrediente")
                  ->references('Nombre')->on('ingredientes')
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
        Schema::dropIfExists('ingrediente_plato');
    }
}
