<?php 

/*DATA-LOAD FOR HUGE AMOUNTS OF DATA, DATATABLES
https://datatables.net/extensions/scroller/examples/initialisation/server-side_processing.html*/

require_once $_SERVER['DOCUMENT_ROOT']."/Monitoramento-EI/assets/helpers.php";

require_once '../controller/CandidateController.php';
require_once 'template/header.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid">
            <div class="row justify-content-around"> 
                <div class="col-03">
                    <p><h3><u>Usuários Cadastrados</u></h3></p>
                </div>
                <div class="col-09">
                    <a href="new_candidate.php"><img src="../assets/img/add.png" width="100" height="100"></a>
                </div>
            </div>
            <br>
            <table id="table_id" class="display table table-bordered table-hover">
                <thead>
                    <!-- 15306 default column size javascrip file  -->
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
                        <td scope="row" class="text-center">
                            <a href="edit_candidate.php?id=<?php echo $column['id'] ?>"><img src="../assets/img/edit.png" width="30" height="30"></a>
                        </td>
                        <td scope="row" class="text-center"><?php echo dateDifference(date("Y")."-02-31", $column['birth_date'],'%y') ?></td>
                        <td scope="row" class="text-center"><?php echo $column['name'] ?></td>
                        <td scope="row" class="text-center"><?php echo stringToDate($column['inscription_date']) ?></td>
                        <td scope="row" class="text-center"><?php echo stringToDate($column['birth_date']) ?></td>
                        <td scope="row" class="text-center"><?php echo $column['mother'] ?></td>
                        <td scope="row" class="text-center"><?php echo $controller->getSituation($column['situation']) ?></td>
                        <td scope="row" class="text-center">
                            <a href="../controller/CandidateController.php?id=<?php echo $column['id'] ?>&delete=1"><img src="../assets/img/delete.png" width="30" height="30"></a>
                            <!-- <a href="#" data-href="CandidateController.php?id=<?php echo $column['id'] ?>" title="Apagar" data-toggle="modal" data-target="#confirm-delete"><img src="../assets/img/delete.png" width="30" height="30"></a> -->
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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