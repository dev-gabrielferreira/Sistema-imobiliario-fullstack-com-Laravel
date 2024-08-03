@extends('layouts.admin')

@section('conteudo')
<a href="{{route("tipos.create")}}"
class="mt-1 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
>
Criar tipo
</a>

@if (session('sucesso'))
    @include("partials.sucesso", ["mensagem" => session('sucesso')]) 
@endif

@if (session('erro'))
    @include("partials.erro", ["mensagem" => session('erro')])
@endif
<div class="mt-2">
    <h1 class="mt-4 text-2xl font-bold">Total de tipos: {{count($tipos)}}</h1>
    @foreach ($tipos as $tipo)
        <a href="{{route("tipos.show", $tipo->id)}}">
            <div class="w-6/12 bg-gray-300 px-2 py-1 rounded-md mt-2 hover:bg-[#97D776] transition duration-500 max-[700px]:w-[90%]">
                {{$tipo->nome}}
            </div>
        </a>
    @endforeach
</div>
@endsection