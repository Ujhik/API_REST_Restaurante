<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Model\CambiosPlatos;
use App\Model\Plato;

class CambiosPlatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cambios_platos')->delete();

        $platos = Plato::all();

        //Generando un registro de modificacion por cada plato incluido en la base de datos
        foreach ($platos as $plato){
        	$arrayIngredientesAlergenos = [];

        	$ingredientes = $plato->ingredientes;

        	foreach ($ingredientes as $ingrediente) {

        		$arrayAlergenos = [];

        		$alergenos = $ingrediente->alergenos;

        		foreach($alergenos as $alergeno){
        			array_push($arrayAlergenos, $alergeno->Nombre);
        		}

        		$ingredienteConAlergenos = ['ingrediente' => $ingrediente->Nombre, 'alergenos' => $arrayAlergenos];

        		array_push($arrayIngredientesAlergenos, $ingredienteConAlergenos);
        	}

        	CambiosPlatos::create([
	        	'plato_Nombre' => $plato->Nombre, 
	        	'fecha_cambio' => Carbon::now(), 
	        	'ingredientes_y_alergenos' => json_encode($arrayIngredientesAlergenos),
	        ]);
        }
    }
}
