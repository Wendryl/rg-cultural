<header class='cabecalho__principal'>
    <div class="container">
        <h1 class='cabecalho__titulo'>
            <a href="{{ url('index') }}" >RG Cultural</a>
        </h1>
        <nav>
            <ul class='cabecalho__principal-nav'>
                <li><a href="{{ url('') }}" class='cabecalho__principal-nav-link'>Inicio</a></li>
                <li><a href="{{ url('find-professionals') }}" class='cabecalho__principal-nav-link'>Encontre Profissionais</a></li>
                <li><a href="{{ url('about') }}" class='cabecalho__principal-nav-link' style="display: none;">Sobre Nós</a></li>
                <li><a href="{{ url('login') }}" class='cabecalho__principal-nav-link'>Entrar</a></li>
                <li><a href="{{ url('register') }}" class='cabecalho__principal-nav-link'>Registrar</a></li>
            </ul>
        </nav>
    </div>
</header>
