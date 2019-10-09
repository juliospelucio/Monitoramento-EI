<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, all">
    <meta name="Description" content="Sistema: Monitoramento de Vagas da Educação Infantil do Município de Machado">
    <meta name="googlebot" content="MVEI, Author: Júlio Pelúcio">

    <link rel="icon" href="../assets/img/brasao-favicon.png">

    <title>Monitoramento de Vagas da Educação Infantil</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  
    <!-- Datatables  CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap4.css"/>
    
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top row">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img class="img-fluid" src="../assets/img/MVEI-icon.png" alt="Logo Sistema MVEI">
        </a>
        <a href="index.php" class="decoClear h5"><span class="text-uppercase d-none d-md-block">Monitoramento de Vagas da<br>Educação Infantil</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav ml-auto bareffect">
            <li class="position-relative">
              <a class="nav-link" href="index.php">Início</a>
            </li>
            <li class="position-relative">
              <a class="nav-link" href="categories.php?search=1">Categorias</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkGerenciar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gerenciar</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkGerenciar">
                <a class="dropdown-item" href="candidates.php">Candidato</a>
                <a class="dropdown-item" href="units.php">Unidade</a>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkUser">
                <a class="dropdown-item" href="update_user.php?update=1">Meus dados</a>
                <a class="dropdown-item" href="export.php">Exportar</a>
                <a class="dropdown-item" href="users.php">Usuários</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../controller/LoginController.php?logoff=1">Sair</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- Navigation end -->