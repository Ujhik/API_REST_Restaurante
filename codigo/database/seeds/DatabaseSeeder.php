<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	//Borrado previo para evitar problemas con las claves foraneas
        DB::table('cambios_platos')->delete();
    	DB::table('ingrediente_plato')->delete();
    	DB::table('alergeno_ingrediente')->delete();
    	DB::table('platos')->delete();
    	DB::table('ingredientes')->delete();
    	DB::table('alergenos')->delete();
    	
    	
        $this->call(PlatosTableSeeder::class);
        $this->call(IngredientesTableSeeder::class);
        $this->call(AlergenosTableSeeder::class);
        $this->call(IngredientePlatoTableSeeder::class);
        $this->call(AlergenoIngredienteTableSeeder::class);
        $this->call(CambiosPlatosTableSeeder::class);
    }
}
