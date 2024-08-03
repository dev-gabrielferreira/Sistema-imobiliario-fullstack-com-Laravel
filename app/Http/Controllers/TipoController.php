<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TipoController extends Controller
{
    public function index(){
        $tipos = Tipo::all();
        return view("admin.tipos.index", compact('tipos'));
    }

    public function create(){
        return view("admin.tipos.create");
    }

    public function store(Request $request){

        try {

            $request->validate([
                "nome" => "required|unique:tipos"
            ]);
    
            if(Tipo::create(["nome" => $request->nome])){
                return redirect()->route('tipos.index')->with("sucesso", "Tipo criado com sucesso");
            }

            return back()->withErrors("erro", "Falha ao criar tipo")->withInput()->setStatusCode(422);

        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput()->setStatusCode(422);
        }
       
    }

    public function show($id){
        $tipo = Tipo::find($id);

        if($tipo){
            return view("admin.tipos.show", compact("tipo"));
        }
        return view("admin.tipos.index");
    }

    public function update(Request $request, $id){
        try {

            $tipo = Tipo::find($id);
            
            $request->validate([
                "nome" => "required|unique:tipos,nome,$id"
            ]);
    
            $tipo->nome = $request->nome;
    
            $tipo->update();

            return redirect(route('tipos.show', $tipo->id))->with('message', 'Editado com sucesso');
            
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput()->setStatusCode(422);
        }

    }

    public function destroy($id){
        $tipo = Tipo::find($id);

        if(!$tipo){
            return redirect()->route('tipos.index')->with('erro', 'Falha ao apagar');
        }

        $tipo->delete();

        return redirect()->route('tipos.index')->with('sucesso', 'Apagado com sucesso');
    }
}
