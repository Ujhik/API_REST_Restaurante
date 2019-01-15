<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModificarIngredientesDePlatoTest extends TestCase
{
    use DatabaseTransactions;

    private $ruta = "http://localhost:8000/api/modificarIngredientesDePlato";

    public function testFuncionamientoNormal()
    {
    	//Modificar con 1 ingrediente
    	$nombrePlato = "patatas cocidas";
    	$ingredientes1 = ["patatas"];

        $response = $this->call('POST', $this->ruta, ["nombre" => $nombrePlato, "ingredientes" => $ingredientes1]);
    	$this->assertEquals(200, $response->status());

    	$this->assertDatabaseHas('platos', ['Nombre' => $nombrePlato]);

    	$this->assertDatabaseHas('ingrediente_plato', ['plato_Nombre' => $nombrePlato, 'ingrediente_Nombre' => $ingredientes1[0]]);

    	sleep(2);

    	//Modificar con 2 ingredientes
    	$nombrePlato = "patatas cocidas";
    	$ingredientes2 = ["gambas", "tosta"];

        $response = $this->call('POST', $this->ruta, ["nombre" => $nombrePlato, "ingredientes" => $ingredientes2]);
    	$this->assertEquals(200, $response->status());

    	$this->assertDatabaseHas('platos', ['Nombre' => $nombrePlato]);

    	$this->assertDatabaseHas('ingrediente_plato', ['plato_Nombre' => $nombrePlato, 'ingrediente_Nombre' => $ingredientes2[0]]);
    	$this->assertDatabaseHas('ingrediente_plato', ['plato_Nombre' => $nombrePlato, 'ingrediente_Nombre' => $ingredientes2[1]]);

    	$this->assertDatabaseMissing('ingrediente_plato', ['plato_Nombre' => $nombrePlato, 'ingrediente_Nombre' => $ingredientes1[0]]);
    }

    public function testAltaErroresParametros()
    {
    	//required nombre
        $response = $this->call('POST', $this->ruta);
    	$this->assertEquals(400, $response->status());

    	//required nombre
    	$response = $this->call('POST', $this->ruta, ["nombreee" => "patatas cocidas"]);
    	$this->assertEquals(400, $response->status());

    	//exists nombre
    	$response = $this->call('POST', $this->ruta, ["nombre" => "12312333"]);
    	$this->assertEquals(400, $response->status());

    	//string nombre
    	$response = $this->call('POST', $this->ruta, ["nombre" => 54]);
    	$this->assertEquals(400, $response->status());

    	//required ingredientes
    	$response = $this->call('POST', $this->ruta, ["nombre" => "nuevoIngrediente"]);
    	$this->assertEquals(400, $response->status());

    	//exists ingredientes
    	$ingredientes = ["1233321"];
    	$response = $this->call('POST', $this->ruta, ["nombre" => "nuevoIngrediente", "ingredientes" => $ingredientes]);
    	$this->assertEquals(400, $response->status());

    	//distinct ingredientes
    	$ingredientes = ["tomate", "tomate"];
    	$response = $this->call('POST', $this->ruta, ["nombre" => "nuevoIngrediente", "ingredientes" => $ingredientes]);
    	$this->assertEquals(400, $response->status());
    }
}
