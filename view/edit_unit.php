<?php 
require_once '../assets/helpers.php';
require_once '../controller/UnitController.php';
$controller->notAdmin();
require_once 'template/header.php';
// $controller->setFileName = basename(__FILE__);
?>

<!-- Page Content -->
	<div class="container">
        <div id="page-content-wrapper">
            <section class="container-fluid text-center">
                <h1 class="mb-5">Atualizar Dados</h1>
                <form action="../controller/UnitController.php" method="post" class="was-validated">
	                <div class="row my-md-2"> 
	                    <div class="col-md-6 col-sm-12">
	                    	<div class="input-group mb-md-3 mb-sm-1">
	                    		<div class="input-group-prepend">
							  		<span class="input-group-text" id="basic-addon-name">Nome da Unidade</span>
							  	</div>
							  	<?php foreach ($units as $user): ?>
							  	<input type="text" required class="form-control" id="name" name="name" aria-describedby="basic-addon-name" value="<?php echo $user['unname'] ?>">
							  	<div class="invalid-feedback">
					          		Por favor escolha um nome válido.
						        </div>	
							  	<?php endforeach ?>
							</div>                      
                                <input type="hidden" id="id" name="id" value="<?php echo $user['aid'] ?>">
	                    </div>
	                    <div class="col-md-6 col-sm-12">
	                    	<div class="input-group mb-md-3 mb-sm-1">
							  	<div class="input-group-prepend">
							    	<span class="input-group-text" id="basic-addon-users_id">Responsável pela Unidade</span>
							  	</div>
							  	<select class="custom-select" id="users_id" name="users_id" aria-describedby="basic-addon-users_id"><!-- ADICIONAR UM CAMPO DISABLE CASO NÃO HOUVER USUÁRIOS -->
						  			<?php foreach ($users as $user): ?>
									<option 
									<?php 
										echo "value='".$user['id']."'"; 
										if($units[0]['usid']==$user['id'])
											echo "selected" 
									?>>
									<?php echo $user['name'] ?>
									</option>
						  			<?php endforeach ?>
						  		</select>
							</div>                      
	                    </div>
					</div>

					<div class="row mt-md-5 justify-content-md-around">
	                    <div class="form-group col-md-6 col-sm-6">
	                       <label class="sr-only" for="edit">Editar</label>
	                       <button type="submit" class="btn btn-outline-success btn-block" id="edit" name="edit">Editar</button>
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

<?php
require_once 'template/footer.php';
require_once 'template/delete_candidate_modal.php';
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>