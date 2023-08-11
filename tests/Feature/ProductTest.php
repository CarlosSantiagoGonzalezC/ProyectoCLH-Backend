<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_product_create(): void
    {
        $malRegistro = $this->post('/api/product/create', ["proCodigo" => 256, "proNombre" => "Cafe especial"]);
        $malRegistro->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenRegistro = $this->post('/api/product/create', ["proCodigo" => 256, "proNombre" => "Cafe especial", "proDescripcion" => "El mejor cafe", "proCantDisponible" => 8, "proPrecio" => 56000, "proImagen" => "cafe.jpg", "category_id" => 1, "user_id" => 1]);
        $buenRegistro->assertStatus(200);
    }

    public function test_product_read(): void
    {
        $obtenerProductos = $this->get('/api/product/read');
        $obtenerProductos->assertStatus(200);
    }

    public function test_product_update(): void
    {
        $malProcedimiento = $this->patch('/api/product/update', ["proCodigo" => 256, "proNombre" => "Cafe especial"]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->patch('/api/product/update', ["id" => 2, "proCodigo" => 256, "proNombre" => "Cafe especial", "proDescripcion" => "El mejor cafe", "proCantDisponible" => 8, "proPrecio" => 56000, "proImagen" => "cafe.jpg", "category_id" => 1, "user_id" => 1]);
        $buenProcedimiento->assertStatus(200);
    }

    public function test_product_delete(): void
    {
        $malProcedimiento = $this->delete('/api/product/delete', ["idProducto" => 2]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->delete('/api/product/delete', ["id" => 2]);
        $buenProcedimiento->assertStatus(200);
    }
}
