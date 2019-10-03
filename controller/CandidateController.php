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

	/* Function validateSession
     * Checks if a session is valid or redirects
     */
	public function validateSession(){
		parent::validateSession();
	}

	/* Function notAdmin
     * Checks if is a system administrator
     */
	public function notAdmin(){
		parent::notAdmin();
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

		$street = $fields['street'];
		$number = $fields['number'];
		$neighborhood = $fields['neighborhood'];
		$address = array('street' => $street,'number' => $number,'neighborhood' => $neighborhood);
		
		unset($fields['mother'],$fields['father'],$fields['street'],$fields['number'],$fields['neighborhood']);	
		
		$this->parents->setAttributes($parents);

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
		return $this->candidate->getCandidate($id);
	}	

	/* Function loadAllCandidates
     * Get all candidate from cadidate table
     */
	public function loadAllCandidates(){
		return $this->candidate->getCandidates();
	}

	/* Function loadAllUnits
     * Get all units from units table
     */
	public function loadAllUnits(){
		return $this->unit->getUnits();
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
     * @oaram $id int units id from candidates table
     * @return the current unit from a candidate table in html format
     */
	public function selectUnit($candidate){
		$units = $this->loadAllUnits();
		$options = array();
		if (!isset($candidate['uid'])) {
			$candidate['uid'] = 0;
		}
		foreach ($units as $unit) {			
			$candidate['uid']==$unit['unid'] ?
			array_push($options,  "<option value='".$unit['unid']."'selected>".$unit['unname']."</option>") :
			array_push($options,  "<option value='".$unit['unid']."'>".$unit['unname']."</option>");

		}
		return $options;
	}

	/* Function getInterval
     * Get the current categories based on cut date
     * @param $year candidate's category
     * @param $endDate cut date
     * @return array of candidates
     */
	private function getInterval($year,$endDate){
		$start_date = date("Y-m-d",strtotime("$endDate $year"));//based on march 31 cut date
		return $this->candidate->getCategory($start_date, $endDate);
	}

	/* Function getYear
     * Filter candidates based on current age
     * @param $year candidate's category
     * @param $rows candidates rows from database
     * @return array of candidates
     */
	private function getYear($endDate,$rows,int $year){
		$candidates = array();
		// var_dump($year);
		foreach ($rows as $row => $column) {
			$age = 	 dateDifference($endDate, $column['birth_date'],'%y');
			// var_dump($age);
			if ($age == $year) {
		 		array_push($candidates, $column);
		 	}
		 	if ($year == 1 && strpos($age, "Meses")) {
		 		array_push($candidates, $column);
		 	}
		}
		return $candidates;
	}

	/* Function getCategories
     * Get all candidates based on with categories are specified
     * @param $inf candidate's category
     * @param $endDate cut date
     * @return array of candidates
     */
	public function getCategories($inf = '',$endDate = ''){
	
		switch ($inf) {
			case 'I':
				$rows = $this->getInterval("-2 year",$endDate);
				$rows = $this->getYear($endDate,$rows,1);
				break;
			case 'II':
				$rows = $this->getInterval("-3 year",$endDate);
				$rows = $this->getYear($endDate,$rows,2);
				break;
			case 'III':
				$rows = $this->getInterval("-4 year",$endDate);
				$rows = $this->getYear($endDate,$rows,3);
				break;
			case 'IV':
				$rows = $this->getInterval("-5 year",$endDate);
				$rows = $this->getYear($endDate,$rows,4);
				break;
			case 'V':
				$rows = $this->getInterval("-6 year",$endDate);
				$rows = $this->getYear($endDate,$rows,5);
				break;
			default:
				$rows = $this->getInterval("-6 year",date("Y-m-d"));
				break;
		}
		return $rows;
	}
}

// -------------------------------------------------------
session_start();
$controller = new CandidateController($dbconfig);//Create controller
$controller->validateSession();
$rows = $controller->loadAllCandidates();//getAll candidates from database
$units = $controller->loadAllUnits();// getAll units from database

if (isset($_GET['id'])) {
	$candidate = $controller->loadCandidate($_GET['id']); $candidate = array_pop($candidate);
	$situation = $controller->selectSituation($candidate['situation']);
	$uoptions = $controller->selectUnit($candidate);//units options
}

if(isset($_POST['insert'])) {
	$controller->filename = $_POST['filename'];
	$fields = array('name' => $_POST['name'],
					'birth_date' => $_POST['birth_date'],
					'neighborhood' => $_POST['neighborhood'],
					'number' => $_POST['number'],
					'street' => $_POST['street'],
					'tel1' => numberTransform($_POST['tel1']),
					'tel2' => numberTransform($_POST['tel2']),
					'inscription_date' => date("Y-m-d"),
					'situation' => 0,
					'obs' => std_input($_POST['obs']),
					'conf_date' => null,
					'father' => $_POST['father'],
					'mother' => $_POST['mother']);

	if (empty($fields['tel2'])) {
		$fields['tel2'] = null;
	}

	if ($fields['situation']==1) {
		$fields['conf_date'] = date("Y-m-d");
	}

	if (isset($_POST['units_id']) && !empty($_POST['units_id'])) {
		$fields ['units_id'] = $_POST['units_id'];
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
					'obs' => std_input($_POST['obs']),
					'conf_date' => null,
					'parents_id' => $_POST['pid'],
					'father' => $_POST['father'],
					'mother' => $_POST['mother'],
					'units_id' => null);
	
	if (empty($fields['tel2'])) {
		$fields['tel2'] = null;
	}

	if (isset($_POST['units_id']) && !empty($_POST['units_id'])) {
		$fields ['units_id'] = $_POST['units_id'];
	}

	$controller->edit($fields);
}

if (isset($_GET['delete'])) {
	$controller->delete($_GET['id']);
}

if (isset($_GET['search']) && $_GET['search'] == 1) {
	if (isset($_GET['inf']) && isset($_GET['date'])) {
		$year = $_GET['inf'];
		$endDate = $_GET['date'];
		$rows = $controller->getCategories($year,$endDate);
	}else 
		$rows = $controller->getCategories();
}