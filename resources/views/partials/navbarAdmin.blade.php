<nav class="max-[700px]:relative max-[700px]:w-full max-[700px]:flex max-[700px]:justify-between max-[700px]:items-center max-[700px]:h-[70px] h-screen w-56 fixed top-0 bg-gray-800 max-[700px]:px-4">
    <div class="p-4 mb-2">
        <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-white">
          Loja
        </h5>
    </div>
    <button id="btn" class="relative z-30 text-white text-2xl bg-transparent border-none hidden max-[700px]:block"><i class="bi bi-list"></i></button>
    <ul id="menu" class="mt-7 max-[700px]:block max-[700px]:items-center max-[700px]:gap-4 max-[700px]:absolute max-[700px]:right-[-100%] max-[700px]:h-screen max-[700px]:w-[90vw] max-[700px]:top-0 max-[700px]:bg-gray-900 max-[700px]:z-20 max-[700px]:mt-0 transition-right duration-500">
        <div class="hidden p-4 mb-2 max-[700px]:block">
            <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-white">
              Loja
            </h5>
        </div>
        <li class="z-30 w-full py-2 px-4 hover:bg-[#97D776] hover:text-black transition-all duration-500 {{request()->routeIs('admin.dashboard') ? 'bg-[#97D776] text-black': 'text-white'}}"><a href="{{route('admin.dashboard')}}" class="block w-full"><i class="bi bi-bar-chart"></i> Dashboard</a></li>

        <li class="w-full py-2 px-4 hover:bg-[#97D776] hover:text-black transition-all duration-500 {{request()->routeIs('bairros.*') ? 'bg-[#97D776] text-black': 'text-white'}}"><a href="{{route("bairros.index")}}" class="block w-full"><i class="bi bi-geo-alt"></i> Bairros</a></li>

        <li class="w-full py-2 px-4 hover:bg-[#97D776] hover:text-black transition-all duration-500 {{request()->routeIs('finalidades.*') ? 'bg-[#97D776] text-black': 'text-white'}}"><a href="{{route("finalidades.index")}}" class="block w-full"><i class="bi bi-buildings"></i> Finalidades</a></li>

        <li class="w-full py-2 px-4 hover:bg-[#97D776] hover:text-black transition-all duration-500 {{request()->routeIs('tipos.*') ? 'bg-[#97D776] text-black': 'text-white'}}"><a href="{{route("tipos.index")}}" class="block w-full"><i class="bi bi-houses"></i> Tipos</a></li>

        <li class="w-full py-2 px-4 hover:bg-[#97D776] hover:text-black transition-all duration-500 {{request()->routeIs('imoveis.*') ? 'bg-[#97D776] text-black': 'text-white'}}"><a href="{{route("imoveis.index")}}" class="block w-full"><i class="bi bi-map"></i> Imóveis</a></li>

        <li class="w-full py-2 px-4 hover:bg-[#97D776] hover:text-black transition-all duration-500 {{request()->routeIs('perfil.index') ? 'bg-[#97D776] text-black': 'text-white'}}"><a href="{{route("perfil.index")}}" class="block w-full"><i class="bi bi-person-circle"></i> Perfil</a></li>

        <li class="w-full py-2 px-4 hover:bg-[#97D776] text-white hover:text-black transition-all duration-500">
            <form action="{{route("logout")}}" method="POST">
                @csrf
                <button type="submit" class="block w-full text-left"><i class="bi bi-box-arrow-right"></i> Sair</button>
            </form>
        </li>
    </ul>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById("btn");
    const menu = document.getElementById('menu');

    if (btn && menu) {
        btn.addEventListener('click', (event) => {
            event.stopPropagation();
            menu.classList.toggle('max-[700px]:right-[-100%]');
            menu.classList.toggle('max-[700px]:right-0');
        });

        window.addEventListener('scroll', () => {
            if (menu.classList.contains('max-[700px]:right-0')) {
                menu.classList.remove('max-[700px]:right-0');
                menu.classList.add('max-[700px]:right-[-100%]');
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#menu') && menu.classList.contains('max-[700px]:right-0')) {
                menu.classList.remove('max-[700px]:right-0');
                menu.classList.add('max-[700px]:right-[-100%]');
            }
        });
    } else {
        console.error("Elementos 'btn' ou 'menu' não encontrados no DOM");
    }
});
</script>
