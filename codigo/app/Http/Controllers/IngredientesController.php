<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Model\Ingrediente;

class IngredientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = array(
            'nombre'    =>  'required|unique:ingredientes,Nombre|string',
            "alergenos"    => "nullable|array|min:1",
            "alergenos.*"  => "required|string|distinct|exists:alergenos,Nombre|min:1",
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
            $ingrediente = Ingrediente::create(["Nombre" => $request->all()["nombre"]]);

            if($request->exists("alergenos")){
                foreach ($request->all()["alergenos"] as $alergeno) {
                    $ingrediente->alergenos()->attach($alergeno);
                }
            }

            return response()->json($request->only(['nombre', "alergenos"]), 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
