<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudIngredientesTest extends TestCase
{
    use DatabaseTransactions;

    private $rutaAlta = "http://localhost:8000/api/altaIngrediente";

    public function testAltaFuncionamientoNormal()
    {
    	//Alta sin alergenos
    	$nombreIngrediente = "ingredientePrueba1";

        $response = $this->call('PUT', $this->rutaAlta, ["nombre" => $nombreIngrediente]);
    	$this->assertEquals(201, $response->status());

    	$this->assertDatabaseHas('ingredientes', ['Nombre' => $nombreIngrediente]);

    	//Alta con un alergeno
    	$nombreIngrediente = "ingredientePrueba2";
    	$alergenos = ["gluten"];

        $response = $this->call('PUT', $this->rutaAlta, ["nombre" => $nombreIngrediente, "alergenos" => $alergenos]);
    	$this->assertEquals(201, $response->status());

    	$this->assertDatabaseHas('ingredientes', ['Nombre' => $nombreIngrediente]);

    	$this->assertDatabaseHas('alergeno_ingrediente', ['ingrediente_Nombre' => $nombreIngrediente, 'alergeno_Nombre' => $alergenos[0]]);

    	//Alta con 2 alergenos
    	$nombreIngrediente = "ingredientePrueba3";
    	$alergenos = ["gluten", "leche"];

        $response = $this->call('PUT', $this->rutaAlta, ["nombre" => $nombreIngrediente, "alergenos" => $alergenos]);
    	$this->assertEquals(201, $response->status());

    	$this->assertDatabaseHas('ingredientes', ['Nombre' => $nombreIngrediente]);

    	$this->assertDatabaseHas('alergeno_ingrediente', ['ingrediente_Nombre' => $nombreIngrediente, 'alergeno_Nombre' => $alergenos[0]]);
    	$this->assertDatabaseHas('alergeno_ingrediente', ['ingrediente_Nombre' => $nombreIngrediente, 'alergeno_Nombre' => $alergenos[1]]);
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
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "tomate"]);
    	$this->assertEquals(400, $response->status());

    	//string nombre
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => 54]);
    	$this->assertEquals(400, $response->status());

    	//exists alergenos
    	$alergenos = ["1233321"];
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "nuevoIngrediente", "alergenos" => $alergenos]);
    	$this->assertEquals(400, $response->status());

    	//distinct alergenos
    	$alergenos = ["gluten", "gluten"];
    	$response = $this->call('PUT', $this->rutaAlta, ["nombre" => "nuevoIngrediente", "alergenos" => $alergenos]);
    	$this->assertEquals(400, $response->status());
    }
}
