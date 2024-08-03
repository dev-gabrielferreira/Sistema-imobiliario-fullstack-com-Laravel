@extends('layouts.app')
@section('titulo', 'Loja | Imóveis a venda')
@section('titulo_pagina', "Busque por seu imóvel dos sonhos")

@section('conteudo')
    <div class="max-w-6xl mx-auto py-3 sticky top-0 bg-white px-3 shadow-md z-10 max-[900px]:w-screen">
        <div class="relative">
            <button id="filtro" class="hidden text-white py-2 px-4 bg-gray-900 shadow-sm rounded-md max-[900px]:inline-block"><i class="bi bi-funnel"></i> Filtro</button>
            <form action="{{route('index')}}" method="get" class="flex flex-wrap gap-3 max-[900px]:h-[70vh] max-[900px]:w-[500px] max-[600px]:w-[330px] max-[900px]:shadow-lg max-[900px]:fixed max-[900px]:top-[138px] max-[900px]:overflow-scroll max-[900px]:left-1/2 max-[900px]:-translate-x-1/2 max-[900px]:p-3 max-[900px]:rounded-2xl bg-white transition-all duration-500 max-[900px]:invisible max-[900px]:opacity-0" id="form">
                <div>
                    <label for="max">Valor máximo</label><br class="hidden max-[900px]:block">
                    <input type="number" name="max" id="" placeholder="Digite um valor" value="{{request('max')}}" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[900px]:w-full">
                </div>
                <div>
                    <label for="max">Valor mínimo</label><br class="hidden max-[900px]:block">
                    <input type="number" name="min" id="" placeholder="Digite um valor" value="{{request('min')}}" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[900px]:w-full">
                </div>
                <div>
                    <label for="quartos">Número de quartos</label><br class="hidden max-[900px]:block">
                    <input type="number" name="quartos" id="" placeholder="Digite um valor" value="{{request('quartos')}}" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[900px]:w-full">
                </div>
                <div>
                    <label for="max">Tipo</label>
                    <div class="relative h-10 w-72 min-w-[200px] mt-3">
                        <select
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            name="tipo">
                            <option value="" {{(request('tipo') === '') ? 'selected' : ''}}></option>
                            @foreach ($tipos as $tipo)
                                <option value="{{$tipo->nome}}" {{(request('tipo') === $tipo->nome) ? 'selected' : ''}}>{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Selecione um tipo
                        </label>
                    </div>
                </div>
                <div>
                    <label for="bairro">Bairro</label>
                    <div class="relative h-10 w-72 min-w-[200px] mt-3">
                        <select
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            name="bairro">
                            <option value="" {{(request('bairro') === '') ? 'selected' : ''}}></option>
                            @foreach ($bairros as $bairro)
                                <option value="{{$bairro->nome}}" {{(request('bairro') === $bairro->nome) ? 'selected' : ''}}>{{$bairro->nome}}</option>
                            @endforeach
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Selecione um bairro
                        </label>
                    </div>
                </div>
                <div>
                    <label for="ordem">Ordenação</label>
                    <div class="relative h-10 w-72 min-w-[200px] mt-3">
                        <select
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            name="ordem">
                            <option value="" {{(request('ordem') === '') ? 'selected' : ''}}></option>
                            <option value="mais baratos" {{(request('ordem') === 'mais baratos') ? 'selected' : ''}}>Mais baratos</option>
                            <option value="mais caros" {{(request('ordem') === 'mais caros') ? 'selected' : ''}}>Mais caros</option>
                            <option value="mais recentes" {{(request('ordem') === 'mais recentes') ? 'selected' : ''}}>Mais recentes</option>
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Selecione uma ordem
                        </label>
                    </div>
                </div>
                <div>
                    <button
                    class="mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="submit"
                    >
                    Filtrar
                    </button>
                    <a href="{{route('index')}}"
                    class="inline-block mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="submit"
                    >
                    Limpar filtro
                    </a>
                </div>
            </form>
        </div>
    </div>
    @if ($imoveis->isEmpty())
        <h1>Nenhum imóvel encontrado</h1>
    @else
    <div class="grid gap-3 grid-cols-4 max-w-6xl mx-auto px-4 py-3 imoveis-container max-[1114px]:grid-cols-3 max-[820px]:grid-cols-2 max-[590px]:grid-cols-1 max-[590px]:w-full place-items-center" id="imoveis">
            @include("partials.imovel", ['imoveis' => $imoveis])
    </div>
    
    @if ($imoveis->nextPageUrl())
        <div class="flex justify-center py-2">
            <button id="load-more" data-next-page="{{ $imoveis->nextPageUrl() }}" class="w-[250px] py-2 px-6 rounded-3xl bg-gray-300 bg-opacity-50 font-bold hover:bg-[#97D776] hover:bg-opacity-70 transitio all">Carregar Mais</button>
        </div>
    @endif
    @endif
@endsection

@section('styles')
    @media (max-width: 900px) {
        #form {
            right: 50%;
            transform: translateX(-50%);
        }
    }
@endsection

@section('scripts')
    <script src="{{asset('js/loadMore.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const filterButton = document.querySelector("#filtro")
            const form = document.querySelector("#form")

            filterButton.addEventListener("click", () => {
                form.classList.toggle("max-[900px]:invisible")
                form.classList.toggle("max-[900px]:opacity-0")
                form.classList.toggle("max-[900px]:opacity-100")
                form.classList.toggle("max-[900px]:visible")
            })
        })
    </script>
@endsection