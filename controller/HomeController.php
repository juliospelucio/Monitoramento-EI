<?php
require_once 'Controller.php';
require_once('../model/settings.config.php');
require_once '../model/Candidate.php';
require_once '../model/Classroom.php';
require_once '../model/Unit.php';

Class HomeController extends Controller{

	private $candidate;

	private $classroom;

	private $unit;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->candidate = new Candidate($dbconfig);
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
		$classrooms = $this->classroom->getClassrooms($unit['id']);
		if (!$classrooms) {
			array_unshift($classrooms, array('id' => -1, 'description' => 'Nenhuma turma cadastrada', 'units_id' => -1));
		}
		return $classrooms;
	}

	/* Function loadCandidate
     * Get a candidate by id from candidate table
     * @param $id candidate's id
     * @return a single row with a candidate 
     */
	public function loadCandidate($id){
		return $this->candidate->getCandidate($id);
	}

	/* Function registerCandidate
     * Update candidate classroom and changes situation to confirmed
     * @param $fields array with form's fields
     * @use home.php
     */
	public function registerCandidate($fields){
		if($this->candidate->updateCandidate($fields)){
			$dados = array('msg' => 'Candidato matriculado', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/home.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao matricular candidato', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/home.php');
		exit;
	}

	/* Function unregisterCandidate
     * Update candidate situation to give up
     * @param $fields array with form's fields
	 * @use home.php
     */
	public function unregisterCandidate($fields){
		if($this->candidate->updateCandidate($fields)){
			$dados = array('msg' => 'Candidato não matriculado', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/home.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao dessistir da matrícula', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/home.php');
		exit;
	}

	/* Function waitingList
     * Get all candidates that are waiting based on a unit
     * @param $uid users id
     * @return array with all candidates on AGUARDANDO status
     */
	public function waitingList($uid){
		$unit = $this->unit->getUnitByUserId($uid);
		$unit = array_pop($unit);
		return $this->candidate->pendingCandidates($unit['id']);
	}

	/* Function checkClassroom
     * Check if a class was chosen
     * @param $classroom value of form
     */
	public function checkClassroom($classroom){
		if ($classroom=='Escolher...') {
		$dados = array('msg' => 'Escolha uma turma', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/home.php');
		exit;
		}
		if ($classroom==-1) {
		$dados = array('msg' => 'Nenhuma turma disponível', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/home.php');
		exit;
		}
	}
}

// -------------------------------------------------------
session_start();
$controller = new HomeController($dbconfig);
$controller->validateSession();
$rows = $controller->waitingList($_SESSION['id']);
$classrooms = $controller->loadAllClassroomsByUnit($_SESSION['id']);

if (isset($_POST['conf'])) {
	$controller->checkClassroom($_POST['classrooms_id']);
	$candidate = $controller->loadCandidate($_POST['cid']);
	$candidate = array_pop($candidate);
	$fields = array('id' => $candidate['cid'],
					'situation' => 1,//update situation----------------------------
					'units_id' => $candidate['uid'],
					'classrooms_id' => $_POST['classrooms_id'],
					'parents_id' => $candidate['pid'],
					'father' => $candidate['father'],
					'mother' => $candidate['mother'],
					'addresses_id' => $candidate['aid'],
					'neighborhood' => $candidate['neighborhood'],
					'number' => $candidate['number'],
					'street' => $candidate['street']);
	$controller->registerCandidate($fields);
}

if (isset($_POST['pass'])) {	
	$candidate = $controller->loadCandidate($_POST['cid']);
	$candidate = array_pop($candidate);
	$fields = array('id' => $candidate['cid'],
					'obs' => $_POST['obs'],
					'situation' => -1,//update situation----------------------------
					'conf_date' => null,//update conf-date------------------------
					'units_id' => null,//update units_id------------------------
					'classrooms_id' => null,//update class------------------------
					'parents_id' => $candidate['pid'],
					'father' => $candidate['father'],
					'mother' => $candidate['mother'],
					'addresses_id' => $candidate['aid'],
					'neighborhood' => $candidate['neighborhood'],
					'number' => $candidate['number'],
					'street' => $candidate['street']);
	$controller->unregisterCandidate($fields);
}