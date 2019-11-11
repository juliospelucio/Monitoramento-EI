<?php 
require_once '../assets/helpers.php';
require_once '../controller/ClassroomController.php';
$controller->isAdmin();
require_once ($controller->importHeader($_SESSION['admin']));
?>
    <section class="container text-center">
        <h1 class="mb-5">Editar Turma</h1>
        <form action="../controller/ClassroomController.php" method="post" class="was-validated">
            <div class="row my-md-2 justify-content-center"> 
                <div class="col-md-6 col-sm-12">
                	<div class="input-group mb-md-3 mb-sm-1">
					  	<div class="input-group-prepend">
					  		<span class="input-group-text" id="basic-addon-description">Descrição</span>
						</div>
						<input type="text" required class="form-control" id="description" name="description" aria-describedby="basic-addon-description" value="<?php echo $classroom['description'] ?>" autofocus>
						<div class="invalid-feedback">
			          		Por favor escolha um nome válido.
				        </div>	                    
					</div> 
                </div>
			</div>
            <input type="hidden" id="id" name="id" value="<?php echo $classroom['id'] ?>">
            <input type="hidden" id="units_id" name="units_id" value="<?php echo $classroom['units_id'] ?>">
			<div class="row my-md-2 justify-content-around mt-5">
                <div class="form-group col-md-5 col-sm-6">
                   <label class="sr-only" for="insert">Editar</label>
                   <button type="submit" class="btn btn-outline-success btn-block" id="edit" name="edit">Editar</button>
                </div>
                <div class="form-group col-md-5 col-sm-6">
                   <label class="sr-only" for="cancel">Cancelar</label>
                   <a href="classrooms.php" class="btn btn-outline-secondary btn-block" id="cancel" name="cancel">Cancelar</a>
                </div>
            </div>            
        </form>
    </section>
 	<!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container pb-5 mb-5">
    </div>
<?php require_once 'template/footer.php'; ?>