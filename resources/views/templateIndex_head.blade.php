<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--
            Importando fontes:
        -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
        <link rel= "stylesheet" href="{{ asset('css/app.css') }}">

        @yield('head')
    </head>
    <body>
        @include('partials.header')
        <main>
            @yield('body')
        </main>
        @include('partials.rodape_governo')

    </body>
</html>