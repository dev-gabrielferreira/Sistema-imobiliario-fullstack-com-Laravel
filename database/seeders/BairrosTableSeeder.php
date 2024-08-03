<?php

namespace Database\Seeders;

use App\Models\Bairro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BairrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bairro::insert([
            ['nome' => 'Bairro 1'],
            ['nome' => 'Bairro 2'],
            ['nome' => 'Bairro 3'],
            ['nome' => 'Bairro 4'],
            ['nome' => 'Bairro 5'],
            ['nome' => 'Bairro 6'],
            ['nome' => 'Bairro 7'],
            ['nome' => 'Bairro 8'],
            ['nome' => 'Bairro 9'],
            ['nome' => 'Bairro 10'],
            ['nome' => 'Bairro 11'],
            ['nome' => 'Bairro 12'],
        ]);
    }
}
