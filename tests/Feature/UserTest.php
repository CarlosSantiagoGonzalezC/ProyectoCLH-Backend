<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_create(): void
    {
        $malRegistro = $this->post('/api/user/create', ["useNombre" => "Andres", "useApellido" => "Gomez"]);
        $malRegistro->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenRegistro = $this->post('/api/user/create', ["useNombres" => "Joseph Alejandro", "useApellidos" => "Trujillo Aguilar", "useCorreo" => "joseph@gmail.com", "usePassword" => "123456", "useRol" => "Comprador"]);
        $buenRegistro->assertStatus(200);
    }
}
