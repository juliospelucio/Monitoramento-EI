<?php 

/*DATA-LOAD FOR HUGE AMOUNTS OF DATA, DATATABLES
https://datatables.net/extensions/scroller/examples/initialisation/server-side_processing.html*/


/* Script para redirecionar a página index na view */
//header('location:view/frontend/index.php');

require_once $_SERVER['DOCUMENT_ROOT']."/Controle-Infantil/assets/helpers.php";

require_once abspath().'/controller/manage_candidate.php';
require_once abspath().'/view/template/frontend/header.php';
// $rows = loadAllCandidates();
// validateSession();
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid">
            <p><h3><u>Bem vindo <?php echo $_SESSION['name'] ?></u></h3></p><br>
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
                    <?php //foreach ($rows as $row => $column): ?>
                    <tr>
                        <td scope="row" class="text-center"><a href="edit_candidate.php?id=<?php //echo $column->id ?>"><img src="../assets/img/edit.png" width="30" height="30"></a></td>
                        <td scope="row" class="text-center"><?php //echo dateDifference(date("Y")."-02-31", $column->birth,'%y') ?></td>
                        <td scope="row" class="text-center"><?php //echo $column->name ?></td>
                        <td scope="row" class="text-center"><?php //echo stringToDate($column->inscription) ?></td>
                        <td scope="row" class="text-center"><?php //echo stringToDate($column->birth) ?></td>
                        <td scope="row" class="text-center"><?php //echo $column->mother ?></td>
                        <td scope="row" class="text-center"><?php //echo $column->situation ?></td>
                        <td scope="row" class="text-center">
                            <a href="#" data-href="delete_candidate.php?id=<?php //echo $column->id ?>" data-toggle="modal" data-target="#confirm-delete"><img src="../assets/img/delete.png" width="30" height="30"></a>
                        </td>
                    </tr>
                    <?php //endforeach ?>
                </tbody>
            </table>
        </section>
    </div>
    <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container p-5 m-2">
    </div>

<?php
require_once abspath().'/view/template/frontend/footer.php';
require_once abspath().'/view/template/frontend/delete_candidate_modal.php';
?>
<script type="text/javascript">
    datatableApplyIndex();
    $('.dropdown-toggle').dropdown()
</script>
<?php if (isset($_SESSION['data']))triggerModal() ?>