<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Bairro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class BairrosTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_bairros(): void
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

        $response = $this->post(route('bairros.store'), $data);
        $bairro = Bairro::where($data)->first();
        $this->assertDatabaseCount('bairros', 1);
        $this->assertDatabaseHas('bairros', $data);

        $response->assertStatus(302)->assertRedirect(route('bairros.index'));

        $response = $this->get(route('bairros.show', $bairro->id));

        // VERIFICA DUPLICIDADE
        $response = $this->post(route('bairros.store'), $data);
        $response->assertStatus(422);
        $response->assertSessionHasErrors("nome");
        $this->assertDatabaseCount('bairros', 1);

        $data['nome'] = "Apartamento";
        
        // ATUALIZA REGISTRO
        $response = $this->post(route('bairros.update', $bairro->id), $data);
        $response->assertStatus(302);
        $bairro = Bairro::where($data)->first();
        $this->assertEquals($data['nome'], $bairro->nome);

        $data['nome'] = "";

        $response = $this->post(route('bairros.update', $bairro->id), $data);
        $response->assertStatus(422);
        $bairro = Bairro::find(1);
        $this->assertEquals("Apartamento", $bairro->nome);

        // DELETA REGISTRO
        $response = $this->delete(route('bairros.destroy', $bairro->id));
        $response->assertRedirect(route('bairros.index'));
        $response->assertSessionHas('sucesso', 'Apagado com sucesso');

        $response = $this->delete(route('bairros.destroy', 4));
        $response->assertRedirect(route('bairros.index'));
        $response->assertSessionHas('erro', 'Falha ao apagar');
    }
}
