@extends('user-dashboard/dashboard-base')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/user-dashboard/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/user-dashboard/complete-registration.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('js/user-dashboard/complete-registration.js') }}"></script>
@endpush
@section('body')
<form class="form-card" action="/update" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
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
  <div class="edit-picture" onclick="openFileInput()">
    <img src="{{ $user->profile_picture ?? '/img/profile.png' }}" alt="Sua imagem de perfil." id="pic-preview">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
  </div>
  <input type="file" name="profile_picture" onchange="setProfilePic(event)" accept=".jpg, .jpeg, .png">
  <div>
    <input type="text" name="name" placeholder="Nome*" required value="{{ $user->name }}">
  </div>
  <div>
    <input type="text" name="email" placeholder="E-mail*" required value="{{ $user->email }}" readonly>
  </div>
  <div>
    <input type="text" name="phone" placeholder="Telefone*" required value="{{ $user->phone }}">
  </div>
  <div>
    <input type="text" name="street" placeholder="Endereço" value="{{ $user->street }}">
    <input type="text" name="number" placeholder="Número" value="{{ $user->number }}">
  </div>
  <div>
    <input type="text" name="neighborhood" placeholder="Bairro" value="{{ $user->neighborhood }}">
    <input type="text" name="city" placeholder="Cidade" value="{{ $user->city }}">
  </div>
  <button class="btn btn-save">Salvar</button>
</form>
@endsection
