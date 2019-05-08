<?php
require_once 'Controller.php';
require_once('..\model\settings.config.php');
require_once '..\model\Unit.php';
require_once '..\model\User.php';

Class UnitController extends Controller {

	private $unit;
	private $user;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->unit = new Unit($dbconfig);
		$this->user = new User($dbconfig);
	}

	/* Function validateSession
     * Checks if a session is valid or redirects
     */
	public function validateSession(){
		parent::validateSession();
	}

	/* Function checkFields
     * Checks fields that comes from new_unit form, if not redirects back to new_unit form
     * @param $fields array with form's fields
     */
	public function checkFields($fields){
		parent::checkFields($fields);
	}

	/* Function loadAllCandidates
     * Get all candidate from cadidate table
     */
	public function loadAllUnits(){
		$units = new Unit($this->dbconfig);
		return $units->getUnits();
	}

	/* Function insert
     * Insert a new Unit and associate with a user
     * @param $fields array with form's fields
     */
	public function insert($fields){
		$this->checkFields($fields);
		$this->unit->setAttributes($fields);
		if($this->unit->insertUnit()){
			$dados = array('msg' => 'Unidade cadastrada com sucesso', 'type' => $success);
			$_SESSION['data'] = $dados;
			header('location: ../view/units.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao cadastrar nova unidade', 'type' => $error);
		$_SESSION['data'] = $dados;
		header('location: ../view/units.php');
		exit;
	}

	/* Function edit
     * Update unit data
     * @param $fields array with form's fields
     */
	public function edit($fields){
		$this->checkFields($fields);
		if($this->unit->updateUnit($fields)){
			$dados = array('msg' => 'Unidade cadastrada com sucesso', 'type' => $success);
			$_SESSION['data'] = $dados;
			header('location: ../view/units.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao cadastrar nova unidade', 'type' => $error);
		$_SESSION['data'] = $dados;
		header('location: ../view/units.php');
		exit;
	}

	/* Function getDirectors
     * Get all diretors not associated with a unit from users and units table, if table empty get a invalid user
     */
	public function getDirectors(){
		$users = $this->user->getNonDirectors();
		if ($users) {
			return $users;
		}
		if ($id) {//--------------------------AQUI MÉTODO PARA BUSCAR USUÁRIO QUE NÃO TENHA UNIDADE EDIT DIRECTOR----------------------
			
		}
		return array (array('id'=>'','name'=>'Nenhum diretor disponível'));
	}


	/* Function getAllUsers
     * Get all users from `users` table, if table empty get a invalid user
     */
	public function getAllUsers(){
		$users = $this->user->getUsers();
		if ($users) {
			return $users;
		}
		return array (array('id'=>'','name'=>'Nenhum diretor disponível'));
	}

	/* Function getDirectors
     * Get all not associated diretors from users table, if table empty get all users
     */
	public function getUnit(){
		if (isset($_GET['id'])) {
			 return $this->unit->getUnitEdit($_GET['id']);
		}
		return array (array('name'=>'Unidade indisponível','id'=>''));
	}

}

// -------------------------------------------------------
session_start();
$controller = new UnitController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllUnits();
$users = $controller->getAllUsers();
$directors = $controller->getDirectors();
$units = $controller->getUnit();


if (isset($_POST['insert'])) {
	$fields = array('name' => $_POST['name'],'users_id' =>$_POST['users_id']);
	$controller->insert($fields);
}
if (isset($_POST['edit'])) {
	$fields = array(":id"=>$_POST['id'],":name"=>$_POST['name'],":users_id"=>$_POST['users_id']);
	$controller->edit($fields);
}