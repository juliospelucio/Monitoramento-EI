<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-danger rounded">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $_SESSION['data']['type'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo "<h5>" .$_SESSION['data']['msg']." </h5>" ?>
      </div>
    </div>
  </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://localhost/meusite/assets/js/jquery-3.3.1.js"></script>
<script src="http://localhost/meusite/assets/js/bootstrap.bundle.min.js"></script>
<script>$('#exampleModal').modal('show');</script>