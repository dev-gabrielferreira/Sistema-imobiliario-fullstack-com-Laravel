<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BairroController extends Controller
{
    public function index(){
        $bairros = Bairro::all();
        return view('admin.bairros.index', compact('bairros'));
    }

    public function create(){
        return view('admin.bairros.create');
    }

    public function store(Request $request){

        try {

            $request->validate([
                "nome" => "required|unique:bairros"
            ]);
    
            if(Bairro::create(["nome" => $request->nome])){
                return redirect()->route('bairros.index')->with('sucesso', 'Bairro criado com sucesso');
            }
            
            return back()->withErrors("erro", "Falha ao criar bairro");

        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput()->setStatusCode(422);
        }
       
    }

    public function show($id){
        $bairro = Bairro::find($id);

        if($bairro){
            return view("admin.bairros.show", compact("bairro"));
        }

        return view("admin.bairros.index");
    }

    public function update(Request $request, $id){
        try {

            $bairro = Bairro::find($id);
            
            $request->validate([
                "nome" => "required|unique:bairros,nome,$id"
            ]);
    
            $bairro->nome = $request->nome;
    
            $bairro->update();

            return redirect(route('bairros.show', $bairro->id))->with('sucesso', 'Editado com sucesso');
            
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput()->setStatusCode(422);
        }

    }

    public function destroy($id){
        $bairro = Bairro::find($id);

        if(!$bairro){
            return redirect()->route('bairros.index')->with('erro', 'Falha ao apagar');
        }

        $bairro->delete();

        return redirect()->route('bairros.index')->with('sucesso', 'Apagado com sucesso');
    }
}
