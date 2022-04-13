<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
  </head>
  <body>
    <header>
      <nav class="navbar fixed-top navbar-light" style="background-color: #00bfff;">
        <a class="navbar-brand" href="index.php">
          <img src="Bandeira_de_Taubaté.png" alt="Bandeira de Taubaté" width="50" height="40">
          Início
        </a>
      </nav>
    </header>
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3" >
          <div class="card">
            <div class="card-body" style="background-color: #cbd9ea;">
              <h1>Cadastro Inicial</h1>
              <form id="form-contato">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input class="form-control" type="text" name="nome" id="nome" placeholder="Digite seu nome completo...">
                </div>

                <div class="form-group">
                  <label for="email">E-mail:</label>
                  <input class="form-control" type="email" name="email" id="email" placeholder="Digite seu e-mail...">
                  <div id="email" class="form-text">Este será seu usuário</div>
                </div>

                <div class="form-group">
                  <label for="senha">Senha:</label>
                  <input class="form-control" type="text" name="senha" id="senha" placeholder="Digite sua senha...">

                </div>

                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary">
                    <a href="cadastro.php">
                      Enviar
                  </button>
                    </a>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                </div>

                <div class="alert alert-danger d-none">
                  Preencha o campo
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="resources/js/formulario.js"></script>
  </body>
</html>