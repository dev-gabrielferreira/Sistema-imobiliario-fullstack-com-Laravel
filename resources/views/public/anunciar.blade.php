@extends('layouts.app')
@section('titulo', 'Anuncie já o seu imóvel')
@section('titulo_pagina', 'Anuncie já o seu imóvel')

@section('conteudo')
    
    <div class="max-w-6xl mx-auto py-5 max-[700px]:px-4">
        @if (session('sucesso'))
            @include("partials.sucesso", ["mensagem" => session('sucesso')])
        @endif
        @if (session('erro'))
            @include("partials.erro", ["mensagem" => session('erro')])
        @endif
        <h1 class="font-bold text-3xl">Anunciar imóvel</h1>
        <p class="font-light mt-2 mb-2">Preencha o formulário com os dados do seu imóvel e brevemente será retornado com uma resposta</p>
        <form action="{{route('anunciar.send')}}" method="post">
            @csrf
            <div>
                <label for="nome" class="my-2 font-bold">Nome</label><br>
                <input type="text" name="nome" id="" placeholder="Digite seu nome" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[rgb(151,215,118)] max-[700px]:w-[80%]" value="{{old('email')}}">
                @error('nome')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            <div>
                <label for="email" class="my-2 font-bold">Email</label><br>
                <input type="email" name="email" id="" placeholder="Digite seu email" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[rgb(151,215,118)] max-[700px]:w-[80%]" value="{{old('email')}}">
                @error('email')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            <div>
                <label for="telefone" class="my-2 font-bold">Telefone</label><br>
                <input type="tel" name="telefone" id="" placeholder="(XX) XXXXX-XXXX" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[rgb(151,215,118)] max-[700px]:w-[80%]" value="{{old('email')}}">
                @error('telefone')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            <div>
                <label for="tipo" class="my-2 font-bold">Tipo do apartamento</label>
                <div class="relative h-10 w-72 min-w-[200px] mt-3">
                    <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="tipo">
                        <option value=""></option>
                        @foreach ($tipos as $tipo)
                            <option value="{{$tipo->nome}}" {{(old('tipo') === $tipo->nome) ? "selected" : ""}}>{{$tipo->nome}}</option>
                        @endforeach
                    </select>
                    <label
                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Selecione um tipo
                    </label>
                </div>
                @error('tipo')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            
            <div>
                <label for="endereco" class="my-2 font-bold">Endereço(rua e número)</label><br>
                <input type="text" name="endereco" id="" placeholder="Digite o seu endereço" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[80%]" value="{{old('endereco')}}">
                @error('endereco')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            <div>
                <label for="tipo" class="my-2 font-bold">Bairro</label>
                <div class="relative h-10 w-72 min-w-[200px] mt-3">
                    <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="bairro">
                        <option value=""></option>
                        @foreach ($bairros as $bairro)
                            <option value="{{$bairro->nome}}" {{(old('bairro') === $bairro->nome) ? "selected" : ""}}>{{$bairro->nome}}</option>
                        @endforeach
                    </select>
                    <label
                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Selecione um bairro
                    </label>
                </div>
                @error('bairro')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            <div>
                <label for="tipo" class="my-2 font-bold">Finalidade</label>
                <div class="relative h-10 w-72 min-w-[200px] mt-3">
                    <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="finalidade">
                        <option value=""></option>
                        @foreach ($finalidades as $finalidade)
                            <option value="{{$finalidade->nome}}" {{(old('finalidade') === $finalidade->nome) ? "selected" : ""}}>{{$finalidade->nome}}</option>
                        @endforeach
                    </select>
                    <label
                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Selecione uma finalidade
                    </label>
                </div>
                @error('finalidade')
                    @include("partials.inputErro", ["mensagem" => $message])
                @enderror
            </div>
            <div>
                <button
                class="mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                type="submit"
                >
                Enviar
                </button>
            </div>
        </form>
    </div>
@endsection