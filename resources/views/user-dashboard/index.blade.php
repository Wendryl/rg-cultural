@extends('user-dashboard/dashboard-base')
@section('body')
  <div class="welcome-box">
    <img src="{{ asset('img/welcome.jpg') }}" alt="Pessoas acenando, bem vindo!">
    <span id="welcome-text">
    </span>
    <a class="btn btn-white" href="/complete-registration">
      Complete seu cadastro
    </a>
  </div>
@endsection