<?php 
require_once '../assets/helpers.php';
require_once '../controller/ClassroomController.php';
$controller->isAdmin();
require_once 'template/header_dir.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">
        <section class="container-fluid">
            <div class="row justify-content-around"> 
                <div class="col-03 align-self-center">
                    <p><h3><u>Salas Cadastradas</u></h3></p>
                </div>
                <div class="col-09">
                    <a href="new_classroom.php"><img src="../assets/img/add.png" width="100" height="100"></a>
                </div>
            </div>
            <table id="table_id" class="display table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center align-middle">Editar</th>
                        <th scope="col" class="text-center align-middle">Turma</th>
                        <th scope="col" class="text-center align-middle">N° de Alunos</th>
                        <th scope="col" class="text-center align-middle">Apagar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row => $column):?>            
                        <tr>
                            <td scope="row" class="text-center">
                                <a href="edit_classroom.php?id=<?php echo $column['id'] ?>"><img src="../assets/img/edit.png" width="30" height="30" title="Editar Turma"></a>
                            </td>
                            <td scope="row" class="text-center"><?php echo $column['description'] ?></td>
                            <td scope="row" class="text-center">Número de Alunos</td>
                            <td scope="row" class="text-center">
                                <a href="#" data-href="../controller/ClassroomController.php?id=<?php echo $column['id'] ?>&delete=1" data-toggle="modal" data-target="#confirm-delete" onclick="modalHref(this)"><img src="../assets/img/delete.png" width="30" height="30" title="Apagar Turma"></a>
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
require_once 'template/delete_classroom_modal.php';
?>
<script type="text/javascript">
    datatableApplyClassrooms();
</script>
<?php if (isset($_SESSION['data']))triggerModal() ?>