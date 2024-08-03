<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div>
        <h2>Endereço: {{$data['endereco']}}, {{$data['bairro']}}</h2>
        <h2>Nome: {{$data['nome']}}</h2>
        <p>Telefone: {{$data['telefone']}}</p>
        <p>Email: {{$data['email']}}</p>
        <p>Tipo do imóvel: {{$data['tipo']}}</p>
        <p>Finalidade: {{$data['finalidade']}}</p>
    </div>
</body>
</html>