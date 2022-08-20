@extends('templateIndex_head'); @section('head')
<title>TV Taubaté | Registrar</title>
@endsection @section('body')
<form class="form__cadastro" action="/register" method="POST">
  @csrf
    @if (session('error'))
      <span class="error-msg">
        {{ session('error') }}
      </span>
    @endif
    <h1 class="form__cadastro-titulo">Cadastrar</h1>

    <h2 class="form__cadastro-email">Email (Também será o seu ID):</h2>
    <input
        class="form__cadastro-input"
        type="email"
        minlength="5"
        name="email"
        required
        placeholder="exemplo@gmail.com"
    /><br /><br />

    <h2 class="form__cadastro-user">Usuário:</h2>
    <input
        class="form__cadastro-input"
        type="name"
        minlength="5"
        name="name"
        required
        placeholder="Seu Usuário"
        data-form-senha
    /><br /><br />

    <h2 class="form__cadastro-pass">Senha:</h2>
    <input
        class="form__cadastro-input"
        type="password"
        minlength="5"
        name="password"
        required
        placeholder="********"
        data-form-confirma-senha
    /><br /><br />

    <div class="container_senha-errada"></div>

    <p class="form__cadastro-link">
        <a href="{{ url('login') }}"> Já possui conta?</a>
    </p>

    <div class="botoes__acoes">
        <input type="submit" value="Cadastrar" class="form__login-botao" />
        <input type="reset" value="Limpar" class="form__login-botao" />
    </div>
</form>
@endsection
