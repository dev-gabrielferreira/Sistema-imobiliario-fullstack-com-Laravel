@extends('layouts.admin')

@section('conteudo')

<form action="{{route('imoveis.update', $imovel->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <label for="titulo" class="font-bold">Titulo</label>
    <br>
    <input type="text" name="titulo" id="" placeholder="Digite um titulo" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('titulo', $imovel->titulo)}}">
    <br>
    @error('titulo')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="endereco" class="font-bold">Endereço</label>
    <br>
    <input type="text" name="endereco" id="" placeholder="Digite um endereco" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('endereco', $imovel->endereco)}}">
    <br>
    @error('endereco')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="valor" class="font-bold">Valor de venda</label>
    <br>
    <input type="number" name="valor" id="" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('valor', $imovel->valor)}}">
    <br>
    @error('valor')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="area" class="font-bold">Área(m²)</label>
    <br>
    <input type="number" name="area" id="" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('area', $imovel->area)}}">
    <br>
    @error('area')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="quartos" class="font-bold">Quartos</label>
    <br>
    <input type="number" name="quartos" id="" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old("quartos", $imovel->quartos)}}">
    <br>
    @error('quartos')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="latitude" class="font-bold">Latitude</label>
    <br>
    <input type="number" step="any" name="latitude" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('latitude', $imovel->latitude)}}">
    <br>
    @error('latitude')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="longitude" class="font-bold">Longitude</label>
    <br>
    <input type="number" step="any" name="longitude" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('longitude', $imovel->longitude)}}">
    <br>
    @error('longitude')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="iptu" class="font-bold">IPTU</label>
    <br>
    <input type="number" name="iptu" id="" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('iptu', $imovel->iptu)}}">
    <br>
    @error('iptu')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="condominio" class="font-bold">Valor do condomínio</label>
    <br>
    <small>Se não existir coloque 0.</small>
    <br>
    <input type="number" name="condominio" id="" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('condominio', $imovel->condominio)}}">
    <br>
    @error('condominio')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="vagas" class="font-bold">Vagas</label>
    <br>
    <small>Se não existir coloque 0.</small>
    <br>
    <input type="number" name="vagas" id="" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-6/12 my-2 focus:shadow-md focus:outline-[#97D776] max-[700px]:w-[90%]" value="{{old('vagas', $imovel->vagas)}}">
    <br>
    @error('vagas')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <label for="mobilia" class="font-bold">Mobília</label>
    <br>
    <div class="relative h-10 w-72 min-w-[200px] mt-3">
        <select
            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            name="mobilia">
            <option value="1" {{ $imovel->mobilia == 1 ? 'selected' : '' }}>Sim</option>
            <option value="0" {{ $imovel->mobilia == 0 ? 'selected' : '' }}>Não</option>
        </select>
        <label
            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
            Selecione uma opção
        </label>
    </div>
    @error('mobilia')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <br>
    <p class="font-bold my-3">Adicione imagens</p>
    <label for="imagens" class="inline-block mb-3 cursor-pointer align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
            Selecionar imagens
    </label>
    <input type="file" name="imagens[]" id="imagens" class="hidden" multiple accept="images/*" value="{{old('imagens[]')}}">
    <br>
    <label for="" class="font-bold mt-3">Descrição do imóvel</label>
    <br>
    <textarea id="" cols="30" rows="10" class="mt-3 w-6/12 px-2 py-2 bg-gray-300 rounded-md focus:outline-[#97D776] max-[700px]:w-[90%]" name="descricao">{{old('descricao', $imovel->descricao)}}</textarea>
    @error('descricao')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <h1 class="font-bold">Finalidade</h1>
    <div class="relative h-10 w-72 min-w-[200px] mt-3">
        <select
            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            name="finalidade_id">
            @foreach ($finalidades as $finalidade)
                <option value="{{$finalidade->id}}" {{($imovel->finalidade->id === $finalidade->id) ? "selected" : ""}}>{{$finalidade->nome}}</option>
            @endforeach
        </select>
        <label
            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
            Selecione uma finalidade
        </label>
    </div>
    @error('finalidade_id')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <h1 class="font-bold mt-3">Tipo</h1>
    <div class="relative h-10 w-72 min-w-[200px] mt-3">
        <select
            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            name="tipo_id">
            @foreach ($tipos as $tipo)
                <option value="{{$tipo->id}}" {{($imovel->tipo->tipo === $tipo->id) ? "selected" : ""}}>{{$tipo->nome}}</option>
            @endforeach
        </select>
        <label
            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
            Selecione um tipo
        </label>
    </div>
    @error('tipo_id')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <h1 class="font-bold mt-3">Bairro</h1>
    <div class="relative h-10 w-72 min-w-[200px] mt-3">
        <select
            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            name="bairro_id">
            @foreach ($bairros as $bairro)
                <option value="{{$bairro->id}}" {{ $imovel->bairro->id == $bairro->id ? 'selected' : '' }}>{{$bairro->nome}}</option>
            @endforeach
        </select>
        <label
            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
            Selecione um bairro
        </label>
    </div>
    @error('bairro_id')
        @include("partials.inputErro", ["mensagem" => $message])
    @enderror
    <div class="mt-3 flex flex-wrap w-6/12 max-[700px]:w-[90%]">
        @if (!$imovel->imagens->isEmpty())
            @foreach ($imovel->imagens as $imagem)
            <label for="{{$imagem->id}}">
                <img src="{{ asset($imagem->url) }}" alt="" style="height: 70px" class="mt-2">
            </label>
            <input type="checkbox" name="deletar[]" id="{{$imagem->id}}" value="{{$imagem->id}}">
            @endforeach
        @endif
    </div>
    <div>
        <button
        class="mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
        type="submit"
        >
        Editar
        </button>
    </div>
</form>
<form action="{{route("imoveis.destroy", $imovel->id)}}" method="post" class="mt-1">
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