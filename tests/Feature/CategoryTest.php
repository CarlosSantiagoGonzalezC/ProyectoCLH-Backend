<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_category_create(): void
    {
        $malRegistro = $this->post('/api/category/create', ["catNombres" => "Especial"]);
        $malRegistro->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenRegistro = $this->post('/api/category/create', ["catNombre" => "Especial"]);
        $buenRegistro->assertStatus(200);
    }

    public function test_category_read(): void
    {
        $obtenerCategorias = $this->get('/api/category/read');
        $obtenerCategorias->assertStatus(200);
    }

    public function test_category_update(): void
    {
        $malProcedimiento = $this->patch('/api/category/update', ["catNombres" => "Especial"]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->patch('/api/category/update', ["id" => 2, "catNombre" => "Especial"]);
        $buenProcedimiento->assertStatus(200);
    }

    public function test_category_delete(): void
    {
        $malProcedimiento = $this->delete('/api/category/delete', ["idCategoria" => 2]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->delete('/api/category/delete', ["id" => 2]);
        $buenProcedimiento->assertStatus(200);
    }
}
