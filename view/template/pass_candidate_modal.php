<div class="modal fade" id="pass" tabindex="-1" role="dialog" aria-labelledby="Desistencia" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 title="Motivo da Desistência">Motivo da desistência</h4>
            </div>
            <form action="../controller/HomeController.php" method="post">
                <div class="modal-body text-center">
                    <input type="hidden" id="cid" name="cid" value="<?php echo $column['cid'] ?>">
                    <textarea class="form-control" id="obs" name="obs" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="pass">Atualizar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>