 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="Deseja realmente excluir o candidato?" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 title="Apagar">Deseja realmente excluir o candidato?</h5>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok" href="../controller/CandidateController.php?id=<?php echo $column['id'] ?>" autofocus>Apagar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>