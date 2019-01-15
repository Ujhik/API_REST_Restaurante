<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Model\Plato;

class PlatosController extends Controller
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
            'nombre'    =>  'required|unique:platos,Nombre|string',
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
            $plato = Plato::create(["Nombre" => $request->all()["nombre"]]);

            foreach ($request->all()["ingredientes"] as $ingrediente) {
                $plato->ingredientes()->attach($ingrediente);
            }

            return response()->json($request->only(['nombre', "ingredientes"]), 201);
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
