@extends('templateIndex_head') @section('head')
<title>TV Taubaté | Login</title>
@endsection @section('body')
<form class="form__login" onsubmit="login(event)">
    <h1 class="form__login-titulo">Entrar</h1>
    <h2 class="form__login-user">Usuario:</h2>
    <input
        class="form__login-input-user"
        type="email"
        name="email"
        placeholder="Email"
        required
    />
    <h2 class="form__login-pass">Senha:</h2>
    <input
        class="form__login-input-pass"
        type="password"
        name="password"
        placeholder="Senha"
        required
    />
    <div class="links__form">
        <p class="form__login-link">
            <a href="{{ url('esqueci_senha') }}">esqueci minha senha</a>
        </p>

        <p class="form__login-link">
            <a href="{{ url('registrar') }}">Cadastrar</a>
        </p>
    </div>
    <button class="form__login-botao" type="submit">Entrar</button>
</form>
@push('scripts')
<script src="{{ asset('js/login.js') }}"></script>
@endpush @endsection
