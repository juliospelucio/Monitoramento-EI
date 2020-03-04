<?php 
require_once '../assets/helpers.php';
require_once '../controller/UserController.php';
$controller->notAdmin();
require_once ($controller->importHeader($_SESSION['admin']));
?>
    <section class="container-fluid">
        <div class="row justify-content-around"> 
            <div class="col-03 align-self-center">
                <p><h3><u>Usuários Cadastrados</u></h3></p>
            </div>
            <div class="col-09">
                <a href="new_user.php"><img src="../assets/img/add.png" width="100" height="100" title="Adicionar Usuário"></a>
            </div>
        </div>
        <table id="table_id" class="display table table-bordered table-hover">
            <thead>
                <!-- 15306 default column size javascrip file  -->
                <tr>
                    <th scope="col" class="text-center">Editar</th>
                    <th scope="col" class="text-center">Nome</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Apagar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row => $column): ?>
                <tr>
                    <td scope="row" class="text-center"><a href="edit_user.php?id=<?php echo $column['id'] ?>"><img src="../assets/img/edit.png" width="30" height="30" title="Editar Usuário"></a></td>
                    <td scope="row" class="text-center"><?php echo $column['name'] ?></td>
                    <td scope="row" class="text-center"><?php echo $column['email'] ?></td>
                    <td scope="row" class="text-center">
                        <a href="#" data-toggle="modal" data-target="#confirm-delete" onclick="modalHref(this)">
                            <img src="../assets/img/delete.png" width="30" height="30" title="Apagar Usuário">
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
    <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container pb-5 mb-5">
    </div>

<?php
require_once 'template/footer.php';
require_once 'template/delete_user_modal.php';
?>
<script type="text/javascript">
    datatableApplyUsers();
    $('.dropdown-toggle').dropdown()
</script>
<?php if (isset($_SESSION['data']))triggerModal() ?>