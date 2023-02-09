@extends('admin-dashboard/dashboard-base')
@section('body')
@push('scripts')
<script src="{{ asset('js/admin-dashboard/index.js') }}"></script>
@endpush
<div class="table-responsive">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6">
          <h2>Gerenciar <b>Postagens</b></h2>
        </div>
        <div class="col-sm-6">
          <a href="/new-user" class="btn btn-success d-flex justify-content-center align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
            </svg>
            <span>
              Adicionar nova postagem
            </span>
          </a>
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th></th>
          <th>Título</th>
          <th>Autor</th>
          <th>Endereço</th>
          <th>Telefone</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody id="list">
      </tbody>
    </table>
    <div class="clearfix">
      <div class="hint-text">Mostrando <b>{{ $posts->count() }}</b> de <b>{{ $posts->total() }}</b> registros</div>
      <ul class="pagination">
        <li class="page-item disabled"><a href="{{ $posts->previousPageUrl() }}">Anterior</a></li>
        <li class="page-item active"><a href="javascript:void(0)" class="page-link">{{ $posts->currentPage() }}</a></li>
        <li class="page-item"><a href="{{ $posts->nextPageUrl() }}" class="page-link">Próxima</a></li>
      </ul>
    </div>
  </div>
</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteUserModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h4 class="modal-title">Deletar usuário</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="confirm-message"></p>
          <p class="text-danger"><small>Esta ação não pode ser desfeita</small></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
          <input type="submit" class="btn btn-danger" value="Deletar">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
