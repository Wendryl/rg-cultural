@extends('templateIndex_head');
@section('head')
    <title> RG Cultural</title>
@endsection

@section('body')
    <!-- Chamada para o site -->
    <section class="chamada">
        <div class='chamada__bg-image'></div>

        <div class="chamada__texto-container">
            <h1 class='chamada__titulo'>RG Taubaté</h1>
            <h2 class='chamada__subtitulo'>Catálogo de Artistas de Taubaté</h2>

            <p class="chamada__texto">Um site pensado para você artista que mora na cidade de Taubaté.</p>
            <p class="chamada__texto">E para você que procura por um artista na região</p>
        </div>
        <a href='{{ url("login") }}' class='chamada__link-cadastro'>Cadastre-se agora e descubra!</a>
    </section>
    <section class="descubra">
        <ul class="descubra__lista">
            <li class="descubra__lista-item descubra__lista-item--artista">
                <h2 class="item__titulo">Você Artista:</h2>
                <p class="item__texto">Cadastre-se para manter seu publico atualizado de seus trabalhos feitos.</p>
            </li>
            <div class='linha__separadora'></div>

            <li class="descubra__lista-item descubra__lista-item--empregador">
                <h2 class="item__titulo">Você Contratante:</h2>
                <p class="item__texto">A maneira mais facil de procurar por um artista de sua preferência e entrar em contato.</p>
            </li>
            <div class='linha__separadora'></div>

            <li class="descubra__lista-item descubra__lista-item--usuario">
                <h2 class="item__titulo">Você Usuario:</h2>

                <p class="item__texto">Pode se manter sempre atualizado sobre seu artista favorito.</p>
            </li>
            <li style='margin: 70px 0;'>
                <a href="{{ url('descobrir') }}" class='descubra-mais__botao'>Descubra Mais</a>
            </li>
        </ul>
    </section>
@endsection