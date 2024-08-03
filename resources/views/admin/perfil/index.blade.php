@extends('layouts.admin')

@section('conteudo')
    @if (session('sucesso'))
        @include("partials.sucesso", ["mensagem" => session('sucesso')])
    @endif
    @if (session('erro'))
        @include("partials.erro", ["mensagem" => session('erro')])
    @endif
    <h1 class="font-bold text-3xl my-3">Configurações da conta</h1>
    <form action="{{route("perfil.update")}}" method="post">
        @csrf
        <div class="w-[400px] mt-6 max-[700px]:w-[90%]">
            <div>
                <label for="nome" class="font-bold">Nome</label>
                <br>
                <input type="text" name="nome" id="" placeholder="Digite seu email" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]" value="{{old("nome", $user->nome)}}">
                @error('nome')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            <div>
                <label for="nome" class="font-bold">Email</label>
                <br>
                <input type="text" name="email" id="" placeholder="Digite seu email" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]" value="{{old("email", $user->email)}}">
                @error('email')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
        
        </div>
        <div>
            <button
            class="mt-1 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
            type="submit"
            >
            Editar
            </button>
        </div>
    </form>
    <form action="{{route("perfil.password")}}" method="post" class="mt-1">
        @csrf
        <div class="w-[400px] mt-6 max-[700px]:w-[90%]">
            <label for="nome" class="font-bold">Nova senha</label>
            <br>
            <input type="password" name="senha" id="" placeholder="Digite sua nova senha" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]" value="{{old("senha")}}">
            @error('senha')
                @include("partials.inputErro", ["mensagem" => $message])
            @enderror
        </div>
        <div class="w-[400px] mt-6 max-[700px]:w-[90%]">
            <label for="nome" class="font-bold">Confirme com sua senha atual*</label>
            <br>
            <input type="password" name="senha_atual" id="" placeholder="Digite sua senha" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]" value="{{old("senha_atual")}}">
            @error('senha_atual')
                @include("partials.inputErro", ["mensagem" => $message])
            @enderror
        </div>
        <button
            class="mt-1 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
            type="submit"
            >
            Mudar senha
            </button>
    </form>
    <form action="" method="post" class="mt-1">
        @csrf
        @method("delete")
        <button
            class="mt-1 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-red-600 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
            type="submit"
            >
            Deletar conta
            </button>
    </form>
@endsection