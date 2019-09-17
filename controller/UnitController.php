<?php
require_once 'Controller.php';
require_once('../model/settings.config.php');
require_once '../model/Unit.php';
require_once '../model/User.php';

Class UnitController extends Controller {

	private $unit;
	private $user;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->unit = new Unit($dbconfig);
		$this->user = new User($dbconfig);
		parent::validateSession();
	}

	/* Function validateSession
     * Checks if a session is valid or redirects
     */
	public function validateSession(){
		parent::validateSession();
	}

	/* Function loadAllCandidates
     * Get all candidate from cadidate table
     */
	public function loadAllUnits(){
		$units = new Unit($this->dbconfig);
		return $units->getUnits();
	}

	/* Function getUnit
     * Get a unit by it's Id
     * @param unit's id
     */
	public function getUnit($id){
	 	$unit =  $this->unit->getUnitEdit($id);
	 	if (!$unit) {
			return array (array('name'=>'Unidade indisponível','id'=>''));
	 	}
 		return $this->unit->getUnitEdit($id);
	}

	/* Function insert
     * Insert a new Unit and associate with a user
     * @param $fields array with form's fields
     */
	public function insert($fields){
		// parent::checkFields($fields);
		$this->unit->setAttributes($fields);
		if($this->unit->insertUnit()){
			$dados = array('msg' => 'Unidade cadastrada com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/units.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao cadastrar nova unidade', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/units.php');
		exit;
	}

	/* Function edit
     * Update unit data
     * @param $fields array with form's fields
     */
	public function edit($fields){
		// $this->checkFields($fields);
		/*print_r($fields);
		exit;*/
		if($this->unit->updateUnit($fields)){
			$dados = array('msg' => 'Unidade editada com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/units.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao editar a unidade', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/units.php');
		exit;
	}

	/* Function delete
     * Delete a unit data
     * @param $fields array with form's fields
     */
	public function delete($id){
		if ($this->unit->deleteUnit($id)) {
			$dados = array('msg' => 'Unidade apagada com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/units.php');
			exit;
		}
		$dados = array('msg' => 'Erro a apagar unidade', 'type' => parent::$error);
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

}

// CHAMADA DE MÉTODOS -------------------------------------------------------
session_start();
$controller = new UnitController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllUnits();

$users = $controller->getAllUsers();
$directors = $controller->getDirectors();

if (isset($_GET['id'])) {
	$units = $controller->getUnit($_GET['id']);
}

if (isset($_POST['insert'])) {
	$fields = array('name' => $_POST['name'],'users_id' =>$_POST['users_id']);
	$controller->insert($fields);
}
if (isset($_POST['edit'])) {
	$fields = array("id"=>$_POST['id'],"name"=>$_POST['name'],"users_id"=>$_POST['users_id']);
	$controller->edit($fields);
}

if (isset($_GET['delete'])) {
	$controller->delete($_GET['id']);
}