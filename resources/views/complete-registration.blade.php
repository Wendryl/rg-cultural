@extends('admin-base')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/complete-registration.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('js/complete-registration.js') }}"></script>
@endpush
@section('body')
<form class="form-card">
  <div class="edit-picture" onclick="openFileInput()">
    <img src="{{ asset('img/profile.png')}}" alt="Sua imagem de perfil." id="pic-preview">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
  </div>
  <input type="file" name="profilePicture" onchange="setProfilePic(event)" accept=".jpg, .jpeg, .png">
  <div>
    <input type="text" name="name" placeholder="Nome*">
  </div>
  <div>
    <input type="text" name="email" placeholder="E-mail*">
  </div>
  <div>
    <input type="text" name="phone" placeholder="Telefone*">
    <input type="text" name="cep" placeholder="CEP">
  </div>
  <div>
    <input type="text" name="address" placeholder="Endereço">
    <input type="text" name="number" placeholder="Número">
  </div>
  <div>
    <input type="text" name="neighborhood" placeholder="Bairro">
    <input type="text" name="city" placeholder="Cidade">
  </div>
    <button class="btn btn-save">Salvar</button>
</form>
@endsection
