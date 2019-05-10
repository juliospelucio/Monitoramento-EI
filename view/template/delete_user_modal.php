 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>Deseja realmente excluir o usuário?</h4>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok" href="../controller/delete_user.php?id=<?php echo $column->id ?>" autofocus>Apagar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>