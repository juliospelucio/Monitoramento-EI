<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/Monitoramento-EI/assets/helpers.php";
require_once '../controller/UserController.php';
require_once 'template/header.php';
?>



<!-- Page Content -->
	<div class="container">
        <div id="page-content-wrapper">
            <section class="container-fluid text-center">
                <h1 class="mb-5">Atualizar Dados</h1>
                <form action="../controller/UserController.php" method="post" class="was-validated">
	                <div class="row my-md-2"> 
	                    <div class="col-md-6 col-sm-12">
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
	                    <div class="col-md-4 col-sm-12">
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
	                    <div class="col-auto">
	                    	<a href="#" data-href="../controller/UserController.php?<?php echo $user['id'] ?>" data-toggle="modal" data-target="#psw" class="btn btn-secondary">Senha</a>
	                    </div>
                        <input type="hidden" id="id" name="id" value="<?php echo $user['id'] ?>">
                        <input type="hidden" id="password" name="password" value="<?php echo $user['password'] ?>">
					</div>

					<div class="row mt-md-5 justify-content-md-center">
	                    <div class="form-group col-md-6 col-sm-6">
	                       <label class="sr-only" for="edit">Atualizar</label>
	                       <button type="submit" class="btn btn-outline-success btn-block" id="edit" name="edit">Atualizar</button>
	                    </div>
	                </div>
	            </form>
            </section>
        </div>
    </div>
<!-- /#page-content-wrapper -->

<?php
require_once 'template/footer.php';
require_once 'template/password_modal.php';
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>