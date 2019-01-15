<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Model\Plato;

class ObtenerAlergenosDePlato extends Controller
{
    public function __invoke(Request $request){

        $reglas = array(
            "nombre"    => "required|string|exists:platos,Nombre",
        );

        $mensajesError = [
            'required' => 'El atributo :attribute es necesario.',
            'exists' => 'El atributo :attribute no existe en la base de datos',
            'string' => 'El atributo :attribute no es un string',

        ];

        $validador = Validator::make($request->all(), $reglas, $mensajesError);

        if ($validador->fails()) {
            return response()->json(['errores'=>$validador->errors()], 400);
        } else {

        	$plato = Plato::findOrFail($request->all()["nombre"]);

        	$alergenos=array();

        	foreach( $plato->ingredientes as $ingrediente ){
        		foreach( $ingrediente->alergenos as $alergeno){
        			array_push($alergenos, $alergeno->Nombre);
        		}
        	}

            $alergenos = array_values(array_unique($alergenos));
        }

    	return response()
            ->json($alergenos, 200);
    }
}
