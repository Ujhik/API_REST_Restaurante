<?php

use Illuminate\Database\Seeder;

use App\Model\Ingrediente;

class IngredientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredientes')->delete();

        $ingredientes = array(
        	"huevo",
        	"tomate",
        	"oregano",
        	"aceite",
        	"merluza",
        	"gambas",
        	"patatas",
        	"cebolla",
        	"vino blanco",
        	"roquefort",
        	"salsa vino",
        	"salsa gamba",
        	"salsa queso",
        	"tosta",
        );

        foreach ($ingredientes as $ingrediente) {
        	Ingrediente::create(['Nombre' => $ingrediente,]);
        }
    }
}
