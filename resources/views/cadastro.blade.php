@extends('templateIndex_head');

@section('head')
    <title>TV Taubaté | Registrar</title>
@endsection

@section('body')
    <form class='form__registro' method="post" action="{{ url('cria_cadastro') }}">
        <h1 class='form__registro-titulo'>Cadastrar</h1>
        <label class="label" for='useremail'>Email (também será seu ID):</label> <br>
        <input class='form__registro-input' type="email" name="useremail" placeholder="seuEmail@gmail.com" required><br><br>
        <label class="label" for="username">Usuario:</label> <br>
        <input class='form__registro-input' type="text" minlength="5" name="username" required placeholder="Seu usuario"><br><br>
        <label class="label" for="password">Senha (pelo menos 8 caracteres):</label> <br>
        <input class='form__registro-input' type="password" minlength="8" name="password" required placeholder="********">
        <p class='form__registro-link'><a href=" {{ url('login') }}" > Já possui conta?</a></p>
        <input type="submit" value="Cadastrar" class='form__registro-botao'>
        <input type="reset" value="Limpar" class='form__registro-botao'>
    </form>
@endsection
