<?php 
require_once '../assets/helpers.php';
require_once '../controller/LoginController.php';
// $controller->filename = basename(__FILE__);
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="icon" href="../assets/img/favicon.png">

    <title>Monitoramento de Vagas da Educação Infantil</title>

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
  
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../assets/css/sign.css">
    
  </head>
  
  <body class="text-center">
      <form class="form-signin" action="../controller/LoginController.php" method="post">
        <img class="mt-2" src="../assets/img/brasão.png" alt="brasão" width="270" height="270" class="img-fluid" title="Monitoramento de Vagas da Educação Infantil" data-toggle="tooltip" data-placement="bottom" alt="Brasão do município de Machado">
        <h1 class="h3 mb-3">Login</h1>  
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus name="email">
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Senha" name="password">
        <button type="submit" class="btn btn-lg btn-color btn-block" name="signed">Acessar</button>
        <div class="alert alert-info my-2" role="alert">
            <a href="password_retrieve.php" class="alert-link"><u>Esqueci minha senha</u></a>
        </div>
        <p class="text-muted">Secretaria Municipal de Educação<br>Machado/MG &copy; 2019</p>
      </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- Bootstrap core JavaScript -->
    <script src="../assets/js/jquery-3.3.1.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bootstrap-toggle.min.js"></script>
    <script src="../assets/js/functions.js"></script>
        <?php if (isset($_SESSION['data']))triggerModal() ?>
  </body>
</html>