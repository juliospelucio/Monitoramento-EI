<?php 
require_once '../assets/helpers.php';
require_once '../controller/ClassroomController.php';
$controller->isAdmin();
require_once ($controller->importHeader($_SESSION['admin']));
?>
	<section class="container text-center">
	    <h1 class="mb-5">Cadastrar Turma</h1>
	    <form action="../controller/ClassroomController.php" method="post" class="was-validated">
	        <div class="row my-md-2 justify-content-center"> 
	            <div class="col-md-10 col-sm-12">
	            	<div class="input-group mb-2">
					  	<div class="input-group-prepend">
					  		<span class="input-group-text" id="basic-addon-description">Descrição</span>
						</div>
						<input type="text" required class="form-control" id="description" name="description" aria-descriptionribedby="basic-addon-description" autofocus>                    
					</div> 
	            </div>
			</div>

			<div class="row my-md-2 mt-5 justify-content-center">
	            <div class="form-group col-md-5 col-sm-6">
	               <label class="sr-only" for="insert">Inserir</label>
	               <button type="submit" class="btn btn-outline-success btn-block" id="insert" name="insert">Inserir</button>
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