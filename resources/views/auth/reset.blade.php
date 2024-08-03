<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerar nova senha</title>
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
            
            <form action="{{route('perfil.reset')}}" method="post" class="max-[800px]:w-ful">
                @if ($errors->any())
                    <div class="my-2 max-w-[300px] max-[800px]:w-[250px]">
                        <ul class="w-full">
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500 text-sm w-full text-center">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session("sucesso"))
                    <p class="my-4 py-[5px] w-full bg-green-300 rounded-md px-2 max-[700px]:w-[80%]">{{session('sucesso')}}</p> 
                @endif
                @csrf
                <h1 class="text-center gray-900 text-2xl font-bold">Esqueceu sua senha?<br>Deixe seu email para recuperar o acesso</h1>
                <div class="w-[300px] mt-6 max-[800px]:w-full mx-auto">
                    <label for="email" class="font-bold">Email</label>
                    <br>
                    <input type="email" name="email" placeholder="Digite seu email" class="bg-gray-300 rounded-md py-2 px-1 text-sm w-full my-2 focus:shadow-md focus:outline-[#97D776] max-[800px]:w-full">
                  
                    @error('email')
                        <p class="text-red-500 text-sm my-[5px]">{{$message}}</p>
                    @enderror
                </div>
                <br>
                <div class="w-[300px] max-[800px]:w-full mx-auto">
                    <button
                    class="mt-1 w-full align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none max-[800px]:w-full"
                    type="submit"
                    >
                    Gerar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>