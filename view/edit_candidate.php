<?php 
require_once '../assets/helpers.php';
require_once '../controller/CandidateController.php';
require_once ($controller->importHeader($_SESSION['admin']));
?>
    <section class="container text-center">
        <h1 class="mb-5">Editar Candidato</h1>
        <form action="../controller/CandidateController.php" method="post" class="was-validated">
            <div class="row my-md-2"> 
                <div class="col-md-8 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-name">Nome do Candidato</span>
					  </div>
					  <input type="text" required class="form-control" id="name" name="name" aria-describedby="basic-addon-name" value="<?php echo $candidate['cname'] ?>" autofocus>
					</div>
                </div>
				<div class="col-md-4 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-birth_date">Data de Nascimento</span>
					  </div>
					  <input type="date" required class="form-control" id="birth_date" name="birth_date" aria-describedby="basic-addon-birth_date" value="<?php echo $candidate['birth_date'] ?>">
					</div>
                </div>                    
            </div>

			<div class="row my-md-2"> 
                <div class="col-md-5 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-neighborhood">Bairro</span>
					  </div>
					  <input type="text" required class="form-control" id="neighborhood" name="neighborhood" aria-describedby="basic-addon-neighborhood" value="<?php echo $candidate['neighborhood'] ?>">
					</div>
                </div>
                <div class="col-md-5 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-street">Logradouro</span>
					  </div>
					  <input type="text" required class="form-control" id="street" name="street" aria-describedby="basic-addon-street"  value="<?php echo $candidate['street'] ?>">
					</div>                      
                </div>
                <div class="col-md-2 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-number">Número</span>
					  </div>
					  <input type="number" required class="form-control" id="number" name="number" aria-describedby="basic-addon-number" value="<?php echo $candidate['number'] ?>">
					</div>
                </div>
			</div>

			<div class="row my-md-2"> 
                <div class="col-md-6 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-father">Nome do Pai</span>
					  </div>
					  <input type="text" required class="form-control" id="father" name="father" aria-describedby="basic-addon-father" value="<?php echo $candidate['father'] ?>">
					</div>                      
                </div>
                <div class="col-md-6 col-sm-12">
                	<div class="input-group mb-3 mb">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-mother">Nome da Mãe</span>
					  </div>
					  <input type="text" required class="form-control" id="mother" name="mother" aria-describedby="basic-addon-mother" value="<?php echo $candidate['mother'] ?>">
					</div>
                </div>
			</div>

			<div class="row my-md-2"> 
                <div class="col-md-3 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-tel1">telefone</span>
					  </div>
					  <input type="tel" required class="form-control" id="tel1" name="tel1" aria-describedby="basic-addon-tel1" value="<?php echo $candidate['tel1'] ?>">
					</div>                      
                </div>
                <div class="col-md-3 col-sm-12">
                	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-tel2">telefone</span>
					  </div>
					  <input type="tel" class="form-control" id="tel2" name="tel2" aria-describedby="basic-addon-tel2" <?php echo empty($candidate['tel2'])?"":"value='".$candidate['tel2']."'"?>>
					</div>                      
                </div>
                <div class="col-md-3 col-sm-12">
                	<div class="input-group mb-3">
                		<div class="input-group-prepend">
					    	<span class="input-group-text" id="basic-addon-situation">Situação</span>
					  	</div>
					  	<select class="custom-select" id="situation" name="situation" aria-describedby="basic-addon-situation">
					  		<?php echo $situation ?>
					  	</select>
					</div>
                </div>
                <div class="col-md-3 col-sm-12">
                	<div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<span class="input-group-text" id="basic-addon-situation">Unidade</span>
					  	</div>
					  	<select class="custom-select" id="units_id" name="units_id" aria-describedby="basic-addon-units_id">
					  		<option value=""></option>

				  			<?php foreach ($uoptions as $uoption): ?>
				  				<?php echo $uoption ?>
				  			<?php endforeach ?>
				  		</select>
					</div>
                </div>
			</div>
			<div class="row my-md-2"> 
				<div class="col-auto col-sm-12">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon-obs">Observações</span>
					  </div>
					  <textarea class="form-control" id="obs" name="obs" rows="4"> <?php echo $candidate['obs'] ?></textarea>
					</div>  
					
				</div>
			</div>

			<input type="hidden" id="filename" name="filename" value="<?php echo basename(__FILE__) ?>">
			<input type="hidden" id="id" name="id" value="<?php echo $candidate['cid'] ?>">
			<input type="hidden" id="aid" name="aid" value="<?php echo $candidate['aid'] ?>">
			<input type="hidden" id="pid" name="pid" value="<?php echo $candidate['pid'] ?>">
			<?php 
			echo isset($candidate['crid'])?"<input type='hidden' id='crid' name='crid' value='".$candidate['crid']."'>":""; 
			?>
			
			<div class="row my-md-2 justify-content-around mt-5">
                <div class="form-group col-md-6 col-sm-6">
                   <label class="sr-only" for="insert">Editar</label>
                   <button type="submit" class="btn btn-outline-success btn-block" id="edit" name="edit">Editar</button>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                   <label class="sr-only" for="cancel">Cancelar</label>
                   <a href="candidate_data.php?id=<?php echo $candidate['cid'] ?>" class="btn btn-outline-secondary btn-block" id="cancel" name="cancel">Cancelar</a>
                </div>
            </div>            
        </form>
    </section>
 	<!-- EMPTY DIV - PUSH FOOTER -->
    <div class="container pb-5 mb-5">
    </div>
<?php require_once 'template/footer.php'; ?>
<script type="text/javascript">applyMask()</script>
