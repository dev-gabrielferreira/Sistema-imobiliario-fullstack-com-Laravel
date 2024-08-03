<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="@yield('titulo_pagina', '')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('imagem', asset('images/home.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <title>@yield('titulo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('styles')
</head>
<body>
    <div class=" max-[700px]:overflow-x-hidden">
        <header class="w-full shadow-md flex justify-center items-center relative z-20">
            @include("partials.navbarPublic")
        </header>
        <div class="min-h-screen">
            @yield('conteudo')
        </div>
        @include("partials.footer")
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @yield('scripts')
    
</body>
</html>