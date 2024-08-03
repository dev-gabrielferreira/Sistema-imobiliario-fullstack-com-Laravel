@foreach ($imoveis as $imovel)
    <a href="imoveis/{{str_replace(' ', '-', $imovel->titulo)}}/{{$imovel->id}}" class="block" target="_blank">
        <div class="card shadow-md rounded-md mt-2">
            <div class="swiper w-full h-[170px]">
                <div class="swiper-wrapper w-full h-[170px]">
                  @foreach ($imovel->imagens as $img)    
                      <div class="swiper-slide w-full h-[170px]">
                          <img src="{{asset($img->url)}}" alt="" class="w-full h-[170px] object-cover rounded-lg">
                      </div>
                  @endforeach
                </div>
                <div class="swiper-pagination"></div>
              </div>
            <div class="py-2 px-1">
                <small class="px-1 font-light">{{$imovel->tipo->nome}}</small>
                <h1 class="font-bold text-sm px-1 truncate">{{$imovel->endereco}}, {{$imovel->bairro->nome}}</h1>
                <h1 class="font-bold text-md px-1">R$ {{number_format($imovel->valor, 0, ',', '.')}}</h1>
                <p class="text-gray-600 text-sm px-1">R$ {{number_format($imovel->condominio + $imovel->iptu, 0, ',', '.')}} Condo. + IPTU</p>
                <p class="text-sm font-bold px-1">{{$imovel->area}}m² - {{$imovel->quartos}} quartos</p>
            </div>
            </div>
    </a>
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swipers = document.querySelectorAll('.swiper');
        swipers.forEach(swiperEl => {
            new Swiper(swiperEl, {
                pagination: {
                    el: swiperEl.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                slidesPerView: 1,
                spaceBetween: 10,
            });
        });
    });
</script>

@section('styles')
    <style>
        .card{
            width: 250px;
        }
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

        @media(max-width: 450px){
            .card{
                width: 300px;
            }
        }
    </style>
@endsection