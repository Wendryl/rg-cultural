@extends('admin-dashboard/dashboard-base') @section('body')
<div class="row page-title mx-0">
  <div class="col-sm-6">
    <h2>Novo <b>Usuário</b></h2>
  </div>
</div>
<div class="bg-white p-3">
  <form>
    <div class="row mb-2">
      <div class="col-6">
        <h4>Informações pessoais</h4>
        <div>
          <div class="d-flex gap-4 align-items-center">
            <img src="/img/profile.png" />
            <div class="d-flex flex-column w-100">
              <div class="mb-2">
                <label for="name" class="form-label"
                                  >Nome*</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    placeholder="John Doe"
                                    />
              </div>
                  <div>
                    <label for="email" class="form-label"
                                       >Email*</label
                                     >
                                     <input
                                         type="email"
                                         class="form-control"
                                         name="email"
                                         id="email"
                                         placeholder="johndoe@email.com"
                                         />
                  </div>
            </div>
          </div>
          <div class="my-3">
            <label for="categories" class="form-label"
                                    >Categorias</label
                                  >
                                  <select class="form-select" name="categories" id="categories">
                                    <option selected>Selecione as categorias</option>
                                    <option value="1">Música</option>
                                    <option value="2">Padaria</option>
                                    <option value="3">Morcego</option>
                                  </select>
          </div>
        </div>
      </div>
      <div class="col-6">
        <h4>Contato</h4>
        <div class="mb-2">
          <label for="phone" class="form-label">Telefone*</label>
          <input
              type="text"
              class="form-control"
              name="phone"
              id="phone"
              placeholder="12977884499"
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
        <h4>Galeria</h4>
        <div>TODO</div>
      </div>
      <div class="col-6">
        <h4>Localização</h4>
        <div class="mb-2">
          <label for="city" class="form-label">Cidade*</label>
          <input
              type="text"
              class="form-control"
              name="city"
              id="city"
              placeholder="Taubaté"
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
  </form>
</div>
@endsection
