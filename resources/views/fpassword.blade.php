@extends('templateIndex_head');

@section('body')
    <form class='form__registro' method="POST" action="{{ url_for('login') }}">
        <label for="username" class="label">Insira seu email:</label> <br>
        <input type="email  " id="useremail" name="useremail" class='form__registro-input'><br><br>
        <input type="submit" value="Enviar">
        <!--<input type="button" onclick="funcao1()" value="Exibir Alert" />-->
    </form>
@endsection