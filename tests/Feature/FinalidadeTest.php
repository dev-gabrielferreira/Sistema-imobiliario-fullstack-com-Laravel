<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Finalidade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class FinalidadeTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_crud_finalidade(): void
    {
        Artisan::call('migrate');

        $admin = Admin::create([
            "nome" => "admin",
            "email" => "admin@email.com",
            "password" => bcrypt("123456")
        ]);

        $this->actingAs($admin);
        
        $data = [
            'nome' => "Comercial"
        ];

        $response = $this->post(route('finalidades.store'), $data);
        $finalidade = Finalidade::where($data)->first();
        $this->assertDatabaseCount('finalidades', 1);
        $this->assertDatabaseHas('finalidades', $data);

        $response->assertStatus(302)->assertRedirect(route('finalidades.index'));

        $response = $this->get(route('finalidades.show', $finalidade->id));

        // VERIFICA DUPLICIDADE
        $response = $this->post(route('finalidades.store'), $data);
        $response->assertStatus(422);
        $response->assertSessionHasErrors("nome");
        $this->assertDatabaseCount('finalidades', 1);

        $data['nome'] = "Apartamento";
        
        // ATUALIZA REGISTRO
        $response = $this->post(route('finalidades.update', $finalidade->id), $data);
        $response->assertStatus(302);
        $finalidade = Finalidade::where($data)->first();
        $this->assertEquals($data['nome'], $finalidade->nome);

        $data['nome'] = "";

        $response = $this->post(route('finalidades.update', $finalidade->id), $data);
        $response->assertStatus(422);
        $finalidade = Finalidade::find(1);
        $this->assertEquals("Apartamento", $finalidade->nome);

        // DELETA REGISTRO
        $response = $this->delete(route('finalidades.destroy', $finalidade->id));
        $response->assertRedirect(route('finalidades.index'));
        $response->assertSessionHas('sucesso', 'Apagado com sucesso');

        $response = $this->delete(route('finalidades.destroy', 4));
        $response->assertRedirect(route('finalidades.index'));
        $response->assertSessionHas('erro', 'Falha ao apagar');
    }   
}
