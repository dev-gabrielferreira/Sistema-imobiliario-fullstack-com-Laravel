<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Imovel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $bairros = Bairro::all();
        $imoveisRecentes = Imovel::orderBy('created_at', 'desc')->limit(7)->get();
        foreach ($imoveisRecentes as $imovel) {
            $imovel->imagens = $imovel->imagens()->take(4)->get();
        }
        return view("public.home", compact(["imoveisRecentes", "bairros"]));
    }

    public function buscar($bairro){
        $imoveis = Imovel::with(['imagens' => function ($query){
            $query->limit(1);
        }])->whereHas('bairro', function ($query) use ($bairro) {
            $query->where('bairros.nome', 'ilike', "%$bairro%");
        })->get();

        return response()->json(['data' => $imoveis]);
    }
}
