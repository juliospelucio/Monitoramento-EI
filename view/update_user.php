<?php 
require_once '../assets/helpers.php';
require_once '../controller/UserController.php';
require_once ($controller->importHeader($_SESSION['admin']));
?>
    <section class="container text-center">
        <h1 class="mb-5">Atualizar Dados</h1>
        <form action="#" method="post" class="was-validated">
            <div class="row my-2"> 
                <div class="col-md-6 col-sm-12">
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
                <div class="col-md-4 col-sm-12">
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
                <div class="col-auto">
                	<a href="" data-href="../controller/UserController.php?id=<?php echo $user['id'] ?>" data-toggle="modal" data-target="#psw" class="btn btn-secondary">Senha</a>
                </div>
                <input type="hidden" id="id" name="id" value="<?php echo $user['id'] ?>">
                <input type="hidden" id="admin" name="admin" value="<?php echo $user['admin'] ?>">
                <input type="hidden" id="password" name="password" value="<?php echo $user['password'] ?>">
                <input type="hidden" id="update" name="update" value="1">
			</div>

			<div class="row mt-md-5 justify-content-md-center">
                <div class="form-group col-md-6 col-sm-6">
                   <label class="sr-only" for="edit">Atualizar</label>
                   <button type="submit" class="btn btn-outline-success btn-block" id="edit" name="edit">Atualizar</button>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                   <label class="sr-only" for="edit">Voltar</label>
                  <a class="btn btn-outline-secondary btn-block" href="../view/index.php" role="button">Voltar</a>
                </div>
            </div>
        </form>
    </section>
    </div>
	 <!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container pb-5 mb-5">
    </div>
<?php
require_once 'template/footer.php';
require_once 'template/password_modal.php';
?>
<?php if (isset($_SESSION['data']))triggerModal() ?>