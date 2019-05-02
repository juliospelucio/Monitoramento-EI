<?php
require_once 'Controller.php';
require_once('..\model\settings.config.php');
require_once '..\model\Candidate.php';
require_once '..\model\Parents.php';

Class CandidateController extends Controller{

	private $candidate;

	private $parents;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->candidate = new Candidate($dbconfig);
		$this->parents = new Parents($dbconfig);
	}

	/* Function isInserted
     * Checks if form is submitted
     * @return boolean true if is insert.
     */
	public function isInserted(){
		if(isset($_POST['insert'])) { // comes from new_candidate form
			checkFields();
			return true;
		}
		return false;
	}

	/* Function checkFields
     * Checks fields that comes from new_candidate form, if not redirects back to new_candidate form
     * @param $fields array with form's fields
     */
	public function checkFields($fields){
		foreach ($fields as $field) {
			if (!isset($field)) {
				$this->candidate->setAttributes($attributes);
				$this->parents->setAttributes($attributes);
				$dados = array('msg' => 'Todos os campos são necessários', 'type' => $error);
				$_SESSION['data'] = $dados;
				header('location: ../view/new_candidate.php');
				exit;
			}
		}
	}

}

// -------------------------------------------------------
session_start();
$controller = new CandidateController($dbconfig);

if (isset($_POST['insert'])) {
	if (!isset($_POST['name']) || !isset($_POST['birth']) || !isset($_POST['tel']) || !isset($_POST['tel2']) || !isset($_POST['inscription'])  || !isset($_POST['neighborhood']) || !isset($_POST['street'])  || !isset($_POST['number'])  || !isset($_POST['father'])  || !isset($_POST['mother'])) {

		$data = array('msg' => 'Campos Inválidos preecha novamente.', 'type' => $error);
		$_SESSION['data'] = $data;
		header('location: '. myURL(). 'view/new_candidate.php');
		exit;

	}else{

		$name = $_POST['name'];
		$birth = $_POST['birth'];
		$tel =  numberTransform($_POST['tel']);
		$tel2 =  numberTransform($_POST['tel2']);
		$inscription =  $_POST['inscription'];
		$neighborhood = $_POST['neighborhood'];
		$street =  $_POST['street'];
		$number = $_POST['number'];
		$father = $_POST['father'];
		$mother =  $_POST['mother'];


		//$name,$birth,$inscription,$mother,$father,$street,$number,$neighborhood,$tel,$tel2
		insertCandidates($name,$birth,$inscription,$mother,$father,$street,$number,$neighborhood,$tel,$tel2);
		$data = array('msg' => 'Candidato cadastrado com sucesso.', 'type' => $success);
		    	$_SESSION['data'] = $data;
		header('location: ../view/index.php');
		exit;
	}
}




/*INSERT INTO `users` VALUES (DEFAULT,'name','email@gmail.com','123',0);
SELECT LAST_INSERT_ID();*/