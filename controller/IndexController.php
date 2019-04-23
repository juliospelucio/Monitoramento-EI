<?php
// require_once $_SERVER['DOCUMENT_ROOT']."/Controle-Infantil/assets/helpers.php";
require_once '..\model\User.php';
require_once '..\model\Candidate.php';
require_once('..\model\settings.config.php');

Class IndexController {

	private $dbconfig;

	public static $error = "Erro";

	public static $success = "Sucesso";

	public function __construct($dbconfig){
		$this->dbconfig = $dbconfig;
	}

	public function validateSession(){
		if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
			unset($_SESSION['id']);
			unset($_SESSION['name']);
			session_destroy();
			header('location: '. myURL().'view/login.php');
			exit;
		}
	}

	public function loadAllCandidates(){
		$candidates = new Candidate($this->dbconfig);
		return $candidates->getCandidates();
	}
}

session_start();
$controller = new IndexController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllCandidates();

echo "<pre>";
print_r($rows);
echo "</pre>";