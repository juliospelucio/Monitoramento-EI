 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Atualizar Senha</h4>
            </div>
            <form action="../controller/edit_user.php" method="post">
                <div class="modal-body text-center">
                    <input type="hidden" id="id_psw" name="id_psw" value="<?php echo $user->id ?>">
                    <input class="form-control mt-md-2 mt-ms-2" type="password" placeholder="Senha Atual" id="psw-now" name="psw-now" required>
                    <input class="form-control mt-md-2 mt-ms-2" type="password" placeholder="Nova Senha" id="psw-new" name="psw-new" required>
                    <input class="form-control mt-md-2 mt-ms-2" type="password" placeholder="Confirmar Senha" id="psw-conf" name="psw-conf" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="psw" autofocus>Atualizar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>