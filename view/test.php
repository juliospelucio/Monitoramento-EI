<?php 

/*DATA-LOAD FOR HUGE AMOUNTS OF DATA, DATATABLES
https://datatables.net/extensions/scroller/examples/initialisation/server-side_processing.html*/

require_once '../assets/helpers.php';
require_once '../model/Candidate.php';
require_once '../model/settings.config.php';
require_once '../model/DBConnection.php';
require_once 'template/header.php';
?>

<!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%">
        <section class="container-fluid">
            <p><h3><u>Bem vindo </u></h3></p><br>
            <!-- <form method="get" action="#">
            <input type="number" required placeholder="AAAA" min="2014" max="2030" class="form-control">
                <input type="submit" name="submit">
            </form> -->


        <?php 

        $candidate = new Candidate($dbconfig);

        
        
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
    inputYear();
</script>
<?php if (isset($_SESSION['data']))triggerModal() ?>