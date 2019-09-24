<?php 
require_once '../assets/helpers.php';
require_once '../controller/HomeController.php';
$controller->isAdmin();
require_once 'template/header_dir.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid">
            <p><h3><u>Bem vindo <?php echo $_SESSION['name'] ?></u></h3></p><br>
            <h1 class="display-4">Alunos Pendentes</h1>
            <form>
                <div class="form-row mt-3">
                    <div class="col-md-3 col-sm mb-2">
                        <label class="sr-only" for="name">Nome</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><b>Nome</b></div>
                            </div>
                            <input type="text" class="form-control" id="name" value="Júlio dos Santos Pelúcio Pelúcio" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm mb-2">
                        <label class="sr-only" for="birth">Nascimento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><b>Nascimento</b></div>
                            </div>
                            <input type="text" class="form-control" id="birth" value="27/02/1996" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm mb-2">
                        <label class="sr-only" for="age">Idade</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><b>Idade</b></div>
                            </div>
                            <input type="text" class="form-control" id="age" value="23 anos" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm mb-2">    
                        <label class="sr-only" for="class">Salas</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><b>Salas</b></div>
                            </div>
                            <select class="custom-select" id="class" name="class">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="4">Four</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-auto col-sm mb-2">
                        <button type="submit" class="btn btn-outline-success mr-2">Matricular</button>
                        <button type="submit" class="btn btn-outline-danger">Dessistir</button>
                    </div>
                </div>
            </form>         
        </section>
    </div>

    <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container p-5 m-2">
    </div>

<?php
require_once 'template/footer.php';
require_once 'template/delete_candidate_modal.php';
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>