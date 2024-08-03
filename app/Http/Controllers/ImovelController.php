<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Finalidade;
use App\Models\Imagem;
use App\Models\Imovel;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImovelController extends Controller
{
    public function index(Request $request){
        if($request->filled("imovel_id")){
            $imovel = Imovel::with(['tipo', 'bairro', 'finalidade'])->find($request->imovel_id);

            if(!$imovel){
                return back()->with("erro", "Imóvel não encontrado");
            }

            return redirect()->route("imoveis.show", $imovel->id);
        }

        $total = Imovel::count();

        $imoveis = Imovel::with(['tipo', 'bairro', 'finalidade'])->paginate(8);

        foreach ($imoveis as $imovel) {
            $imovel->imagens = $imovel->imagens()->limit(4)->get();
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.imovel', compact('imoveis'))->render(),
                'next_page' => $imoveis->nextPageUrl()
            ]);
        }

        return view("admin.imoveis.index", compact(['imoveis', 'total']));
    }

    public function create(){
        $tipos = Tipo::all();
        $finalidades = Finalidade::all();
        $bairros = Bairro::all();
        return view("admin.imoveis.create", compact(["tipos", "finalidades", "bairros"]));
    }

    public function show($id){
        $imovel = Imovel::find($id);
        $tipos = Tipo::all();
        $finalidades = Finalidade::all();
        $bairros = Bairro::all();

        if($imovel){
            return view("admin.imoveis.show", compact(["imovel", "tipos", "finalidades", "bairros"]));
        }

        return redirect()->route("imoveis.index");
    }

    public function store(Request $request){

        $request->validate([
            "endereco" => "required|string|max:255",
            "titulo" => "required|string",
            "valor" => "required|integer",
            "descricao" => "required|string",
            "area" => "required|integer",
            "quartos" => "required|integer",
            "tipo_id" => "required|exists:tipos,id",
            "bairro_id" => "required|exists:bairros,id",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "iptu" => "required|numeric",
            "condominio" => "required|integer",
            "mobilia" => "required|boolean",
            "finalidade_id" => "required|exists:finalidades,id",
            "vagas" => "required|integer",
            "imagens.*" => "image|mimes:jpeg,png,jpg,webp|max:2048",
        ]);

        $imovel = Imovel::create($request->except("imagens"));

        if($imovel->id){
            if($request->file("imagens")){
                foreach ($request->file("imagens") as $img) {
                    $path = $img->store("public/imoveis/$imovel->id");
                    Imagem::create([
                        "imovel_id" => $imovel->id,
                        "url" => Storage::url($path)
                    ]);
                }
            }
            return redirect()->route('imoveis.index');
        }

        return back(422)->withErrors("erro", "Falha ao cadastrar imóvel");

    }

    public function destroy($id){
        $imovel = Imovel::find($id);

        if(!$imovel){
            return redirect()->route('imoveis.index')->with("erro", "Erro ao apagar imóvel");
        }
        
        if($imovel->delete()){
            $storageDiretory = storage_path("app/public/imoveis/$imovel->id");
            File::deleteDirectory($storageDiretory);

            return redirect()->route('imoveis.index')->with('sucesso', 'Imóvel apagado');
        }
    }

    public function update(Request $request, $id){
        $imovel = Imovel::find($id);

        $request->validate([
            "endereco" => "required|string|max:255",
            "titulo" => "required|string",
            "valor" => "required|integer",
            "descricao" => "required|string",
            "area" => "required|integer",
            "quartos" => "required|integer",
            "tipo_id" => "required|exists:tipos,id",
            "bairro_id" => "required|exists:bairros,id",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "iptu" => "required|numeric",
            "condominio" => "required|integer",
            "mobilia" => "required|boolean",
            "finalidade_id" => "required|exists:finalidades,id",
            "vagas" => "required|integer",
            "imagens.*" => "image|mimes:jpeg,png,jpg,webp|max:2048"
        ]);

        if(!$imovel){
            return redirect()->route('imoveis.index');
        }
        $data = $request->except(["imagens", "deletar"]);
        $imovel->fill($data);
        $imovel->update();

        if($request->deletar){
            foreach ($request->deletar as $imagemId) {
                $img = Imagem::find($imagemId);

                if($img){
                    $filePath = public_path($img->url);
                    if(file_exists($filePath)){
                        unlink($filePath);
                        $img->delete();
                    }
                }
            }
        }

        if($request->imagens){
            foreach ($request->file("imagens") as $img) {
                $path = $img->store("public/imoveis/$id");
                Imagem::create([
                    "imovel_id" => $id,
                    "url" => Storage::url($path)
                ]);
            }
        }

        return redirect()->route("imoveis.show", $id)->with('sucesso', 'Imóvel editado com sucesso');
    }

}
