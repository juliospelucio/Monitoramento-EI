<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/Monitoramento-EI/assets/helpers.php";

require_once '../controller/UserController.php';
require_once 'template/header.php';
$controller->filename = basename(__FILE__);
?>

<!-- Page Content -->
	<div class="container">
        <div id="page-content-wrapper">
            <section class="container-fluid text-center">
                <h1 class="mb-5">Atualizar Dados</h1>
                <form action="../controller/UserController.php" method="post" class="was-validated">
	                <div class="row my-md-2"> 
	                    <div class="col-md-5 col-sm-12">
	                    	<div class="input-group mb-md-3 mb-sm-1">
	                    		<div class="input-group-prepend">
							  		<span class="input-group-text" id="basic-addon-name">Nome do Usuário</span>
							  	</div>
							  	<input type="text" required class="form-control" id="name" name="name" aria-describedby="basic-addon-name" value="<?php echo $user['name'] ?>">
							  	<div class="invalid-feedback">
					          		Por favor escolha um nome válido.
						        </div>	
							</div>                      
	                    </div>
	                    <div class="col-md-5 col-sm-12">
	                    	<div class="input-group mb-md-3 mb-sm-1">
	                    		<div class="input-group-prepend">
							  		<span class="input-group-text" id="basic-addon-email">Email</span>
							  	</div>
							  	<input type="text" required class="form-control" id="email" name="email" aria-describedby="basic-addon-email" value="<?php echo $user['email'] ?>">
							  	<div class="invalid-feedback">
					          		Por favor escolha um email válido.
						        </div>	
							</div>                      
	                    </div>
	                    <div class="col-md-2 col-sm-12 mt-2">
	                    	<div class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" id="admin" name="admin" value="1" <?php echo $user['admin']==1? "checked":"" ?>>
							  <label class="custom-control-label" for="admin" >Administrador</label>
							</div>                     
	                    </div>
                        <input type="hidden" id="id" name="id" value="<?php echo $user['id'] ?>">
                        <input type="hidden" id="password" name="password" value="<?php echo md5($user['password']) ?>">
					</div>

					<div class="row mt-md-5 justify-content-md-around">
	                    <div class="form-group col-md-6 col-sm-6">
	                       <label class="sr-only" for="edit">Editar</label>
	                       <button type="submit" class="btn btn-outline-success btn-block" id="edit" name="edit">Editar</button>
	                    </div>
	                    <div class="form-group col-md-6 col-sm-6">
	                       <label class="sr-only" for="cancel">Cancelar</label>
	                       <a href="users.php" class="btn btn-outline-secondary btn-block" id="cancel" name="cancel">Cancelar</a>
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
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>