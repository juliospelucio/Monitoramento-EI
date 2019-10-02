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
            <?php foreach ($rows as $row => $column): ?>
            
            <form class="border border-dark rounded p-1 mb-1 text-center text-lg-left">
                <input type="hidden" id="cid" name="cid" value="<?php echo $column['cid'] ?>">
                <div class="form-row mt-3">
                    <div class="col-md-3 col-sm mb-2">
                        <label class="sr-only" for="name">Nome</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Nome</div>
                            </div>
                            <input type="text" class="form-control" id="name" value="<?php echo $column['cname'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm mb-2">
                        <label class="sr-only" for="birth">Nascimento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Nascimento</div>
                            </div>
                            <input type="text" class="form-control" id="birth" value="<?php echo stringToDate($column['birth_date']) ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm mb-2">
                        <label class="sr-only" for="age">Idade</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Idade</div>
                            </div>
                            <input type="text" class="form-control" id="age" value="<?php echo dateDifference(date("Y-m-d"), $column['birth_date'],'%y') ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm mb-2">    
                        <label class="sr-only" for="class">Salas</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Salas</div>
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
                        <button type="submit" class="btn btn-outline-danger mr-2">Dessistir</button>
                        <a href="candidate_data.php?id=<?php echo $column['cid'] ?>" class="btn btn-outline-secondary" role="button">Detalhes</a>
                    </div>
                </div>
            </form>
            <?php endforeach ?>       
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