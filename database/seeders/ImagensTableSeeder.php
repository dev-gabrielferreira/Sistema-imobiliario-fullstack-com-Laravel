<?php

namespace Database\Seeders;

use App\Models\Imagem;
use App\Models\Imovel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImagensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imoveis = Imovel::all();

        foreach ($imoveis as $imovel) {
            $imageCount = rand(5, 15);

            for ($i = 0; $i < $imageCount; $i++) {
                $imageName = "image{$i}.jpg";
                $imagePath = "imoveis/{$imovel->id}/{$imageName}";

                Storage::disk('public')->makeDirectory("imoveis/{$imovel->id}");

                Storage::disk('public')->put("imoveis/{$imovel->id}/{$imageName}", file_get_contents('public/images/example.webp'));

                Imagem::create([
                    'imovel_id' => $imovel->id,
                    'url' => Storage::url($imagePath)
                ]);
            }
    } 
}}