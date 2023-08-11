<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerTest extends TestCase
{
    public function test_seller_create(): void
    {
        $malRegistro = $this->post('/api/seller/create', ["selDireccion" => "Cra 50", "selNumContacto" => "320568321"]);
        $malRegistro->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenRegistro = $this->post('/api/seller/create', ["selDireccion" => "Cra 50", "selNumContacto" => "320568321", "selPermiso" => "permiso.pdf", "user_id" => 1]);
        $buenRegistro->assertStatus(200);
    }

    public function test_seller_read(): void
    {
        $obtenerVendedores = $this->get('/api/seller/read');
        $obtenerVendedores->assertStatus(200);
    }

    public function test_seller_update(): void
    {
        $malProcedimiento = $this->patch('/api/seller/update', ["selDireccion" => "Cra 50", "selNumContacto" => "320568321"]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->patch('/api/seller/update', ["id" => 2, "selDireccion" => "Cra 50", "selNumContacto" => "320568321", "selPermiso" => "permiso.pdf", "user_id" => 1]);
        $buenProcedimiento->assertStatus(200);
    }

    public function test_seller_delete(): void
    {
        $malProcedimiento = $this->delete('/api/seller/delete', ["idVendedor" => 2]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->delete('/api/seller/delete', ["id" => 2]);
        $buenProcedimiento->assertStatus(200);
    }
}
