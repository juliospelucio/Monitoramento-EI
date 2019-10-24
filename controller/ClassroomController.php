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

	/* Function importHeader
     * Returns a header path by using user admin or not
     * @param $admin status of the current user in session
     */
	public function importHeader($admin){
	    return parent::importHeader($admin);
	}
	
	/* Function loadAllClassroomsByUnit
     * Get all classrooms from classroom table
     * @param $uid current user's id
     * @use classrooms.php
     * @return array with classrooms
     */
	public function loadAllClassroomsByUnit($uid){
		$unit = $this->unit->getUnitByUserId($uid);
		$unit = array_pop($unit);
		return $this->classroom->getClassrooms($unit['id']);
	}

	/* Function loadStudents
     * Get all students from a class by Id
     * @use classroom.php
     * @param $clid classroom's id
     * @return array with candidates
     */
	public function loadStudents($clid){
		return $this->classroom->getStudents($clid);
	}
	/* Function loadClassroom
     * Get a classroom by it's Id
     * @use edit_classroom.php
     * @param classroom's id
     * @return array with error mensage
     */
	public function loadClassroom($id){
	 	$classroom =  $this->classroom->getClassroom($id);
	 	if (!$classroom) {
			return array (array('description'=>'Turma indisponível','id'=>''));
	 	}
 		return $classroom;
	}

	/* Function insert
     * Insert a new classroom
     * @use new_classroom.php
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

	/* Function edit
     * Update classroom data
     * @use edit_classroom.php
     * @param $fields array with form's fields
     */
	public function edit($fields){
		if($this->classroom->updateClassroom($fields)){
			$dados = array('msg' => 'Turma editada com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/classrooms.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao editar a turma', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/classrooms.php');
		exit;
	}

	/* Function delete
     * Delete a classroom data
	 * @use classroom.php
     * @param $fields array with form's fields
     */
	public function delete($id){
		if ($this->classroom->deleteClassroom($id)) {
			$dados = array('msg' => 'Turma apagada com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/classrooms.php');
			exit;
		}
		$dados = array('msg' => 'Erro a apagar turma', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/classrooms.php');
		exit;
	}
}

// -------------------------------------------------------
session_start();
$controller = new ClassroomController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllClassroomsByUnit($_SESSION['id']);

if (isset($_GET['id'])) {//edit_classroom.php
	$classroom = $controller->loadClassroom($_GET['id']);
	$classroom = array_pop($classroom);
}

if (isset($_GET['clid'])) {
	$classrooms = $controller->loadStudents($_GET['clid']);
}

if (isset($_POST['insert'])) {//new_classroom.php
	$fields = array('description' => $_POST['description']);
	$controller->insert($fields);
}

if (isset($_POST['edit'])) {//edit_classroom.php classrooms.php
	$fields = array("id"=>$_POST['id'],"description"=>$_POST['description'],"units_id"=>$_POST['units_id']);
	$controller->edit($fields);
}

if (isset($_GET['delete'])) {//classrooms.php
	$controller->delete($_GET['id']);
}