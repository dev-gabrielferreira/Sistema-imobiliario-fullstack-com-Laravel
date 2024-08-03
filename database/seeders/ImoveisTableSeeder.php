<?php

namespace Database\Seeders;

use App\Models\Bairro;
use App\Models\Finalidade;
use App\Models\Imovel;
use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImoveisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bairros = Bairro::all();
        $tipos = Tipo::all();
        $finalidades = Finalidade::all();

        foreach (range(1, 100) as $index) {
            Imovel::create([
                'titulo' => "Titulo {$index}",
                'endereco' => "Endereço {$index}",
                'valor' => rand(100000, 2000000),
                'descricao' => "Descrição do Imóvel {$index}",
                'area' => rand(50, 300),
                'quartos' => rand(1, 5),
                'tipo_id' => $tipos->random()->id,
                'bairro_id' => $bairros->random()->id,
                'latitude' => rand(-90, 90) . '.' . rand(100000, 999999),
                'longitude' => rand(-180, 180) . '.' . rand(100000, 999999),
                'iptu' => rand(500, 3000),
                'condominio' => rand(100, 1000),
                'mobilia' => rand(0, 1),
                'finalidade_id' => $finalidades->random()->id,
                'vagas' => rand(1, 3)
            ]);
    }
}
}
