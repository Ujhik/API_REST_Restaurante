<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Model\Plato;
use App\Model\Ingrediente;
use App\Model\CambiosPlatos;

class ModificarIngredientesDePlato extends Controller
{
     public function __invoke(Request $request)
    {
        $reglas = array(
            'nombre'    =>  'required|exists:platos,Nombre|string',
            "ingredientes"    => "required|array|min:1",
            "ingredientes.*"  => "required|string|distinct|exists:ingredientes,Nombre|min:1",

        );

        $mensajesError = [
            'required' => 'El atributo :attribute es necesario.',
            'exists' => 'El atributo :attribute no existe en la base de datos',
            'string' => 'El atributo :attribute no es un string',
            'distinct' => 'Los elementos del atributo :attribute no pueden estar duplicados',
            'unique' => 'El :attribute ya existe en la base de datos',
            'array' => 'El atributo :attribute debe ser un array'
        ];

        $validador = Validator::make($request->all(), $reglas, $mensajesError);

        if ($validador->fails()) {
            return response()->json(['errores'=>$validador->errors()], 400);
        } else {
            
            $plato = Plato::find($request->all()["nombre"]);

            //Si no hay diferencia en ingredientes con los ingredientes actuales no registrar cambio
            $ingredientesActuales = $plato->ingredientes->pluck('Nombre');
            $ingredientesNuevos = collect($request->all()["ingredientes"]);

            if($ingredientesActuales->count() == $ingredientesNuevos->count() 
                && $ingredientesActuales->intersect($ingredientesNuevos)->count() == $ingredientesActuales->count()){
            	return response()->json(["errores" => ["ingredientes" => "Debe haber al menos 1 diferencia con los ingredientes que figuran en la base de datos"]], 400); 
            }else{
                //Registrando los cambios
	            $plato->ingredientes()->sync($request->all()["ingredientes"]);

	            $plato = Plato::find($request->all()["nombre"]);

	            $arrayIngredientesAlergenos = [];

	            foreach ($plato->ingredientes as $ingrediente) {
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

            return response()->json($request->only(['nombre', "ingredientes"]), 200);
        }
    }
}
