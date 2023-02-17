@extends('admin-dashboard/dashboard-base')
@section('body')
@push('scripts')
  <script src="{{ asset('js/admin-dashboard/new-post.js') }}"></script>
@endpush
@push('styles')
@endpush
<div class="row page-title mx-0">
  <div class="col-sm-6">
    <h2>Nova <b>Postagem</b></h2>
  </div>
</div>
<div class="bg-white p-3 mb-3">
  <form action="/new-post" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <!-- <div class="col-6"> -->
      <!--   <h4 class="fw-bold">Banner</h4> TODO - Remover banner pois as imagens provavelmente serão utilizadas dentro do conteúdo da postagem -->
      <!--   <div class="d-flex gap-2"> -->
      <!--     <input -->
      <!--         type="file" -->
      <!--         id="pics" -->
      <!--         name="banner" -->
      <!--         class="form-control" -->
      <!--         multiple -->
      <!--         onchange="handleFileInput(event)" -->
      <!--         > -->
      <!--         <button -->
      <!--             class="btn btn-light" -->
      <!--             onclick="resetControl(event, '#pics')" -->
      <!--             type="button" -->
      <!--             id="reset-file-input" -->
      <!--             disabled -->
      <!--             > -->
      <!--             Limpar -->
      <!--         </button> -->
      <!--   </div> -->
        <!-- <div id="img-preview" class="d-flex flex-wrap gap-2 mt-2"> -->
        <!-- </div> -->
      </div>
      <div class="col-12">
        <h4 class="fw-bold">Informações da postagem</h4>
        <div class="mb-2">
          <label for="city" class="form-label">Título*</label>
          <input
              type="text"
              class="form-control"
              name="city"
              id="city"
              placeholder="Como a educação influencia a cultura..."
              required
              />
        </div>
        <div class="mb-2">
          <label for="city" class="form-label">Conteúdo*</label>
          <div id="editor">
            <div id="toolbar"></div>
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
