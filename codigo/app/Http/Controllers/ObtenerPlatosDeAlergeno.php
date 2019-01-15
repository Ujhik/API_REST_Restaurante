<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Model\Alergeno;

class ObtenerPlatosDeAlergeno extends Controller
{
    public function __invoke(Request $request){

        $reglas = array(
            "nombre"    => "required|string|exists:alergenos,Nombre",
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

        	$alergeno = Alergeno::findOrFail($request->all()["nombre"]);

        	$platos=array();

        	foreach( $alergeno->ingredientes as $ingrediente ){
        		foreach( $ingrediente->platos as $plato){
        			array_push($platos, $plato->Nombre);
        		}
        	}

        	$platos = array_values(array_unique($platos));
        }

    	return response()
            ->json($platos, 200);
    }
}
