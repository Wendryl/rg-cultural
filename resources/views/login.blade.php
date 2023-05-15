@extends('templateIndex_head') @section('head')
<title>TV Taubaté | Login</title>
@endsection @section('body')
  <form class="form__login" action="/login" method="POST">
    @csrf
    @if (session('error'))
      <span class="error-msg">
        {{ session('error') }}
      </span>
    @endif
    @if (session('message'))
      <span class="success-msg">
        {{ session('message') }}
      </span>
    @endif
    <h1 class="form__login-titulo">Entrar</h1>
    <h2 class="form__login-user">E-mail:</h2>
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
        {{-- <p class="form__login-link"> --}}
        {{--     <a href="{{ url('esqueci_senha') }}">esqueci minha senha</a> --}}
        {{-- </p> --}}
        {{-- TODO - Implementar método de recuperação de senha --}}
        <p class="form__login-link">
            <a href="{{ url('register') }}">Cadastrar</a>
        </p>
    </div>
    <button class="form__login-botao" type="submit">Entrar</button>
</form>
@endsection
