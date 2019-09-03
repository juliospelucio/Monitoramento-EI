<?php 
require_once '../assets/helpers.php';

require_once '../controller/CandidateController.php';
require_once 'template/header.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">
        <section class="container-fluid">
            <div class="row justify-content-around"> 
                <div class="col-03 align-self-center">
                    <p><h3><u><span id='toolTip' tabindex='0' data-toggle='tooltip' title='A idade é baseada na data atual (<?php echo date("d-m-Y") ?>)' style='cursor: help;'>Candidatos Cadastrados</span></u></h3></p>
                </div>
                <div class="col-09">
                    <a href="new_candidate.php"><img src="../assets/img/add.png" width="100" height="100"></a>
                </div>
            </div>
            <table id="table_id" class="display table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center align-middle">N°</th>
                        <th scope="col" class="text-center align-middle">Idade</th>
                        <th scope="col" class="text-center align-middle">Nome</th>
                        <th scope="col" class="text-center align-middle">Mãe</th>
                        <th scope="col" class="text-center align-middle">Data de Nascimento</th>
                        <th scope="col" class="text-center align-middle">Situação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0;  foreach ($rows as $row => $column): $i++;?>            
                        <tr class="custom-anchor" data-href="<?php echo $column['id'] ?>" onclick="candidateData(this)" title="Editar Candidato">
                            <td scope="row" class="text-center"><?php echo $i ?></td>
                            <td scope="row" class="text-center"><?php echo dateDifference(date("Y-m-d"), $column['birth_date'],'%y') ?></td>
                            <td scope="row" class="text-center"><?php echo $column['name'] ?></td>
                            <td scope="row" class="text-center"><?php echo $column['mother'] ?></td>
                            <td scope="row" class="text-center"><?php echo stringToDate($column['birth_date']) ?></td>
                            <td scope="row" class="text-center"><?php echo $controller->getSituation($column['situation']) ?></td>
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
    datatableApplyCandidates();
    $('#toolTip').tooltip();
</script>
<?php if (isset($_SESSION['data']))triggerModal() ?>