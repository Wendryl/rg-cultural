<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RG Cultural | Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard/index.css')}}">
    @stack('styles')
  </head>
  <body>
    <div class="container-xl">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/admin">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/posts">Posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
              </li>
            </ul>
            <form class="d-flex" role="search" action="@yield('search_form_action')">
              <input class="form-control me-2" type="search" name="s" placeholder="@yield('search_placeholder')" aria-label="@yield('search_placeholder')">
              <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
            </form>
          </div>
        </div>
      </nav>
      @if (session('error'))
        <div class="alert alert-danger my-2">
          {{ session('error') }}
        </div>
      @endif
      @if (session('message'))
        <div class="alert alert-success my-2">
          {{ session('message') }}
        </div>
      @endif
      @yield('body')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
  </body>
</html>
