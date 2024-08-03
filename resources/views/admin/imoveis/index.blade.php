@extends('layouts.admin')

@section('conteudo')
@if (session('sucesso'))
    @include("partials.sucesso", ["mensagem" => session('sucesso')]) 
@endif

@if (session('erro'))
    @include("partials.erro", ["mensagem" => session('erro')])
@endif
<form action="{{route('imoveis.index')}}" method="GET" class="my-3 flex items-center gap-2">
    <input type="text" name="imovel_id" id="" placeholder="Digite o código do imovel" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[85%]" value="{{old("imovel_id")}}">
    <button type="submit"
    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
    >
    Buscar
    </button>
</form>
<a href="{{route("imoveis.create")}}"
class="mt-1 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
>
Criar imóvel
</a>

<div class="mt-2">
    <h1 class="mt-4 text-2xl font-bold">Total de imóveis: {{$total}}</h1>
    <div class="flex flex-wrap gap-3 max-[500px]:justify-center" id="imoveis">
            @include('partials.imovelAdmin', ['imoveis' => $imoveis]) 
            </div>
            @if ($imoveis->nextPageUrl())
                <div class="flex justify-center py-2 max-[700px]:mt-4">
                    <button id="load-more" data-next-page="{{ $imoveis->nextPageUrl() }}" class="w-[250px] py-2 px-6 rounded-3xl bg-gray-300 font-bold hover:bg-[#97D776] hover:bg-opacity-70 transitio all">Carregar Mais</button>
                </div>
            @endif
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/loadMore.js')}}"></script>
@endsection
