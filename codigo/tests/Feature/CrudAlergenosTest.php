<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudAlergenosTest extends TestCase
{
	use DatabaseTransactions;

    private $rutaAlta = "http://localhost:8000/api/altaAlergeno";

    public function testAltaFuncionamientoNormal()
    {
    	$nombreAlergeno = "alergenoPrueba";

        $response = $this->call('PUT', $this->rutaAlta, ["nombre" => $nombreAlergeno]);
    	$this->assertEquals(201, $response->status());

    	$this->assertDatabaseHas('alergenos', ['Nombre' => $nombreAlergeno]);
    }

    public function testAltaErroresParametros()
    {
    	//required
        $response = $this->call('PUT', $this->rutaAlta);
    	$this->assertEquals(400, $response->status());

    	//required
    	$response = $this->call('PUT', $this->rutaAlta, ["nombreee" => "patatas cocidas"]);
    	$this->assertEquals(400, $response->status());

    	//unique
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "gluten"]);
    	$this->assertEquals(400, $response->status());

    	//string
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => 54]);
    	$this->assertEquals(400, $response->status());
    }
}
