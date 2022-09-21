@extends('admin-dashboard/dashboard-base')
@section('body')
@push('scripts')
  <script src="{{ asset('js/admin-dashboard/new-user.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js" integrity="sha512-pgmLgtHvorzxpKra2mmibwH/RDAVMlOuqU98ZjnyZrOZxgAR8hwL8A02hQFWEK25V40/9yPYb/Zc+kyWMplgaA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/admin-dashboard/new-user.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.css" integrity="sha512-wD3+yEMEGhx4+wKKWd0bNGCI+fxhDsK7znFYPvf2wOVxpr7gWnf4+BKphWnUCzf49AUAF6GYbaCBws1e5XHSsg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.default.min.css" integrity="sha512-vKflY6VSoNmvZitwWFIKY6r8j1R8DJwAoM25PFH2EzF49j9gka2gNYMAf31y0Ct++phlsyJSX+9zi/vO1aSSdw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
<div class="row page-title mx-0">
  <div class="col-sm-6">
    <h2>Novo <b>Usuário</b></h2>
  </div>
</div>
<div class="bg-white p-3 mb-3">
  <form action="/new-user" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="created_by" value="admin">
    @csrf
    <div class="row mb-2">
      <div class="col-6">
        <h4 class="fw-bold">Informações pessoais</h4>
        <div>
          <div class="d-flex gap-4 align-items-center">
            <div class="edit-picture" onclick="handlePictureClick('#profile-pic')">
              <input
                  type="file"
                  name="profile_picture"
                  class="d-none"
                  id="profile-pic"
                  onchange="setProfilePicture(event, '#profile-pic-preview')"
                  >
              <img id="profile-pic-preview" src="/img/profile.png"/>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#ffffff" class="w-5 h-5">
                <path fill-rule="evenodd" d="M5.433 13.916l1.262-3.154a4 4 0 01.885-1.343L14.5 2.5a2.121 2.121 0 113 3l-6.92 6.919c-.383.383-.84.684-1.343.885l-3.154 1.262a.5.5 0 01-.65-.65zM2.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H3.75A2.75 2.75 0 001 5.75v10.5A2.75 2.75 0 003.75 19h10.5A2.75 2.75 0 0017 16.25V10a.75.75 0 00-1.5 0v6.25c0 .69-.56 1.25-1.25 1.25H3.75c-.69 0-1.25-.56-1.25-1.25V5.75z" clip-rule="evenodd" />
              </svg>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="mb-2">
                <label for="name" class="form-label">Nome*</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    placeholder="John Doe"
                    required
                    />
              </div>
                  <div>
                    <label for="email" class="form-label">Email*</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="johndoe@email.com"
                        required
                        />
                  </div>
            </div>
          </div>
          <div class="my-3">
            <label for="categories" class="form-label">Categorias</label>
            <select
                name="categories"
                id="categories"
                multiple
                placeholder="Insira as categorias"
                >
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col-6">
        <h4 class="fw-bold">Contato</h4>
        <div class="mb-2">
          <label for="phone" class="form-label">Telefone*</label>
          <input
              type="text"
              class="form-control"
              name="phone"
              id="phone"
              placeholder="12977884499"
              maxlength="11"
              required
              />
        </div>
        <div class="mb-2">
          <label for="facebook" class="form-label">Facebook</label>
          <input
              type="text"
              class="form-control"
              name="facebook"
              id="facebook"
              placeholder="https://web.facebook.com/zuck"
              />
        </div>
        <div class="mb-2">
          <label for="instagram" class="form-label">Instagram</label>
          <input
              type="text"
              class="form-control"
              name="instagram"
              id="instagram"
              placeholder="https://www.instagram.com/zuck/"
              />
        </div>
        <div class="mb-2">
          <label for="twitter" class="form-label">Twitter</label>
          <input
              type="text"
              class="form-control"
              name="twitter"
              id="twitter"
              placeholder="https://twitter.com/elonmusk"
              />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <h4 class="fw-bold">Galeria</h4>
        <div class="d-flex gap-2">
          <input
              type="file"
              id="pics"
              name="gallery_pictures[]"
              class="form-control"
              multiple
              onchange="handleFileInput(event)"
              >
              <button
                  class="btn btn-light"
                  onclick="resetControl(event, '#pics')"
                  type="button"
                  id="reset-file-input"
                  disabled
                  >
                  Limpar
              </button>
        </div>
        <div id="img-preview" class="d-flex flex-wrap gap-2 mt-2">
        </div>
      </div>
      <div class="col-6">
        <h4 class="fw-bold">Localização</h4>
        <div class="mb-2">
          <label for="city" class="form-label">Cidade*</label>
          <input
              type="text"
              class="form-control"
              name="city"
              id="city"
              placeholder="Taubaté"
              required
              />
        </div>
        <div class="mb-2">
          <label for="neighborhood" class="form-label">Bairro</label>
          <input
              type="text"
              class="form-control"
              name="neighborhood"
              id="neighborhood"
              placeholder="Gurilândia"
              />
        </div>
        <div class="mb-2 row">
          <div class="col-10">
            <label for="street" class="form-label">Endereço</label>
            <input
                type="text"
                class="form-control"
                name="street"
                id="street"
                placeholder="Av. Charles Schnider"
                />
          </div>
          <div class="col-2">
            <label for="number" class="form-label">Número</label>
            <input
                type="text"
                class="form-control"
                name="number"
                id="number"
                placeholder="..."
                />
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-end my-2 gap-2">
      <a href="/admin" class="btn"> Voltar </a>
      <button type="submit" class="btn btn-success">Salvar</button>
    </div>
  </form>
</div>
@endsection
