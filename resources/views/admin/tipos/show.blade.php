@extends('layouts.admin')

@section('conteudo')
    @if (session('sucesso'))
        @include("partials.sucesso", ["mensagem" => session('sucesso')])
    @endif
    <form action="{{route('tipos.update', $tipo->id)}}" method="post">
        @csrf
        <h1 class="gray-900 text-2xl font-bold">Editando tipo: {{$tipo->nome}}</h1>
        <div class="w-[400px] mt-6 max-[700px]:w-[90%]">
            <label for="nome" class="font-bold">Nome do tipo</label>
            <br>
            <input type="text" name="nome" id="" placeholder="Digite algo" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776] " value="{{$tipo->nome}}">
        
            @error('nome')
                @include("partials.inputErro", ["mensagem" => $message])
            @enderror
        </div>
        <br>
        <div>
            <button
            class="mt-1 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
            type="submit"
            >
            Editar
            </button>
        </div>
    </form>
    <form action="{{route("tipos.destroy", $tipo->id)}}" method="post" class="mt-1">
        @csrf
        @method("delete")
        <button
            class="mt-1 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-red-600 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
            type="submit"
            >
            Excluir
            </button>
    </form>
@endsection