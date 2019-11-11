<?php 
require_once '../assets/helpers.php';
require_once '../controller/IndexController.php';
$controller->notAdmin();
require_once ($controller->importHeader($_SESSION['admin']));
?>

    <section class="container-fluid">
        <p><h3><u>Bem vindo <?php echo $_SESSION['name'] ?></u></h3></p><br>
        <h1 class="display-4">Relatórios</h1>
	<?php 
	echo $controller->listGroup();
	?>
    </section>

    <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container pb-5 mb-5">
    </div>
<?php
require_once 'template/footer.php';
require_once 'template/delete_candidate_modal.php';
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>