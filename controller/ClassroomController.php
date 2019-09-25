<?php
require_once 'Controller.php';
require_once('../model/settings.config.php');
require_once '../model/Candidate.php';
require_once '../model/Unit.php';
require_once '../model/Address.php';
require_once '../model/Parents.php';

Class ClassroomController extends Controller{

	private $candidate;

	private $parents;

	private $classroom;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->candidate = new Candidate($dbconfig);
		$this->unit = new Unit($dbconfig);
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

	/* Function insert
     * Insert a new classroom
     * @param $fields array with form's fields
     */
	public function insert($fields){
		$this->unit->setAttributes($fields);
		if($this->unit->insertUnit()){
			$dados = array('msg' => 'Turma cadastrada com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/units.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao cadastrar nova unidade', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/units.php');
		exit;
	}
}

// -------------------------------------------------------
session_start();
$controller = new ClassroomController($dbconfig);
$controller->validateSession();