<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $fimSemana = Carbon::now()->endOfWeek();
        $inicioSemana = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $imoveis = Imovel::whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        
        $casas = Imovel::whereHas("tipo", function($query){
            $query->where("nome", "Casa");
        })->count();

        $apartamentos = Imovel::whereHas("tipo", function($query){
            $query->where("nome", "Apartamento");
        })->count();

        $imoveisPorBairro = Imovel::select('bairros.nome', DB::raw('count(*) as total'))
            ->join('bairros', 'imoveis.bairro_id', '=', 'bairros.id')
            ->groupBy('bairros.nome')
            ->get();

        $coords = Imovel::select('latitude','longitude')->get();

        $contagemTipos = Imovel::select("tipo_id", DB::raw("count(*) as total"))->groupBy("tipo_id")->with("tipo")->get();

        $usuario = Auth::user();

        return view('admin.dashboard', compact(["imoveis", "casas", "apartamentos", "contagemTipos", "usuario", "imoveisPorBairro", "coords"]));

    }

}
