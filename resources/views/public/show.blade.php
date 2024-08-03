@extends('layouts.app')
@section('titulo', $imovel->titulo)
@section('titulo_pagina', $imovel->titulo)
@if (!$imovel->imagens->isEmpty())
    @section('imagem', $imovel->imagens[0]->url)
@endif

@section('conteudo')
<section class="flex max-[700px]:flex-wrap-reverse max-[700px]:wrap">
    <div class="w-[45%] px-3 flex flex-col justify-between max-[700px]:w-full">
        <h1 class="text-3xl font-bold mt-3">{{$imovel->titulo}}</h1>
        <div class="max-[700px]:mt-2">
            <h1 class="text-4xl font-bold max-[700px]:mt-2 max-[700px]:text-2xl">R$ {{number_format($imovel->valor, 0, ',','.')}}</h1>
            <h2 class="text-3xl font-semibold text-gray-500 max-[700px]:text-2xl">Condomínio R$ {{number_format($imovel->condominio, 2, ',','.')}}</h2>
            <h2 class="text-3xl font-semibold text-gray-500 max-[700px]:text-2xl">IPTU 12x R$ {{number_format($imovel->iptu, 2, ',','.')}}</h2>
            <h3 class="text-3xl font-semibold text-gray-500 flex items-center max-[700px]:text-2xl max-[700px]:hidden">{{$imovel->endereco}} <span class="block w-2 h-2 rounded-[50%] bg-gray-500 mx-1"></span> {{$imovel->bairro->nome}}</h3>
            <h3 class="text-3xl font-semibold text-gray-500 items-center max-[700px]:text-2xl hidden max-[700px]:inline-block">{{$imovel->endereco}}, {{$imovel->bairro->nome}}</h3>
        </div>
    </div>
    <div class="swiper swiper-images h-[83vh] w-[55%] mx-0 relative max-[700px]:w-full max-[700px]:h-auto">
        <div class="swiper-wrapper relative">
          @if ($imovel->imagens)
              @foreach ($imovel->imagens as $img)
                  <div class="swiper-slide">
                    <img src="{{asset($img->url)}}" alt="" class="object-cover">
                  </div>
              @endforeach
          @endif
        </div>
        <div class="swiper-pagination swiper-pagination-images"></div>
      
        <div class="absolute bottom-7 right-0 w-[100px] flex gap-1 justify-center">
            <div class="swiper-button-prev swiper-button-prev-images px-5 py-4 bg-black bg-opacity-65 text-white"><</div>
            <div class="swiper-button-next swiper-button-next-images px-5 py-4 bg-black bg-opacity-65 text-white">></div>
        </div>

      </div>
