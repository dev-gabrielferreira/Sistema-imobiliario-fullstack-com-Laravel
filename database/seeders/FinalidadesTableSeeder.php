<?php

namespace Database\Seeders;

use App\Models\Finalidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinalidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Finalidade::insert([
            ['nome' => 'Finalidade 1'],
            ['nome' => 'Finalidade 2'],
            ['nome' => 'Finalidade 3'],
            ['nome' => 'Finalidade 4'],
            ['nome' => 'Finalidade 5']
        ]);
    }
}
