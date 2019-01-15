<?php

use Illuminate\Database\Seeder;

use App\Model\Plato;
use App\Model\Ingrediente;

class IngredientePlatoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingrediente_plato')->delete();

        //Relación de elementos para añadir a la base de datos
        $listaIngPlato = array(
            "tosta de tomate" => ["tomate", "tosta", "oregano", "aceite"],
            "revuelto de gambas con merluza" => ["huevo", "merluza", "gambas", "cebolla", "salsa vino"],
            "patatas cocidas" => ["patatas", "cebolla"],
            "gambas al roquefort" => ["gambas", "roquefort", "oregano", "aceite"],
            "merluza a las 3 salsas" => ["merluza", "salsa vino", "salsa gamba", "salsa queso"],
            
        );

        //Añadiendo automáticamente todos
        foreach ($listaIngPlato as $plato => $ingredientes){
            $ingredientesPlato = Plato::find($plato)->ingredientes();

            foreach ($ingredientes as $ingrediente){
                $ingredientesPlato->attach(Ingrediente::find($ingrediente));
            }
        }
    }
}
