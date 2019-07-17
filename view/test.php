<?php 

/*DATA-LOAD FOR HUGE AMOUNTS OF DATA, DATATABLES
https://datatables.net/extensions/scroller/examples/initialisation/server-side_processing.html*/

require_once $_SERVER['DOCUMENT_ROOT']."/Monitoramento-EI/assets/helpers.php";

require_once '../controller/IndexController.php';
require_once 'template/header.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid">
            <p><h3><u>Bem vindo <?php echo $_SESSION['name'] ?></u></h3></p><br>
            


        <?php 

        $query = "UPDATE address SET ";
        $comma = " ";
        $params  = array('street' => "Rua teste", 'number' => 2, 'neighborhood' => "Bairro teste"); 
        foreach ($params as $key => $value) {
            $query.= $comma.$key." = :".$key;
            $comma = ", ";
        }

        echo "$query";
        ?>

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