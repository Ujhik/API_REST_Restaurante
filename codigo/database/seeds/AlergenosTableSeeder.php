<?php

use Illuminate\Database\Seeder;

use App\Model\Alergeno;

class AlergenosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alergenos')->delete();

        $alergenos = array(
        	"leche",
        	"huevo",
        	"gluten",
        	"frutos secos",
        	"soja",
        	"pescado",
        	"crustáceos",
        	"apio",
        	"mostaza",
        	"sésamo",
        	"sulfitos",
        	"altramuces",
        	"moluscos",

        );

        foreach ($alergenos as $alergeno) {
        	Alergeno::create(['Nombre' => $alergeno,]);
        }
        
    }
}
