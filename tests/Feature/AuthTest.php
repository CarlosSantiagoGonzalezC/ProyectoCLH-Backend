<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login(): void
    {
        $malInicio = $this->post('/api/auth', ["useCorreos" => "sc805036@gmail.com", "usePasswords" => "123456"]);
        $malInicio->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"401","error_msg":"No autorizado"}}');

        $buenInicio = $this->post('/api/auth', ["useCorreo" => "sc805036@gmail.com", "usePassword" => "123456"]);
        $buenInicio->assertStatus(200);
    }
}
