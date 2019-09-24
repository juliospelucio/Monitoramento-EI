<?php 
require_once '../assets/helpers.php';
require_once '../controller/ExportController.php';
$controller->notAdmin();
require_once 'template/header.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid text-center">
            <h1 class="display-4 mt-5" id='toolTip' tabindex='0' data-toggle='tooltip' title="Exportar candidatos com base na data de inscrição." style='cursor: help;'>Exportar</h1>
            <form class="form-inline d-flex p-1 justify-content-center" action="export.php" method="post">
                <div class="mt-5">
                    <label class="sr-only" for="insc-date">Data de Inscrição</label>
                    <input type="number" min="2010" class="form-control mb-2 mr-sm-2" id="insc-date" name="insc-date" placeholder="Ano de Inscrição" name="insc-date" required>
                    <button type="submit" class="btn btn-outline-success ml-3 mb-2" name="export" value="export">Exportar</button>
                </div>
            </form>
        </section>
    </div>

    <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container p-5 m-2">
    </div>

<?php
require_once 'template/footer.php';
?>
<script type="text/javascript">
    $('#toolTip').tooltip();
</script>