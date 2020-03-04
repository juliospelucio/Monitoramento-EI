<div class="modal fade" id="psw" tabindex="-1" role="dialog" aria-labelledby="Atualizar Senha" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 title="Updatepsw">Atualizar Senha</h4>
            </div>
            <form action="#" method="post">
                <div class="modal-body text-center">
                    <input type="hidden" id="uid" name="uid" value="<?php echo $user['id'] ?>">
                    <input type="hidden" id="id_psw" name="id_psw" value="<?php echo $user['password'] ?>">
                    <input class="form-control mb-2" type="password" placeholder="Senha Atual" id="psw_now" name="psw_now" required autofocus>
                    <input class="form-control mb-2" type="password" placeholder="Nova Senha" id="psw_new" name="psw_new" required>
                    <input class="form-control mb-2" type="password" placeholder="Confirmar Senha" id="psw_conf" name="psw_conf" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="psw">Atualizar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>  