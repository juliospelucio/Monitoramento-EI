<?php
require_once 'Controller.php';
require_once('..\model\settings.config.php');
require_once '..\model\Unit.php';
require_once '..\model\User.php';

Class UnitController extends Controller{

	/* Function loadAllCandidates
     * Get all candidate from cadidate table
     */
	public function loadAllUnits(){
		$units = new Unit($this->dbconfig);
		return $units->getUnits();
	}

	public function checkFields($fields){
		foreach ($fields as $field) {
			if (!isset($field)) {
				$dados = array('msg' => 'Todos os campos são necessários', 'type' => $error);
				$_SESSION['data'] = $dados;
				header('location: ../view/new_unit.php');
				exit;
			}
		}
	}
}

// -------------------------------------------------------
session_start();
$controller = new UnitController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllUnits();

if (isset($_POST['insert'])) {
	insertUnit(){

	}
	$fields = array('name' => $_POST['name'],'user' =>$_POST['user']);

}