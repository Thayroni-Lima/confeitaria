<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_usuario_autenticado_pode_ver_lista_de_produtos(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/produtos');

        $response->assertStatus(200);
        $response->assertSee('Lista de Produtos');
    }

}
