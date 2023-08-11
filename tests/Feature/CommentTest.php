<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function test_comment_create(): void
    {
        $malRegistro = $this->post('/api/comment/create', ["comTexto" => "Excelente producto", "product_id" => 1]);
        $malRegistro->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenRegistro = $this->post('/api/comment/create', ["comTexto" => "Excelente producto", "product_id" => 1, "user_id" => 1]);
        $buenRegistro->assertStatus(200);
    }

    public function test_comment_read(): void
    {
        $obtenerComentarios = $this->get('/api/comment/read');
        $obtenerComentarios->assertStatus(200);
    }

    public function test_comment_update(): void
    {
        $malProcedimiento = $this->patch('/api/comment/update', ["comTexto" => "Excelente producto", "product_id" => 1]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->patch('/api/comment/update', ["id" => 2, "comTexto" => "Excelente producto", "product_id" => 1, "user_id" => 1]);
        $buenProcedimiento->assertStatus(200);
    }

    public function test_comment_delete(): void
    {
        $malProcedimiento = $this->delete('/api/comment/delete', ["idComentario" => 2]);
        $malProcedimiento->assertStatus(200)->assertContent('{"status":"error","result":{"error_id":"400","error_msg":"Datos incompletos o con formato incorrecto"}}');

        $buenProcedimiento = $this->delete('/api/comment/delete', ["id" => 2]);
        $buenProcedimiento->assertStatus(200);
    }
}
