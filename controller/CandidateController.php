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
		$this->checkFields($fields);

		$mother = $fields['mother'];
		$father = $fields['father'];
		$parents = array('mother' => $mother,'father' => $father);
		$this->parents->setAttributes($parents);

		$street = $fields['street'];
		$number = $fields['number'];
		$neighborhood = $fields['neighborhood'];
		unset($fields['mother'],$fields['father'],$fields['street'],$fields['number'],$fields['neighborhood']);	

		$address = array('street' => $street,'number' => $number,'neighborhood' => $neighborhood);
		$this->address->setAttributes($address);

		$fields = $fields + array('address' => $this->address,'parents' => $this->parents);

		$this->candidate->setAttributes($fields);
		
		if($this->candidate->insertCandidate()){
			$dados = array('msg' => 'Candidato inserido com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/candidates.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao inserir novo candidato', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/candidates.php');
		exit;
	}

	/* Function edit
     * Update candidate data
     * @param $fields array with form's fields
     */
	public function edit($fields){
		$this->checkFields($fields);
		if($this->unit->updateCandidate($fields)){
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

	/* Function loadCandidate
     * Get a candidate from cadidate table
     * @param $id id from candidate table
     */
	public function loadCandidate($id){
		$candidates = new Candidate($this->dbconfig);
		return $candidates->getCandidate($id);
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

if (isset($_GET['id'])) {
	$candidate = $controller->loadCandidate($_GET['id']);
	$candidate = array_pop($candidate);
}

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

	if (isset($_POST['units_id']) && !empty($_POST['units_id'])) {
		$fields = $fields + array('units_id' => $_POST['units_id']);
	}
	$controller->insert($fields);
}

if (isset($_POST['edit'])) {
	$fields = array(":id"=>$_POST['id'],
					":name"=>$_POST['name'],
					":users_id"=>$_POST['users_id']);
	$controller->edit($fields);
}