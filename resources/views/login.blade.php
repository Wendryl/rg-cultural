@extends('templateIndex_head');

@section('head')
    <title>TV Taubaté | Login</title>
@endsection
@section('body')
    <form class='form__registro' action='/autenticar' method="post">
        <h1 class='form__registro-titulo'>Entrar</h1>
        <label class="label" for='id'>Usuario:</label> <br>
        <input class='form__registro-input' type="email" name="id" placeholder="seuEmaul@gmail.com" required><br><br>
        <label class="label" for='password'>Senha:</label> <br>
        <input class='form__registro-input' type="password" name="password" placeholder="Insira tua senha" required>
        <p class='form__registro-link'><a href=" {{ url('esqueci_senha') }} " >esqueci minha senha</a></p>
        <p class='form__registro-link'><a  href="{{ url('registrar') }}">Cadastrar</a></p>
        <button class='form__registro-botao'  type="submit" >Entrar</button>
    </form>
@endsection