<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_create(): void
    {
        $malRegistro = $this->post('/api/user/create', ["useNombre" => "Andres", "useApellido" => "Gomez"]);
        $malRegistro->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenRegistro = $this->post('/api/user/create', ["useNombres" => "Joseph Alejandro", "useApellidos" => "Trujillo Aguilar", "useCorreo" => "joseph@gmail.com", "usePassword" => "123456", "useRol" => "Comprador"]);
        $buenRegistro->assertStatus(200);
    }

    public function test_user_read(): void
    {
        $obtenerUsuarios = $this->get('/api/user/read');
        $obtenerUsuarios->assertStatus(200);
    }

    public function test_user_update(): void
    {
        $malProcedimiento = $this->patch('/api/user/update', ["useNombre" => "Andres", "useApellido" => "Gomez"]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->patch('/api/user/update', ["id" => 2, "useNombres" => "Joseph Alejandro", "useApellidos" => "Trujillo Aguilar", "useCorreo" => "joseph@gmail.com", "usePassword" => "123456", "useRol" => "Comprador"]);
        $buenProcedimiento->assertStatus(200);
    }

    public function test_user_delete(): void
    {
        $malProcedimiento = $this->delete('/api/user/delete', ["idUsuario" => 2]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->delete('/api/user/delete', ["id" => 2]);
        $buenProcedimiento->assertStatus(200);
    }
}
