<?php

use Illuminate\Database\Seeder;

use App\Model\Plato;

class PlatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platos')->delete();

        $ingredientes = array(
            "tosta de tomate",
            "revuelto de gambas con merluza",
            "patatas cocidas",
            "gambas al roquefort",
            "merluza a las 3 salsas",
        );

        foreach ($ingredientes as $ingrediente) {
            Plato::create(['Nombre' => $ingrediente,]);
        }
    }
}
