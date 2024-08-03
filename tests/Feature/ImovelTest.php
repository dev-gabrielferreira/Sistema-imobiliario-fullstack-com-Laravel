<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Bairro;
use App\Models\Finalidade;
use App\Models\Imagem;
use App\Models\Imovel;
use App\Models\Tipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImovelTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_imovel(): void
    {
        Artisan::call('migrate');

        $admin = Admin::create([
            "nome" => "admin",
            "email" => "admin@email.com",
            "password" => bcrypt("123456")
        ]);

        $this->actingAs($admin);

        $bairro = Bairro::create(["nome" => 'jacarepagua']);
        $tipo = Tipo::create(["nome" => 'apartamento']);
        $finalidade = Finalidade::create(["nome" => 'venda']);

        Storage::fake('public');
        $imagens = [
            UploadedFile::fake()->image('imovel1.jpg'),
            UploadedFile::fake()->image('imovel2.jpg')
        ];

        $data = [
            "titulo" => "um titulo",
            "endereco" => "Rua 1",
            "valor" => 160000,
            "descricao" => "Uma descrição qualquer",
            "area" => 50,
            "quartos" => 2,
            "tipo_id" => $tipo->id,
            "bairro_id" => $bairro->id,
            "latitude" => 9.20402,
            "longitude" => 1.12023,
            "iptu" => 200.50,
            "condominio" => 210,
            "mobilia" => 1,
            "finalidade_id" => $finalidade->id,
            "vagas" => 1,
            "imagens" => $imagens
        ];

        $response = $this->post(route('imoveis.store'), $data);
        $response->assertStatus(302);
        $imovel = Imovel::where('endereco', $data['endereco'])->first();
        $response->assertRedirect(route("imoveis.index"));
        $this->assertDatabaseCount("imoveis", 1);
        $dadosImovel = $data;
        unset($dadosImovel['imagens']);
        $this->assertDatabaseHas("imoveis", $dadosImovel);

        foreach ($data['imagens'] as $imagem) {
            $path = 'imoveis/'.$imovel->id.'/'.$imagem->hashName();
            $url = Storage::url($path);
    
            $this->assertDatabaseHas('imagens', [
                'imovel_id' => $imovel->id,
                'url' => $url
            ]);
        }

        // ATUALIZAR REGISTRO

        $data['endereco'] = "rua 2";
        $imagens = [
            UploadedFile::fake()->image('imovel3.jpg'),
            UploadedFile::fake()->image('imovel4.jpg')
        ];
        $deletar = [1,2];
        $data['deletar'] = $deletar;
        $data["imagens"] = $imagens;

        $response = $this->put(route("imoveis.update", $imovel->id), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route("imoveis.show", $imovel->id));
        $this->assertDatabaseHas("imoveis", ["endereco" => "rua 2"]);

        // DELETAR REGISTROS
        $response = $this->delete("admin/imoveis/4/apagar");
        $response->assertRedirect(route("imoveis.index"));
        $response->assertSessionHas('erro', 'Erro ao apagar imóvel');
        $this->assertDatabaseCount("imoveis", 1);


        $response = $this->delete("admin/imoveis/$imovel->id/apagar");
        $response->assertRedirect(route('imoveis.index'));
        $response->assertSessionHas('sucesso', 'Imóvel apagado');
        $this->assertDatabaseCount("imoveis", 0);

    }
}
