<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página de Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex items-center max-[800px]:min-h-screen max-[800px]:justify-center max-[800px]:w-full">
        <div class="w-[50%] h-[100vh] bg-[#97D776] flex justify-center items-center max-[800px]:hidden">
            <div class="w-[60%] max-[800px]:hidden">
                <img src="{{asset('images/home.png')}}" alt="logo" class="w-[180px] block mx-auto">
                <h1 class="text-xl text-center font-bold">Controle total em suas mãos. Gerencie todos os aspectos da sua plataforma de forma simples e eficiente</h1>
            </div>
        </div>
        <div class="w-[50%] h-[100vh] flex items-center justify-center max-[800px]:w-[70%]">
            
            <form action="{{route('auth.login')}}" method="post" class="max-[800px]:w-full">
                @if (session("sucesso"))
                    <p class="my-4 py-[5px] w-full bg-green-300 rounded-md px-2 max-[700px]:w-full">{{session('sucesso')}}</p> 
                @endif
                @if (session("erro"))
                    <p class="text-red-500 text-sm w-full text-center">{{session('erro')}}</p>
                @endif
                @csrf
                <h1 class="text-center gray-900 text-2xl font-bold">Faça seu login</h1>
                <div class="w-[300px] mt-6 max-[800px]:w-full">
                    <label for="email" class="font-bold">Email</label>
                    <br>
                    <input type="email" name="email" placeholder="Digite seu email" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776] max-[800px]:w-full">
                  
                    @error('email')
                        <p class="text-red-500 text-sm my-[5px]">{{$message}}</p>
                    @enderror
                </div>
                <div class="w-[300px] mt-2 max-[800px]:w-full">
                    <label for="password" class="font-bold">Senha</label>
                    <br>
                    <input type="password" name="password" placeholder="Digite sua senha" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776] max-[800px]:w-full">
                  
                    @error('password')
                        <p class="text-red-500 text-sm mt-[5px]">{{$message}}</p>
                    @enderror
                </div>
                <br>
                <div>
                    <button
                    class="mt-1 w-full align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none max-[800px]:w-full"
                    type="submit"
                    >
                    Entrar
                    </button>
                </div>
                <a href="{{route("perfil.reset")}}" class="block w-full text-center mt-2">Esqueceu sua senha? Clique aqui</a>
            </form>
        </div>
    </div>
</body>
</html>