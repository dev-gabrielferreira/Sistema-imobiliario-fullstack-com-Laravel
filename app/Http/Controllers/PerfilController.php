<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMailable;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PerfilController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view("admin.perfil.index", compact("user"));
    }

    public function update(Request $request){
        $user_id = Auth::user()->id;
        $request->validate([
            "nome" => "required|unique:admins,nome,$user_id",
            "email" => "required|unique:admins,email,$user_id"
        ]);

        $user_data = Admin::find($user_id);
        $user_data->nome = $request->nome;
        $user_data->email = $request->email;

        if(!$user_data->update()){
            return back()->withErrors("erro", "Falha ao atualizar perfil");
        }

        return redirect()->route("perfil.index")->with("sucesso", "Atualizado com sucesso");
    }

    public function updatePassword(Request $request){
        $request->validate([
            "senha" => "required|string|min:8",
            "senha_atual" => "required|string|min:8"
        ]);

        $user = Auth::user();
        if(!Hash::check($request->senha_atual, $user->password)){
            return back()->with("erro", "Senha incompatível com a atual");
        }


        $user = Admin::find($user->id);
        $user->password = Hash::make($request->senha);

        if(!$user->update()){
            return back()->with("erro", "Falha ao atualizar senha");
        } 

        return redirect()->route("perfil.index")->with("sucesso", "Senha atualizada");
    }

    public function destroy(){
        $user_id = Auth::user()->id;
        $user = Admin::find($user_id);
        
        if(!$user){
            return back()->with("erro", "Falha ao apagar conta");
        }

        return redirect()->route("login");
    }

    public function showResetPasswordForm(){
        return view("auth.reset");
    }


    public function resetPassword(Request $request){
        $request->validate([
            "email" => "required"
        ]);

        $user = Admin::where('email', $request->email)->first();

        if(!$user){
            return back()->with("erro", "email não registrado");
        }

        $digitos = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM@$%&";
        $novaSenha = "";

        for($i = 0; $i < 12;$i++){
            $caracter = $digitos[rand(0, strlen($digitos) - 1)];
            $novaSenha = $novaSenha . $caracter;
        }

        $user->password = Hash::make($novaSenha);

        if(!$user->update()){
            return back()->with("erro", "Falha ao recuperar senha");
        }

        if(!Mail::to(env('MAIL_FROM_ADDRESS'))
        ->send(new ResetPasswordMailable(["senha" => $novaSenha]))){
            return back()->with("erro", "Falha ao recuperar senha");
        }

        return redirect()->route('login')->with('sucesso', 'Email enviado com sua nova senha');

    }
}
