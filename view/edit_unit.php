<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/Monitoramento-EI/assets/helpers.php";

require_once '../controller/UnitController.php';
require_once 'template/header.php';
?>

<!-- Page Content -->
	<div class="container">
        <div id="page-content-wrapper">
            <section class="container-fluid text-center">
                <h1 class="mb-5">Atualizar Dados</h1>
                <!-- <form action="../controller/edit_user.php" method="post">
                	                <div class="row my-md-3 my-sm-5">
                	                    <div class="col-md-5 col-sm-12">
                	                    	<div class="input-group my-2">
                							  <div class="input-group-prepend">
                							    <span class="input-group-text" id="basic-addon-name">Nome</span>
                							  </div>
                							  <input type="text" required class="form-control" id="name" name="name" aria-describedby="basic-addon-name" value="<?php echo $user->name ?>">
                							</div>
                	                    </div>
                	                    <div class="col-md-5 col-sm-12">
                	                    	<div class="input-group my-2">
                							  <div class="input-group-prepend">
                							    <span class="input-group-text" id="basic-addon-email">Email</span>
                							  </div>
                							  <input type="email" required class="form-control" id="email" name="email" email="email" aria-describedby="basic-addon-email" value="<?php echo $user->email ?>">
                							</div>                      
                	                    </div>
                	                    <div class="col-auto">
                	                    	<a href="#" data-href="delete_candidate.php?id=<?php echo $column->id ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-secondary my-2">Senha</a>
                	                    </div>
                					</div>
                
                					<input type="hidden" id="password" name="password" value="<?php echo $user->password ?>">
                					<input type="hidden" id="id" name="id" value="<?php echo $user->id ?>">
                					
                					<div class="row mt-md-5 justify-content-md-around">
                	                    <div class="form-group col-md-6 col-sm-6">
                	                       <label class="sr-only" for="edit">Editar</label>
                	                       <button type="submit" class="btn btn-outline-success btn-block" id="edit" name="edit">Editar</button>
                	                    </div>
                	                    <div class="form-group col-md-6 col-sm-6">
                	                       <label class="sr-only" for="cancel">Cancelar</label>
                	                       <a href="index.php" class="btn btn-outline-secondary btn-block" id="cancel" name="cancel">Cancelar</a>
                	                    </div>
                	                </div>
                </form> -->
                <form action="../controller/UnitController.php" method="post">
	                <div class="row my-md-2"> 
	                    <div class="col-md-6 col-sm-12">
	                    	<div class="input-group mb-md-3 mb-sm-1">
	                    		<div class="input-group-prepend">
							  		<span class="input-group-text" id="basic-addon-name">Nome da Unidade</span>
							  	</div>
							  	<?php foreach ($editUser as $user): ?>
							  	<input type="text" required class="form-control" id="name" name="name" aria-describedby="basic-addon-name" value="<?php echo $user['aname'] ?>">
							  	<?php endforeach ?>
							</div>                      
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
										if($editUser[0]['bid']==$user['id'])
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
	                       <a href="index.php" class="btn btn-outline-secondary btn-block" id="cancel" name="cancel">Cancelar</a>
	                    </div>
	                </div>
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