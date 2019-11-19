<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vagas</title>
</head>
<body>
    <h1>
        @if($approved)
            Parabéns, {{ $name }}, você está aprovado!
        @else
            {{ $name }}, você foi reprovado por algum motivo.
        @endif
    </h1>
</body>
</html>
