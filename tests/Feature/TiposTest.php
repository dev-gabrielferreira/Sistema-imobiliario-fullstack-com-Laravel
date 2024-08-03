<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Tipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TiposTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_tipos(): void
    {
        Artisan::call('migrate');

        $admin = Admin::create([
            "nome" => "admin",
            "email" => "admin@email.com",
            "password" => bcrypt("123456")
        ]);

        $this->actingAs($admin);
        
        $data = [
            'nome' => "Flat"
        ];

        $response = $this->post(route('tipos.store'), $data);
        $tipo = Tipo::where($data)->first();
        $this->assertDatabaseCount('tipos', 1);
        $this->assertDatabaseHas('tipos', $data);

        $response->assertStatus(302)->assertRedirect(route('tipos.index'));

        $response = $this->get(route('tipos.show', $tipo->id));

        // VERIFICA DUPLICIDADE
        $response = $this->post(route('tipos.store'), $data);
        $response->assertStatus(422);
        $response->assertSessionHasErrors(['nome']);
        $this->assertDatabaseCount('tipos', 1);

        $data['nome'] = "Apartamento";
        
        // ATUALIZA REGISTRO
        $response = $this->post(route('tipos.update', $tipo->id), $data);
        $response->assertStatus(302);
        $tipo = Tipo::where($data)->first();
        $this->assertEquals($data['nome'], $tipo->nome);

        $data['nome'] = "";

        $response = $this->post(route('tipos.update', $tipo->id), $data);
        $response->assertStatus(422);
        $tipo = Tipo::find(1);
        $this->assertEquals("Apartamento", $tipo->nome);

        // DELETA REGISTRO
        $response = $this->delete(route('tipos.destroy', $tipo->id));
        $response->assertRedirect(route('tipos.index'));
        $response->assertSessionHas('sucesso', 'Apagado com sucesso');

        $response = $this->delete(route('tipos.destroy', 4));
        $response->assertRedirect(route('tipos.index'));
        $response->assertSessionHas('erro', 'Falha ao apagar');
    }
}
