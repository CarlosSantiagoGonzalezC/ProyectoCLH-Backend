<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    public function test_company_create(): void
    {
        $malRegistro = $this->post('/api/company/create', ["comNombre" => "Alma Cafe", "comHistoria" => "Desde 1989 creando el mejor cafe"]);
        $malRegistro->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenRegistro = $this->post('/api/company/create', ["comNombre" => "Alma Cafe", "comHistoria" => "Desde 1989 creando el mejor cafe", "comImagen" => "cafe.png", "comMunicipio" => "Neiva", "comDireccion" => "Cra 20", "comTelefono" => "3214569695", "comCorreo" => "almacafe@gmail.com", "seller_id" => 1]);
        $buenRegistro->assertStatus(200);
    }

    public function test_company_read(): void
    {
        $obtenerEmpresas = $this->get('/api/company/read');
        $obtenerEmpresas->assertStatus(200);
    }

    public function test_company_update(): void
    {
        $malProcedimiento = $this->patch('/api/company/update', ["comNombre" => "Alma Cafe", "comHistoria" => "Desde 1989 creando el mejor cafe"]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->patch('/api/company/update', ["id" => 2, "comNombre" => "Alma Cafe", "comHistoria" => "Desde 1989 creando el mejor cafe", "comImagen" => "cafe.png", "comMunicipio" => "Neiva", "comDireccion" => "Cra 20", "comTelefono" => "3214569695", "comCorreo" => "almacafe@gmail.com", "seller_id" => 1]);
        $buenProcedimiento->assertStatus(200);
    }

    public function test_company_delete(): void
    {
        $malProcedimiento = $this->delete('/api/company/delete', ["idFinca/Empresa" => 2]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->delete('/api/company/delete', ["id" => 2]);
        $buenProcedimiento->assertStatus(200);
    }
}
