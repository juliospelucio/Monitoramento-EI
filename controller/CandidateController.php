<?php
require_once 'Controller.php';
require_once '../assets/helpers.php';
require_once '../model/settings.config.php';
require_once '../model/Candidate.php';
require_once '../model/Parents.php';
require_once '../model/Address.php';
require_once '../model/Unit.php';

Class CandidateController extends Controller{

	private $candidate;

	private $parents;

	private $unit;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->candidate = new Candidate($dbconfig);
		$this->address = new Address($dbconfig);
		$this->parents = new Parents($dbconfig);
		$this->unit = new Unit($dbconfig);
	}


	/* Function insert
     * Insert a new Candidate into candidates table
     * @param $fields array with form's fields
     */
	public function insert($fields){
		/*echo "<pre>";
		print_r($fields);
		echo "</pre>";*/
		$mother = $fields['mother'];
		$father = $fields['father'];
		/*echo "$mother";
		echo "$father";
		echo "<br>";*/
		$parents = array('mother' => $mother,'father' => $father);
		$this->parents->setAttributes($parents);
		// echo $this->parents;

		$street = $fields['street'];
		$number = $fields['number'];
		$neighborhood = $fields['neighborhood'];

		unset($fields['mother'],$fields['father'],$fields['street'],$fields['number'],$fields['neighborhood']);

		/*echo "<pre>";
		print_r($fields);
		echo "</pre>";*/		

		$address = array('street' => $street,'number' => $number,'neighborhood' => $neighborhood);
		$this->address->setAttributes($address);
		// echo $this->address;

		$fields = $fields + array('address' => $this->address,'parents' =>$this->parents);

		/*echo "<pre>";
		var_dump($fields);
		echo "</pre>";*/

		$this->candidate->setAttributes($fields);
		echo $this->candidate;

		$this->candidate->insertCandidate();
	}

	/* Function loadAllCandidates
     * Get all candidate from cadidate table
     */
	public function loadAllCandidates(){
		$candidates = new Candidate($this->dbconfig);
		return $candidates->getCandidates();
	}

	/* Function loadAllUnits
     * Get all units from units table
     */
	public function loadAllUnits(){
		$units = new Unit($this->dbconfig);
		return $units->getUnits();
	}
}

// -------------------------------------------------------
session_start();
$controller = new CandidateController($dbconfig);
$rows = $controller->loadAllCandidates();
$units = $controller->loadAllUnits();

if(isset($_POST['insert'])) { // comes from new_candidate form
	$controller->filename = $_POST['filename'];
	$fields = array('name' => $_POST['name'],
					'birth_date' => $_POST['birth_date'],
					'neighborhood' => $_POST['neighborhood'],
					'number' => $_POST['number'],
					'street' => $_POST['street'],
					'tel1' => numberTransform($_POST['tel1']),
					'tel2' => numberTransform($_POST['tel2']),
					'inscription_date' => date("Y-m-d"),
					'situation' => $_POST['situation'],
					'father' => $_POST['father'],
					'mother' => $_POST['mother']);

	if (isset($_POST['units_id'])) {
		$fields = $fields + array('units_id' => $_POST['units_id']);
	}
	$controller->insert($fields);
}





/*if (isset($_POST['insert'])) {
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
}*/




/*INSERT INTO `users` VALUES (DEFAULT,'name','email@gmail.com','123',0);
SELECT LAST_INSERT_ID();*/