</div>
</section>
<section class="px-4 pt-6 pb-4 flex flex-wrap-reverse max-w-6xl mx-auto">
    <div class="w-[70%] max-[700px]:w-full">
        <h1 class="font-bold my-2">Código do imóvel: {{$imovel->id}}</h1>
        <div class="py-4 px-4 bg-gray-300 flex gap-4 flex-wrap justify-center">
            <div class="flex gap-1 items-center">
                <p class="text-xl"><i class="bi bi-car-front"></i></p>
                <p>{{
                    ($imovel->vagas > 1) ? "$imovel->vagas vagas" : "$imovel->vagas vaga" ;  
                    }}</p>
            </div>
            <div class="flex gap-1 items-center">
                <p class="text-xl"><i class="bi bi-door-closed"></i></p>
                <p>{{
                    ($imovel->quartos > 1) ? "$imovel->quartos quartos" : "$imovel->quartos quarto" ;  
                    }}</p>
            </div>
            <div class="flex gap-1 items-center">
                <p class="text-xl"><i class="bi bi-box-seam"></i></p>
                <p>{{ ($imovel->mobilia == 1) ? "Mobiliado" : "Sem mobília" }}</p>
            </div>
            <div class="flex gap-1 items-center">
                <p class="text-xl"><i class="bi bi-bounding-box-circles"></i></p>
                <p>{{$imovel->area}}m²</p>
            </div>
        </div>
        <div class="mt-4">
            <h1 class="font-bold text-xl">Descrição do imóvel</h1>
            <p class="mt-2 overflow-hidden h-[200px]" id="descricao">
                {{$imovel->descricao}}
            </p>
            <button id="button" class="mt-3 font-bold flex items-center justify-center py-2 w-[200px] rounded-3xl bg-gray-600 bg-opacity-60">Ver mais  <i class='bi bi-chevron-down'></i></button>
        </div>
        <div id="map" class="h-[280px] mt-4"></div>

        @if (!$similares->isEmpty())
        <div class="swiper mySwiper mt-4 h-[335px] w-0full flex justify-center">
            <div class="swiper-wrapper">
              @foreach ($similares as $similar)
              <a href="/imoveis/{{str_replace(' ', '-', $similar->titulo)}}/{{$similar->id}}" target="_blank" class="swiper-slide w-[250px] h-[300px] bg-white rounded-lg shadow-md">
                <div class="swiper mySwiperInner w-[250px] h-[170px]">
                  <div class="swiper-wrapper w-full h-[170px]">
                    @foreach ($similar->imagens as $img)    
                        <div class="swiper-slide w-full h-[170px]">
                            <img src="{{asset($img->url)}}" alt="" class="w-full h-[170px] object-cover rounded-lg">
                        </div>
                    @endforeach
                  </div>
                  <div class="swiper-pagination swiper-pagination-inner"></div>
                </div>
                <div class="py-1 px-1">
                    <small class="px-1 font-light">{{$similar->tipo->nome}}</small>
                    <h1 class="font-bold text-sm px-1 overflow-hidden text-ellipsis whitespace-nowrap">{{$similar->endereco}}, {{$similar->bairro->nome}}</h1>
                    <h1 class="font-bold text-md px-1">R$ {{number_format($similar->valor, 0, ',', '.')}}</h1>
                    <p class="text-gray-600 text-sm px-1">R$ {{number_format($similar->condominio + $similar->iptu, 0, ',', '.')}} Condo. + IPTU</p>
                    <p class="text-sm font-bold px-1">{{$similar->area}}m² - {{$similar->quartos}} quartos</p>
                </div>
              </a>
              @endforeach
            </div>
            <div class="swiper-button-prev bg-white h-[50px] w-[50px] text-gray-900 text-sm rounded-[50%] p-2 shadow-md hover:bg-[#97D776] duration-500"><</div>
            <div class="swiper-button-next bg-white h-[50px] w-[50px] text-gray-900 text-sm rounded-[50%] p-2 shadow-md hover:bg-[#97D776] duration-500">></div>
          </div>
        @endif
        
    </div>
    <div class="w-[30%] relative px-3 max-[700px]:w-full">
        <div class="sticky top-4 transform h-[68vh] max-[700px]:h-auto w-[90%] bg-gray-700 rounded-lg shadow-lg px-3 py-6 max-[700px]:mb-4 max-[700px]:mx-auto">
            <p class="text-white font-light">Valor do imóvel</p>
            <h1 class="text-[#97D776] font-bold text-3xl mt-2">R$ {{number_format($imovel->valor, 0, ',', '.')}}</h1>
            <hr class="mt-4">
            <p class="mt-4 text-white">Condomínio: R$ {{number_format($imovel->condominio, 2, ',','.')}}</p>
            <p class="mt-2 text-white">IPTU: 12x R$ {{number_format($imovel->iptu, 2, ',','.')}}</p>
            <p class="mt-2 text-white">Endereço: {{$imovel->endereco . ", " . $imovel->bairro->nome}}</p>
            <p class="mt-2 text-white">Código: {{$imovel->id}}</p>
            <div class="mt-3 w-full">
                <a href="https://wa.me/5521976027679" class="block w-full mt-3 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-[#97D776] text-gray-900 shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none" target="_blank">Agende uma visita</a>
                <a href="https://wa.me/?text={{"http://localhost:8000/imoveis/$imovel->titulo/$imovel->id"}}" class="flex gap-3 items-center justify-center w-full mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-[#97D776] text-gray-900 shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none" target="_blank"><i class="bi bi-share-fill"></i> Compartilhar</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

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

@section('scripts')
    <script src="{{ asset('js/homeSwiper.js')}}"></script>
    <script>
        const swiperOuter = new Swiper('.swiper-images', {
        pagination: {
            el: '.swiper-pagination-images',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next-images',
            prevEl: '.swiper-button-prev-images',
        },
        slidesPerView: 'auto',
        spaceBetween: 20,
});
    </script>
    <script>
        const map = L.map('map').setView([{{$imovel->latitude}}, {{$imovel->longitude}}], 16);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        const marker = L.marker([{{$imovel->latitude}}, {{$imovel->longitude}}]).addTo(map);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const button = document.querySelector("#button");
            const descricao = document.querySelector("#descricao");

            button.addEventListener("click", () => {
                if(descricao.classList.contains("h-[200px]")){
                    console.log('oi')
                    descricao.classList.remove("h-[200px]");
                    descricao.classList.add("h-full");
                    button.innerHTML = "Ver menos <i class='bi bi-chevron-up'></i>"
                }else{
                    console.log('chau')
                    descricao.classList.remove("h-full");
                    descricao.classList.add("h-[200px]");
                    button.innerHTML = "Ver mais <i class='bi bi-chevron-down'></i>"
                }
            });
        });
    </script>
@endsection