@extends('user-dashboard/dashboard-base')
@section('body')
  <div class="d-flex justify-content-center flex-column flex-md-row justify-content-md-around">
    <img src="{{ asset('img/welcome.jpg') }}" alt="Pessoas acenando, bem vindo!" id="welcome-pic">
    <div class="d-flex flex-column align-items-center justify-content-center">
      <h3 class="text-center my-3">
        Bem-vindo ao portal RG Cultural!
      </h3>
      <a class="btn btn-primary" href="/profile-setup">
        Complete seu cadastro
      </a>
    </div>
  </div>
@endsection