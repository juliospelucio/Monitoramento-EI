<?php 
require_once '../assets/helpers.php';
require_once '../controller/UserController.php';
$controller->notAdmin();
require_once ($controller->importHeader($_SESSION['admin']));
// $controller->filename = basename(__FILE__);
?>     
    <section class="container text-center">
        <h1 class="mb-5">Atualizar Dados</h1>
        <form action="#" method="post" class="was-validated">
            <div class="row my-md-2"> 
                <div class="col-md-5 col-sm-12">
                	<div class="input-group mb-3">
                		<div class="input-group-prepend">
					  		<span class="input-group-text" id="basic-addon-name">Nome do Usuário</span>
					  	</div>
					  	<input type="text" required class="form-control" id="name" name="name" aria-describedby="basic-addon-name" value="<?php echo $user['name'] ?>" autofocus>
					  	<div class="invalid-feedback">
			          		Por favor escolha um nome válido.
				        </div>	
					</div>                      
                </div>
                <div class="col-md-5 col-sm-12">
                	<div class="input-group mb-3">
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
                <input type="hidden" id="password" name="password" value="<?php echo $user['password'] ?>">
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
    <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container pb-5 mb-5">
    </div>

<?php
require_once 'template/footer.php';
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>