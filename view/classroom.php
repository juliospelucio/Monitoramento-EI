<?php 
require_once '../assets/helpers.php';
require_once '../controller/ClassroomController.php';
$controller->isAdmin();
require_once ($controller->importHeader($_SESSION['admin']));
?>

<!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">
        <section class="container-fluid text-center"> 
                
            <p class="align-self-center"><h3><u><?php echo $_GET['desc'] ?></u></h3></p>
                
            <div class="row justify-content-center">
                <div class="col col-md-2 my-2">
                        <a class="btn btn-outline-success btn-block" href="../view/edit_classroom.php?id=<?php echo $_GET['clid'] ?>" role="button">Editar Turma</a>
                </div>
                <div class="col col-md-2 my-2">
                    <a id="btndelete" class="btn btn-outline-danger btn-block" href="../controller/CandidateController.php?id=<?php echo $_GET['clid'] ?>&delete=1"  data-href="../controller/ClassroomController.php?id=<?php echo $_GET['clid'] ?>&delete=1" data-toggle="modal" data-target="#confirm-delete" onclick="modalHref(this)" role="button">Apagar Turma</a>
                </div>
            </div>
            <table id="table_id" class="display table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center align-middle">N°</th>
                        <th scope="col" class="text-center align-middle">Idade</th>
                        <th scope="col" class="text-center align-middle">Nome</th>
                        <th scope="col" class="text-center align-middle">Data de Matrícula</th>
                        <th scope="col" class="text-center align-middle">Data de Saída</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0;  foreach ($classrooms as $classroom => $column): $i++;?>            
                        <tr class="custom-anchor" data-href="<?php echo $column['id'] ?>" onclick="candidateData(this)" title="Ir para Candidato">
                            <td scope="row" class="text-center"><?php echo $i ?></td>
                            <td scope="row" class="text-center"><?php echo dateDifference(date("Y-m-d"), $column['birth_date'],'%y') ?></td>
                            <td scope="row" class="text-center"><?php echo $column['name'] ?></td>
                            <td scope="row" class="text-center">INSERIR</td>
                            <td scope="row" class="text-center">INSERIR</td>
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
    datatableApplyStudents();
    $('#toolTip').tooltip();
</script>
<?php if (isset($_SESSION['data']))triggerModal() ?>