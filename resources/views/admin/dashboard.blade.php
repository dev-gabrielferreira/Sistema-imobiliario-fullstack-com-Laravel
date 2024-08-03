@extends('layouts.admin')

@section('conteudo')
<div class="px-[10px]">
    <h1 class="text-3xl font-bold max-[500px]:text-2xl">Bem vindo ao painel, {{$usuario->nome}}!</h1>
    <h3 class="text-2xl font-semibold max-[500px]:text-xl">Imoveis adicionados na semana: {{$imoveis}}</h3>

    <div class="flex items-center gap-4 mt-4 max-[1000px]:block">
      <div class="w-[350px] max-[700px]:mx-auto">
          <h1 class="font-bold text-2xl mt-4">Apartamentos x Casas</h1>
          <div class="w-[240px] max-[1000px]:w-[80%]">
            <canvas id="myChart" class="w-full h-[100px]" style="height: 100px !important;"></canvas>
          </div>
      </div>
      <div class="w-[44%] max-[1000px]:w-[95%] max-[700px]:mx-auto">
        <h1 class="font-bold text-2xl mt-4">Imoveis por bairro</h1>
        <canvas id="chartBar" class="w-full h-[200px]"></canvas>
      </div>
    </div>
    <h1 class="font-bold text-2xl mt-4">Imoveis na região</h1>
    <div id="map" class="w-6/12 h-[300px] mt-4 max-[700px]:w-full max-[700px]:h-[200px] relative z-10"></div>
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const data = {
    labels: [
        'Casas',
        'Apartamentos'
    ],
    datasets: [{
        label: ' ',
        data: [{{$casas}}, {{$apartamentos}}],
        backgroundColor: [
        '#97D776',
        '#111827'
        ],
        hoverOffset: 4
    }]
  };

  new Chart(ctx, {
    type: 'doughnut',
    data: data,
  });

  const bairros =  @json($imoveisPorBairro);
  const labels = bairros.map(el => el.nome)
  const dataBar = {
    labels: labels,
      datasets: [{
        label: ' ',
        data: bairros.map(el => el.total),
        backgroundColor: [
          "#111827"
        ],
        borderWidth: 1,
        borderRadius: 10
      }]
  };
  const bar = document.getElementById('chartBar').getContext('2d');

  new Chart(bar, {
    type: 'bar',
    data: dataBar,
    options: {
      scales: {
        x: {
          grid: {
            display: false
          }
        },
        y: {
          grid: {
            display: false 
          }
        }
      }
    }
  })

</script> 
<script>
  const map = L.map('map').setView([-22.9331064, -43.3770326], 10);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  const coords = @json($coords);
  const lugares = coords.map(el => [el.latitude, el.longitude])

  for(let i = 0; i < lugares.length;i++){
    const marker = L.marker([lugares[i][0], lugares[i][1]]).addTo(map);
  }
</script>
@endsection