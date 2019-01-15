<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlergenoIngrediente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alergeno_ingrediente', function (Blueprint $table) {
            //Campos
            $table->string('ingrediente_Nombre', 100);
            $table->string('alergeno_Nombre', 100);

            //Restricciones
            $table->primary(['ingrediente_Nombre', 'alergeno_Nombre'], "PK_ingrediente_alergeno");

            $table->foreign('ingrediente_Nombre', "FK_ingrediente_alergeno-ingrediente")
                  ->references('Nombre')->on('ingredientes')
                  ->onDelete('restrict');

            $table->foreign('alergeno_Nombre', "FK_ingrediente_alergeno-alergeno")
                  ->references('Nombre')->on('alergenos')
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
        Schema::dropIfExists('alergeno_ingrediente');
    }
}
