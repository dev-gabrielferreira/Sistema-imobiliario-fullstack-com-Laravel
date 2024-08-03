<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo::insert([
            ['nome' => 'Tipo 1'],
            ['nome' => 'Tipo 2'],
            ['nome' => 'Tipo 3'],
            ['nome' => 'Tipo 4'],
            ['nome' => 'Tipo 5'],
        ]);
    }
}
