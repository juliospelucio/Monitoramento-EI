<?php 
require_once '../assets/helpers.php';
require_once '../controller/UnitController.php';
require_once 'template/header.php';
$controller->filename = basename(__FILE__);
?>

<!-- Page Content -->
	<div class="container">
        <div id="page-content-wrapper">
            <section class="container-fluid text-center">
                <h1 class="mb-5">Cadastrar Unidade</h1>
                <form action="../controller/UnitController.php" method="post" class="was-validated">
	                <div class="row my-md-2"> 
	                    <div class="col-md-6 col-sm-12">
	                    	<div class="input-group mb-md-3 mb-sm-1">
							  	<div class="input-group-prepend">
							  		<span class="input-group-text" id="basic-addon-name">Nome da Unidade</span>
								</div>
								<input type="text" required class="form-control" id="name" name="name" aria-describedby="basic-addon-name">
								<div class="invalid-feedback">
					          		Por favor escolha um nome válido.
						        </div>	                    
							</div> 
	                    </div>
	                    <div class="col-md-6 col-sm-12">
	                    	<div class="input-group mb-md-3 mb-sm-1">
							  	<div class="input-group-prepend">
							    	<span class="input-group-text" id="basic-addon-users_id">Responsável pela Unidade</span>
							  	</div>
							  	<select class="custom-select" id="users_id" name="users_id" aria-describedby="basic-addon-users_id">
						  			<?php foreach ($directors as $director): ?>
									<option <?php echo "value=".$director['id'] ?>>
										<?php echo $director['name'] ?>
									</option>
						  			<?php endforeach ?>
						  		</select>
							</div>                      
	                    </div>
					</div>

					<div class="row my-md-2 justify-content-around mt-5">
	                    <div class="form-group col-md-6 col-sm-6">
	                       <label class="sr-only" for="insert">Inserir</label>
	                       <button type="submit" class="btn btn-outline-success btn-block" id="insert" name="insert">Inserir</button>
	                    </div>
	                    <div class="form-group col-md-6 col-sm-6">
	                       <label class="sr-only" for="cancel">Cancelar</label>
	                       <a href="units.php" class="btn btn-outline-secondary btn-block" id="cancel" name="cancel">Cancelar</a>
	                    </div>
	                </div>            
                </form>
            </section>
        </div>
    </div>
<!-- /#page-content-wrapper -->

 <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container p-5 m-2">
    </div>
<?php require_once 'template/footer.php'; ?>