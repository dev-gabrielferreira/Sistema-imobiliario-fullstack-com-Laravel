<nav class="h-20 w-full flex justify-between items-center max-w-6xl px-4 max-[700px]:relative">
    <div>
        <h1 class="font-bold">Logo</h1>
    </div>
    <div>
        <button class="text-2xl relative z-30 hidden max-[700px]:block" id="btn"><i class="bi bi-list"></i></button>
        <ul class="flex items-center justify-center gap-3 max-[700px]:absolute max-[700px]:-right-full max-[700px]:top-0 max-[700px]:h-screen max-[700px]:w-[90%] max-[700px]:block max-[700px]:bg-white max-[700px]:z-20 max-[700px]:transition-all max-[700px]:duration-500 max-[700px]:shadow-2xl" id="menu">
            <h1 class="hidden px-4 font-bold text-2xl my-7 max-[700px]:block">Menu</h1>
            <li class="relative h-7 overflow-hidden group max-[700px]:h-auto">
                <a href="{{route('home')}}" class="max-[700px]:w-full max-[700px]:block max-[700px]:text-left max-[700px]:text-xl max-[700px]:font-bold max-[700px]:py-2 max-[700px]:transition-all max-[700px]:duration-500 {{request()->routeIs('home') ? 'max-[700px]:bg-[#97D776]': ''}} max-[700px]:px-4 max-[700px]:group-hover:bg-[#97D776] transition-all duration-300">Home</a>
                <div class="absolute h-1 w-full bg-gray-900 {{request()->routeIs('home') ? 'bottom-0': '-bottom-1'}} left-0 group-hover:bottom-0 transition-all duration-300 max-[700px]:hidden"></div>
            </li>
            <li class="relative h-7 overflow-hidden group max-[700px]:h-auto">
                <a href="{{route('index')}}" class="max-[700px]:w-full max-[700px]:block max-[700px]:text-left max-[700px]:text-xl max-[700px]:font-bold max-[700px]:py-2 max-[700px]:px-4 {{request()->routeIs('index') ? 'max-[700px]:bg-[#97D776]': ''}} max-[700px]:group-hover:bg-[#97D776] transition-all duration-300">Buscar</a>
                <div class="absolute h-1 w-full bg-gray-900 {{request()->routeIs('index') ? 'bottom-0': '-bottom-1'}} left-0 group-hover:bottom-0 transition-all duration-300 max-[700px]:hidden"></div>
            </li>
            <li class="relative h-7 overflow-hidden group max-[700px]:h-auto">
                <a href="{{route("sobre")}}" class="max-[700px]:w-full max-[700px]:block max-[700px]:text-left max-[700px]:text-xl max-[700px]:font-bold max-[700px]:py-2 max-[700px]:px-4 {{request()->routeIs('sobre') ? 'max-[700px]:bg-[#97D776]': ''}} max-[700px]:group-hover:bg-[#97D776] transition-all duration-300">Sobre</a>
                <div class="absolute h-1 w-full bg-gray-900 {{request()->routeIs('sobre') ? 'bottom-0': '-bottom-1'}} left-0 group-hover:bottom-0 transition-all duration-300 max-[700px]:hidden"></div>
            </li>
            <li class="relative h-7 overflow-hidden group max-[700px]:h-auto">
                <a href="{{route('anunciar.show')}}" class="max-[700px]:w-full max-[700px]:block max-[700px]:text-left max-[700px]:text-xl max-[700px]:font-bold max-[700px]:py-2 max-[700px]:px-4 {{request()->routeIs('anunciar.show') ? 'max-[700px]:bg-[#97D776]': ''}} max-[700px]:group-hover:bg-[#97D776] transition-all duration-300">Anuncie seu imóvel</a>
                <div class="absolute h-1 w-full bg-gray-900 {{request()->routeIs('anunciar.show') ? 'bottom-0': '-bottom-1'}} left-0 group-hover:bottom-0 transition-all duration-300 max-[700px]:hidden"></div>
            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById("btn");
    const menu = document.getElementById('menu');

    if (btn && menu) {
        btn.addEventListener('click', (event) => {
            event.stopPropagation();
            menu.classList.toggle('max-[700px]:-right-full');
            menu.classList.toggle('max-[700px]:right-0');
        });

        window.addEventListener('scroll', () => {
            if (menu.classList.contains('max-[700px]:right-0')) {
                menu.classList.remove('max-[700px]:right-0');
                menu.classList.add('max-[700px]:-right-full');
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#menu') && menu.classList.contains('max-[700px]:right-0')) {
                menu.classList.remove('max-[700px]:right-0');
                menu.classList.add('max-[700px]:-right-full');
            }
        });
    } else {
        console.error("Elementos 'btn' ou 'menu' não encontrados no DOM");
    }
});
</script>
