<?php

use Illuminate\Database\Seeder;

use App\Model\Ingrediente;
use App\Model\Alergeno;

class AlergenoIngredienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alergeno_ingrediente')->delete();

        //Relación de elementos para añadir a la base de datos
        $listaAlergIngred = array(
        	"tosta" => ["gluten",],
            "huevo" => ["huevo",],
            "merluza" => ["pescado",],
            "vino blanco" => ["sulfitos",],
            "roquefort" => ["leche"],
            "gambas" => ["crustáceos",],
            "salsa vino" => ["sulfitos", "leche",],
            "salsa gamba" => ["crustáceos", "sésamo"],
            "salsa queso" => ["leche", "mostaza", "soja", "gluten", "frutos secos",],
        );

        //Añadiendo automáticamente todos
        foreach ($listaAlergIngred as $ingrediente => $alergenos){
            $alergenosIngrediente = Ingrediente::find($ingrediente)->alergenos();

            foreach ($alergenos as $alergeno){
                $alergenosIngrediente->attach(Alergeno::find($alergeno));
            }
        }
    }
}
