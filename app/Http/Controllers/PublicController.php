<?php

namespace App\Http\Controllers;

use App\Mail\AnunciarMailable;
use App\Models\Bairro;
use App\Models\Finalidade;
use App\Models\Imovel;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function show($titulo, $id){
        $imovel = Imovel::with(['bairro','tipo','imagens','finalidade'])->find($id);
        $similares = Imovel::with(['bairro', 'tipo', 'imagens'])
        ->whereHas('bairro', function ($query) use ($imovel) {
            $query->where('nome', $imovel->bairro->nome);
        })
        ->where('id', '!=', $id)
        ->get();

        $similares->each(function ($im) {
            $im->imagens = $im->imagens->take(4);
        });

        // return $similares;

        return view("public.show", compact(['imovel', 'similares']));
    }

    public function index(Request $request){
        $tipos = Tipo::all();
        $bairros = Bairro::all();
        $imoveis = Imovel::with(['tipo', 'bairro']);
        $filters = $request->only(['max', 'min', 'quartos', 'tipo', 'ordem', 'bairro']);

        if($request->filled('max')) $imoveis->where('valor', '<=', $request->max);
        if($request->filled('min')) $imoveis->where('valor', '>=', $request->min);
        if($request->filled('quartos')) $imoveis->where('quartos', $request->quartos);

        if($request->filled('tipo')){
            $tipo = $request->tipo;
            $imoveis->whereHas('tipo', function ($query) use ($tipo) { 
                $query->where('nome', $tipo);
            });
        };
        if($request->filled('bairro')){
            $bairro = $request->bairro;
            $imoveis->whereHas('bairro', function ($query) use ($bairro) { 
                $query->where('nome', $bairro);
            });
        };

        if($request->filled('ordem')){
            if($request->ordem === 'mais baratos'){
                $imoveis->orderBy('valor', 'asc');
            }

            if($request->ordem === 'mais caros'){
                $imoveis->orderBy('valor', 'desc');
            }

            if($request->ordem === 'mais recentes'){
                $imoveis->orderBy('created_at', 'desc');
            }
        }
        
        $imoveis = $imoveis->paginate(8)->appends($filters);
        foreach ($imoveis as $imovel) {
            $imovel->imagens = $imovel->imagens()->take(4)->get();
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.imovel', compact('imoveis'))->render(),
                'next_page' => $imoveis->nextPageUrl()
            ]);
        }

        return view('public.index', compact(['imoveis', 'tipos', 'bairros']));
    }

    public function showMailForm(){
        $tipos = Tipo::all();
        $bairros = Bairro::all();
        $finalidades = Finalidade::all();
        return view('public.anunciar', compact(['tipos', 'bairros', 'finalidades']));
    }

    public function sendMail(Request $request){
        $request->validate([
            "nome" => "required",
            "endereco" => "required",
            "bairro" => "required",
            "email" => "required",
            "tipo" => "required",
            "telefone" => "required",
            "finalidade" => "required"
        ]);
        
        if(Mail::to(env('MAIL_FROM_ADDRESS'))
        ->send(new AnunciarMailable($request->all()))){
            return redirect()->route('anunciar.show')->with('sucesso', 'Email enviado');
        }

        return redirect()->back()->with('erro', 'Falha ao enviar email');

    }

    public function about(){
        return view("public.sobre");
    }
}
