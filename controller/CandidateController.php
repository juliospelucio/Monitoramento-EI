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
		// $this->checkFields($fields);

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
		// $this->checkFields($fields); //FIX
		if($this->candidate->updateCandidate($fields)){
			$dados = array('msg' => 'Candidato editado com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/candidates.php');
			exit;
		}
		$dados = array('msg' => 'Erro ao editar o candidato', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/candidates.php');
		exit;
	}

	/* Function delete
     * Delete a candidate data
     * @param $fields array with form's fields
     */
	public function delete($id){
		$candidate = $this->loadCandidate($id);
		$candidate = array_pop($candidate);
		/*echo "<pre>";
		print_r($candidate);
		echo "</pre>";
		exit;*/
		$cid = $candidate['cid'];
		$aid = $candidate['aid'];
		$pid = $candidate['pid'];
		if($this->candidate->deleteCandidate($cid,$aid,$pid)){
			$dados = array('msg' => 'Candidato excluído com sucesso', 'type' => parent::$success);
			$_SESSION['data'] = $dados;
			header('location: ../view/candidates.php');
			exit;
		}
		$dados = array('msg' => 'Erro a excluir candidato', 'type' => parent::$error);
		$_SESSION['data'] = $dados;
		header('location: ../view/candidates.php');
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

	/* Function selectSituation
     * Get the situation of a candidate
     * @param $situation string from the candidate
     * $return get the current situation from a candidate table
     */
	public function selectSituation($situation){
		switch ($situation) {
			case 1:
				return 
						"<option value='0'>Aguardando</option>
						<option value='1' selected>Confirmado</option>
						<option value='-1'>Desistente</option>";
			case -1:
				return 
						"<option value='0'>Aguardando</option>
						<option value='1'>Confirmado</option>
						<option value='-1' selected>Desistente</option>";
			default:
				return 
						"<option value='0' selected>Aguardando</option>
						<option value='1'>Confirmado</option>
						<option value='-1'>Desistente</option>";
		}
	}

	/* Function getSituation
     * Convert a situation of a candidate from a tinyint to a string
     * $value (tinyint) database value of current candidates situation
     * @return converted situation in string
     */
	public function getSituation($value){
		switch ($value) {
			case 1:
				return "Confirmado";
			case -1:
				return "Desistente";	
			default:
				return "Aguardando";
		}
	}	

	/* Function selectUnit
     * Get the unit of a candidate
     * $id int units id from candidates table
     * @return the current unit from a candidate table in html format
     */
	public function selectUnit($candidate){
		$units = $this->loadAllUnits();
		$options = array();
		if (!isset($candidate['uid'])) {
			$candidate['uid'] = 0;
		}
		foreach ($units as $unit) {			
			$candidate['uid']==$unit['id'] ?
			array_push($options,  "<option value='".$unit['id']."'selected>".$unit['aname']."</option>") :
			array_push($options,  "<option value='".$unit['id']."'>".$unit['aname']."</option>");

		}
		return $options;
	}

}

// -------------------------------------------------------
session_start();
$controller = new CandidateController($dbconfig);//Create controller
$rows = $controller->loadAllCandidates();//getAll candidates from database
$units = $controller->loadAllUnits();// getAll units from database

if (isset($_GET['id'])) {
	$candidate = $controller->loadCandidate($_GET['id']);
	$candidate = array_pop($candidate);
	$situation = $controller->selectSituation($candidate['situation']);
	$uoptions = $controller->selectUnit($candidate);//units options
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
	$controller->filename = $_POST['filename'];
	$fields = array('id' => $_POST['id'],
					'name' => $_POST['name'],
					'birth_date' => $_POST['birth_date'],
					'addresses_id' => $_POST['aid'],
					'neighborhood' => $_POST['neighborhood'],
					'number' => $_POST['number'],
					'street' => $_POST['street'],
					'tel1' => numberTransform($_POST['tel1']),
					'tel2' => numberTransform($_POST['tel2']),
					'situation' => $_POST['situation'],
					'parents_id' => $_POST['pid'],
					'father' => $_POST['father'],
					'mother' => $_POST['mother'],
					'units_id' => null);
	
	if (isset($_POST['units_id']) && !empty($_POST['units_id'])) {
		$fields['units_id'] = $_POST['units_id'];
	}

	$controller->edit($fields);
}

if (isset($_GET['delete'])) {
	$controller->delete($_GET['id']);
}