<?php
require_once 'Controller.php';
require_once('../model/settings.config.php');
require_once '../model/Unit.php';
require_once '../model/Classroom.php';

Class ClassroomController extends Controller{

	private $unit;

	private $classroom;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->unit = new Unit($dbconfig);
		$this->classroom = new Classroom($dbconfig);
	}

	/* Function validateSession
     * Checks if a session is valid or redirects
     */
	public function validateSession(){
		parent::validateSession();
	}

	/* Function isAdmin
     * Checks if is a system administrator
     */
	public function isAdmin(){
		parent::isAdmin();
	}

	/* Function loadAllClassrooms
     * Get all classrooms from classroom table
     */
	public function loadAllClassrooms(){
		return $this->classroom->getClassrooms();
	}	

	/* Function insert
     * Insert a new classroom
     * @param $fields array with form's fields
     */
	public function insert($fields){
		$unit = $this->unit->getUnitByUserId($_SESSION['id']);
		$unit = array_pop($unit);
		$fields['units_id'] = $unit['id'];
		$this->classroom->setAttributes($fields);

		if($this->classroom->insertClassroom()){
			$dados = array('msg' => 'Turma cadastrada com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/classrooms.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao cadastrar nova turma', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/classrooms.php');
		exit;
	}
}

// -------------------------------------------------------
session_start();
$controller = new ClassroomController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllClassrooms();

if (isset($_POST['insert'])) {
	$fields = array('description' => $_POST['desc']);
	$controller->insert($fields);
}

if (isset($_POST['edit'])) {
	// $fields = array("id"=>$_POST['id'],"name"=>$_POST['name'],"users_id"=>$_POST['users_id']);
	// $controller->edit($fields);
}

if (isset($_GET['delete'])) {
	// $controller->delete($_GET['id']);
}