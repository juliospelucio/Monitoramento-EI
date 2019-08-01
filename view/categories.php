<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/Monitoramento-EI/assets/helpers.php";

require_once '../controller/CandidateController.php';
require_once 'template/header.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid text-center">
            <h1 class="mb-5">Infantil</h1>
            <form action="../controller/categories.php" method="get">
                <div class="row my-md-3 my-sm-5 justify-content-around">
                    <div class="col-md-3 col-sm-12">
                        <div class="input-group my-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon-I">Infantil</span>
                            </div>
                            <select class="custom-select" required id="inf" name="inf" aria-describedby="basic-addon-inf">
                                <option value='I' selected>1</option>
                                <option value='II'>2</option>
                                <option value='III'>3</option>
                                <option value='IV'>4</option>
                                <option value='V'>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="input-group my-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon-date">Data de Corte</span>
                            </div>
                            <input type="date" required class="form-control" id="date" name="date" aria-describedby="basic-addon-date">
                        </div>                      
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                       <label class="sr-only" for="search">Buscar</label>
                       <button type="submit" class="btn btn-outline-success btn-block" id="search" name="search">Enviar</button>
                    </div>
                </div>
            </form>
            <!-- <table id="table_id" class="display table table-bordered table-hover">
                <thead>
                   
                    <tr id="theader">
                        <th scope="col" class="text-center">Editar</th>
                        <th scope="col" class="text-center">Idade</th>
                        <th scope="col" class="text-center">Nome</th>
                        <th scope="col" class="text-center">Data do Casdastro</th>
                        <th scope="col" class="text-center">Data de Nascimento</th>
                        <th scope="col" class="text-center">Mãe</th>
                        <th scope="col" class="text-center">Situação</th>
                        <th scope="col" class="text-center">Apagar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row => $column): ?>
                    <tr>
                        <td scope="row" class="text-center"><a href="edit_candidate.php?id=<?php echo $column->id ?>"><img src="../assets/img/edit.png" width="30" height="30"></a></td>
                        <td scope="row" class="text-center"><?php echo dateDifference(date("Y")."-02-31", $column->birth,'%y') ?></td>
                        <td scope="row" class="text-center"><?php echo $column->name ?></td>
                        <td scope="row" class="text-center"><?php echo stringToDate($column->inscription) ?></td>
                        <td scope="row" class="text-center"><?php echo stringToDate($column->birth) ?></td>
                        <td scope="row" class="text-center"><?php echo $column->mother ?></td>
                        <td scope="row" class="text-center"><?php echo $column->situation ?></td>
                        <td scope="row" class="text-center">
                            <a href="#" data-href="delete_candidate.php?id=<?php echo $column->id ?>" data-toggle="modal" data-target="#confirm-delete"><img src="../assets/img/delete.png" width="30" height="30"></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table> -->
        </section>
    </div>
    <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container p-5 m-2">
    </div>
<?php
require_once 'template/footer.php';
require_once 'template/delete_candidate_modal.php';
?>
<script type="text/javascript">
    datatableApplyIndex();
    $('.dropdown-toggle').dropdown()
</script>
<?php if (isset($_SESSION['data']))triggerModal() ?>