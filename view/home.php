<?php 
require_once '../assets/helpers.php';
require_once '../controller/HomeController.php';
$controller->isAdmin();
require_once ($controller->importHeader($_SESSION['admin']));
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid">
            <p><h3><u>Bem vindo <?php echo $_SESSION['name'] ?></u></h3></p><br>
            <h1 class="display-4">Alunos Pendentes</h1>
            <span id="demo" class="display-5"></span>

            <?php if (!$rows): ?>
            <h3 class="text-info"><u>Não há alunos encaminhados no momento!</u></h3>
            <?php endif ?>

            <?php foreach ($rows as $row => $column): ?>
            <form class="border border-dark rounded p-1 mb-1" action="../controller/HomeController.php" method="post">
                <div class="form-row mt-3 justify-content-around">
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
                        <label class="sr-only" for="class">Turmas</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Turmas</div>
                            </div>
                            <select class="custom-select" id="classrooms_id" name="classrooms_id" autofocus>
                                <option selected>Escolher...</option>
                                <?php foreach ($classrooms as $classroom): ?>
                                <option value="<?php echo $classroom['id'] ?>"><?php echo $classroom['description'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="cid" name="cid" value="<?php echo $column['cid'] ?>">
                    <div class="col-md-auto col-sm mb-2 text-center">
                        <button type="submit" class="btn btn-outline-success mr-2" name="conf">Matricular</button>
                        <!-- <button type="submit" class="btn btn-outline-danger mr-2" name="pass">Desistir</button> -->
                        <a href="#" data-id="<?php echo $column['cid'] ?>" data-obs="<?php echo $column['obs'] ?>" data-toggle="modal" data-target="#pass" class="btn btn-outline-danger mr-2" onclick="obsModal(this)">Desistir</a>
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
require_once 'template/pass_candidate_modal.php';
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>