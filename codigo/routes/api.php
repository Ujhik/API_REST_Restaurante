<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Las rutas empiezan por direcciónIp/api/<endpoint>

/* Parametros:
	Obligatorios:
		nombre=[string]*/
Route::get('obtenerAlergenosDePlato', 'ObtenerAlergenosDePlato');

/* Parametros:
	Obligatorios:
		nombre=[string]*/
Route::get('obtenerPlatosDeAlergeno', 'ObtenerPlatosDeAlergeno');

/* Parametros:
	Obligatorios:
		nombre=[string]*/
Route::put('altaAlergeno', 'AlergenosController@store');

/* Parametros:
	Obligatorios:
		nombre=[string]
	Opcionales:
		alergenos=[string1,...,stringN]*/
Route::put('altaIngrediente', 'IngredientesController@store');

/* Parametros:
	Obligatorios:
		nombre=[string]
		ingredientes=[string1,...,stringN]*/
Route::put('altaPlato', 'PlatosController@store');

/* Parametros:
	Obligatorios:
		nombre=[string]
		ingredientes=[string1,...,stringN]*/
Route::post('modificarIngredientesDePlato', 'ModificarIngredientesDePlato');
