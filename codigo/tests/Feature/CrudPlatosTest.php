<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudPlatosTest extends TestCase
{
	use DatabaseTransactions;

    private $rutaAlta = "http://localhost:8000/api/altaPlato";

    public function testAltaFuncionamientoNormal()
    {
    	//Alta con un ingrediente
    	$nombrePlato = "PlatoPrueba1";
    	$ingredientes = ["tomate"];

        $response = $this->call('PUT', $this->rutaAlta, ["nombre" => $nombrePlato, "ingredientes" => $ingredientes]);
    	$this->assertEquals(201, $response->status());

    	$this->assertDatabaseHas('platos', ['Nombre' => $nombrePlato]);

    	$this->assertDatabaseHas('ingrediente_plato', ['plato_Nombre' => $nombrePlato, 'ingrediente_Nombre' => $ingredientes[0]]);

    	//Alta con 2 ingredientes
    	$nombrePlato = "PlatoPrueba2";
    	$ingredientes = ["tomate", "gambas"];

        $response = $this->call('PUT', $this->rutaAlta, ["nombre" => $nombrePlato, "ingredientes" => $ingredientes]);
    	$this->assertEquals(201, $response->status());

    	$this->assertDatabaseHas('platos', ['Nombre' => $nombrePlato]);

    	$this->assertDatabaseHas('ingrediente_plato', ['plato_Nombre' => $nombrePlato, 'ingrediente_Nombre' => $ingredientes[0]]);
    	$this->assertDatabaseHas('ingrediente_plato', ['plato_Nombre' => $nombrePlato, 'ingrediente_Nombre' => $ingredientes[1]]);
    }

    public function testAltaErroresParametros()
    {
    	//required nombre
        $response = $this->call('PUT', $this->rutaAlta);
    	$this->assertEquals(400, $response->status());

    	//required nombre
    	$response = $this->call('PUT', $this->rutaAlta, ["nombreee" => "patatas cocidas"]);
    	$this->assertEquals(400, $response->status());

    	//unique nombre
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "patatas cocidas"]);
    	$this->assertEquals(400, $response->status());

    	//string nombre
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => 54]);
    	$this->assertEquals(400, $response->status());

    	//required ingredientes
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "nuevoIngrediente"]);
    	$this->assertEquals(400, $response->status());

    	//exists ingredientes
    	$ingredientes = ["1233321"];
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "nuevoIngrediente", "ingredientes" => $ingredientes]);
    	$this->assertEquals(400, $response->status());

    	//distinct ingredientes
    	$ingredientes = ["tomate", "tomate"];
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "nuevoIngrediente", "ingredientes" => $ingredientes]);
    	$this->assertEquals(400, $response->status());
    }
}
