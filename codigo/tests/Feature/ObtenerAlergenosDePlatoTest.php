<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ObtenerAlergenosDePlatoTest extends TestCase
{
	private $ruta = "http://localhost:8000/api/obtenerAlergenosDePlato";

    public function testFuncionamientoNormal()
    {

        $response = $this->call('GET', $this->ruta, ["nombre" => "tosta de tomate"]);
    	$this->assertEquals(200, $response->status());
    }

    public function testErroresParametros()
    {
    	//required
        $response = $this->call('GET', $this->ruta);
    	$this->assertEquals(400, $response->status());

    	//required
    	$response = $this->call('GET', $this->ruta, ["nombreee" => "patatas cocidas"]);
    	$this->assertEquals(400, $response->status());

    	//exists
    	$response = $this->call('GET', $this->ruta, ["nombre" => "12313132"]);
    	$this->assertEquals(400, $response->status());

    	//string
    	$response = $this->call('GET', $this->ruta, ["nombre" => 54]);
    	$this->assertEquals(400, $response->status());
    }
}
