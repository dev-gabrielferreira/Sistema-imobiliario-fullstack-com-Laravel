<?php

namespace App\Http\Controllers;

use App\Models\Finalidade;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FinalidadeController extends Controller
{
    public function index(){
        $finalidades = Finalidade::all();
        return view("admin.finalidades.index", compact('finalidades'));
    }

    public function create(){
        return view("admin.finalidades.create");
    }

    public function store(Request $request){

        try {

            $request->validate([
                "nome" => "required|unique:finalidades"
            ]);
    
            if(Finalidade::create(["nome" => $request->nome])){
                return redirect()->route('finalidades.index')->with("sucesso", "Finalidade criada com sucesso");
            }

            return back()->withErrors("erro", "Falha ao criar finalidade");


        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput()->setStatusCode(422);
        }
       
    }

    public function show($id){
        $finalidade = Finalidade::find($id);

        if($finalidade){
            return view("admin.finalidades.show", compact("finalidade"));
        }
        return view("admin.finalidades.index");
    }

    public function update(Request $request, $id){
        try {

            $finalidade = Finalidade::find($id);
            
            $request->validate([
                "nome" => "required|unique:finalidades,nome,$id"
            ]);
    
            $finalidade->nome = $request->nome;
    
            $finalidade->update();

            return redirect(route('finalidades.show', $finalidade->id))->with('sucesso', 'Editado com sucesso');
            
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput()->setStatusCode(422);
        }

    }

    public function destroy($id){
        $finalidade = Finalidade::find($id);

        if(!$finalidade){
            return redirect()->route('finalidades.index')->with('erro', 'Falha ao apagar');
        }

        $finalidade->delete();

        return redirect()->route('finalidades.index')->with('sucesso', 'Apagado com sucesso');
    }
}
