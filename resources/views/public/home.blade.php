@extends('layouts.app')
@section('titulo', 'Loja | Página principal')

@section('conteudo')
<main class="bg-green-200 h-[500px] relative">
    <img src="https://img.freepik.com/fotos-gratis/luxo-moderno-em-quarto-domestico-confortavel-relaxamento-generativo-ai_188544-12679.jpg?ga=GA1.1.1239739188.1721056721&semt=sph" alt="" class="w-full object-cover h-full saturate-50">
    <div class="absolute inset-0 bg-black opacity-50 flex items-center justify-center z-[1]"></div>
    <div class="absolute w-full inset-0 bg-transparent flex items-center justify-center flex-col z-[2]">
        <h1 class="text-white font-bold text-2xl max-[700px]:text-center">Busque por sua casa dos sonhos</h1>
        <br>
        <form method="get" class="relative w-6/12 h-10 flex items-center justify-center gap-2 max-[600px]:w-[90%] max-[600px]:flex-col" id="buscar">
            <div class="w-full">
                <input list="bairros" name="query" id="input" placeholder="Digite um bairro" class="px-2 bg-gray-300 rounded-md py-2 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]" required>
                <datalist id="bairros">
                    @foreach ($bairros as $bairro)
                        <option value="{{$bairro->nome}}">{{$bairro->nome}}</option>
                    @endforeach
                </datalist>
            </div>
            <button
                class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-[#97D776] text-gray-900 shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                type="submit"
                >
                Buscar
            </button>
        </form>
    </div>
</main>
<section class="bg-gray-200 px-4 py-4">
      <div class="max-w-6xl mx-auto">
          <h1 class="text-3xl font-bold">Mais recentes</h1>
      </div>
      <div class="swiper mySwiper mt-4 h-[335px] max-w-6xl flex justify-center">
        <div class="swiper-wrapper">
          @foreach ($imoveisRecentes as $imovel)
          <a href="/imoveis/{{str_replace(' ', '-', $imovel->titulo)}}/{{$imovel->id}}" target="_blank" class="swiper-slide w-[250px] h-[300px] bg-white rounded-lg shadow-md">
            <div class="swiper mySwiperInner w-[250px] h-[170px]">
              <div class="swiper-wrapper w-full h-[170px]">
                @foreach ($imovel->imagens as $img)    
                    <div class="swiper-slide w-full h-[170px]">
                        <img src="{{asset($img->url)}}" alt="" class="w-full h-[170px] object-cover rounded-lg">
                    </div>
                @endforeach
              </div>
              <div class="swiper-pagination swiper-pagination-inner"></div>
            </div>
            <div class="py-1 px-1">
                <small class="px-1 font-light">{{$imovel->tipo->nome}}</small>
                <h1 class="font-bold text-sm px-1 overflow-hidden text-ellipsis whitespace-nowrap">{{$imovel->endereco}}, {{$imovel->bairro->nome}}</h1>
                <h1 class="font-bold text-md px-1">R$ {{number_format($imovel->valor, 0, ',', '.')}}</h1>
                <p class="text-gray-600 text-sm px-1">R$ {{number_format($imovel->condominio + $imovel->iptu, 0, ',', '.')}} Condo. + IPTU</p>
                <p class="text-sm font-bold px-1">{{$imovel->area}}m² - {{$imovel->quartos}} quartos</p>
            </div>
          </a>
          @endforeach
        </div>
        <div class="swiper-button-prev bg-white h-[50px] w-[50px] text-gray-900 text-sm rounded-[50%] p-2 shadow-md hover:bg-[#97D776] duration-500"><</div>
        <div class="swiper-button-next bg-white h-[50px] w-[50px] text-gray-900 text-sm rounded-[50%] p-2 shadow-md hover:bg-[#97D776] duration-500">></div>
      </div>
    
</section>
<section class="bg-[#97D776]">
    <div class="w-6/12 px-4 py-4 mx-auto max-[700px]:w-[90%]">
        <h1 class="font-bold text-3xl py-2 text-center">Faça uma simualção do seu financiamento</h1>
        <label for="">Valor do imóvel</label>
        <br>
        <input type="number" name="" id="valor" placeholder="Digite o valor do imovel" class="px-2 bg-gray-300 rounded-md py-2 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]">
        <br>
        <label for="">Renda</label>
        <br>
        <input type="number" name="" id="renda" placeholder="Digite sua renda mensal" class="px-2 bg-gray-300 rounded-md py-2 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]">
        <br>
        <label for="">Entrada</label>
        <br>
        <input type="number" name="" id="entrada" placeholder="Digite o valor da entrada" class="px-2 bg-gray-300 rounded-md py-2 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]">
        <br>
        <label for="">Tempo de financiamento(em anos)</label>
        <br>
        <input type="number" name="" id="anos" placeholder="Digite o tempo que deseja financiar" max="30" class="px-2 bg-gray-300 rounded-md py-2 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776]">
        <br>
        <div class="flex justify-center">
            <button
            class=" mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
            type="submit"
            onclick="simular()"
            >
            Fazer simualção
            </button>
        </div>
    </div>
    <div id="resultado" class="flex justify-center items-center"></div>
</section>
<section class="bg-gray-900">
    <h1 class="font-bold text-2xl text-center text-[#97D776] py-4">Explore por nossos imóveis</h1>
    <div class="flex items-center justify-center h-[50vh] gap-[30px] max-[500px]:flex-col">
        <div class="w-6/12 text-center">
            <h1 class="text-xl font-bold text-white">Veja todas as casas</h1>
            <div class="mt-3">
                <a href="/imoveis?tipo=Casa"
                class="mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-[#97D776] text-gray-900 shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                >
                Ver casas
                </a>
            </div>
        </div>
        <div class="h-5/6 w-[1px] bg-gray-400 max-[500px]:h-[1px] max-[500px]:w-[90%] max-[500px]:my-4"></div>
        <div class="w-6/12 text-center">
            <h1 class="text-xl font-bold text-white">Veja todos os apartamentos</h1>
            <div class="mt-3">
                <a href="/imoveis?tipo=Apartamento"
                class=" mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-[#97D776] text-gray-900 shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                >
                Ver apartamentos
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{ asset('js/homeSwiper.js')}}"></script>
    <script src="{{ asset('js/avaliarPoderCompra.js')}}"></script>
    <script>
        function redirecionar(e) {
            e.preventDefault();
            const bairro = document.querySelector("#input").value;
            window.location.href = `/imoveis?bairro=${encodeURIComponent(bairro)}`;
        }

        document.getElementById('buscar').addEventListener('submit', redirecionar);
    </script>
@endsection

@section('styles')
    <style>
        .swiper-button-next::after, .swiper-button-prev::after{
            content: none;
        }
        .swiper-pagination-bulltet{
            background-color: #fff;
        }
        .swiper-pagination-bullet-active{
            background-color: #fff;
            width: 10px;
            height: 10px;
        }
    </style>
@endsection
