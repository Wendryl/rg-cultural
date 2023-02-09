@extends('admin-dashboard/dashboard-base')
@section('search_form_action')
  /admin
@endsection
@section('search_placeholder')
  Buscar usuário
@endsection
@section('body')
@push('scripts')
<script src="{{ asset('js/admin-dashboard/index.js') }}"></script>
@endpush
<div class="table-responsive">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6">
          <h2>Gerenciar <b>Usuários</b></h2>
        </div>
        <div class="col-sm-6">
          <a href="/new-user" class="btn btn-success d-flex justify-content-center align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
            </svg>
            <span>
              Adicionar nova usuário
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
          <th>Nome</th>
          <th>E-mail</th>
          <th>Endereço</th>
          <th>Telefone</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody id="list">
        @foreach($users as $user)
          @if ($user->id == Auth::user()->id)
            @break
          @endif
          <tr>
            <td>{{ $user->id }}</td>
            <td>
              <img src="{{ $user->profile_picture ?? '/img/profile.png' }}" class="profile-thumb">
            </td>
            <td>{{ $user->name }}</td>
            <td>
              <a href="mailto:{{ $user->email }}" target="_blank">
                {{ $user->email }}
              </a>
            </td>
            <td>{{ $user->street ?? 'N/A' }}</td>
            <td>
              @if($user->phone != null)
                <a href="tel:{{ $user->phone }}">
                  {{ $user->phone }}
                </a>
              @else
                N/A
              @endif
            </td>
            <td>
              <div class="d-flex">
                <a class="btn btn-sm btn-warning" href="/edit-user/{{ $user->id }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#ffffff" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M5.433 13.916l1.262-3.154a4 4 0 01.885-1.343L14.5 2.5a2.121 2.121 0 113 3l-6.92 6.919c-.383.383-.84.684-1.343.885l-3.154 1.262a.5.5 0 01-.65-.65zM2.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H3.75A2.75 2.75 0 001 5.75v10.5A2.75 2.75 0 003.75 19h10.5A2.75 2.75 0 0017 16.25V10a.75.75 0 00-1.5 0v6.25c0 .69-.56 1.25-1.25 1.25H3.75c-.69 0-1.25-.56-1.25-1.25V5.75z" clip-rule="evenodd" />
                  </svg>
                </a>
                <button class="ms-1 btn btn-sm btn-danger" onclick="deleteUser({{ json_encode($user) }})" {{ $user->type == 1 ? 'disabled': '' }}>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#ffffff" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="clearfix">
      <div class="hint-text">Mostrando <b>{{ $users->count() }}</b> de <b>{{ $users->total() }}</b> registros</div>
      <ul class="pagination">
        <li class="page-item disabled"><a href="{{ $users->previousPageUrl() }}">Anterior</a></li>
        <li class="page-item active"><a href="javascript:void(0)" class="page-link">{{ $users->currentPage() }}</a></li>
        <li class="page-item"><a href="{{ $users->nextPageUrl() }}" class="page-link">Próxima</a></li>
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
