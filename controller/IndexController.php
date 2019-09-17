<?php
require_once 'Controller.php';
require_once('../model/settings.config.php');
require_once '../model/Candidate.php';
require_once '../model/Unit.php';
require_once '../model/Address.php';
require_once '../model/Parents.php';

Class IndexController extends Controller{

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

	/* Function loadAllCandidates
     * Get all candidate from cadidate table
     * @return array with Candidates
     */
	public function loadAllCandidates(){
		return $this->candidate->getCandidates();
	}

	/* Function loadAllUnits
     * Get all units from units table
     * @return array with units
     */
	public function loadAllUnits(){
		return $this->unit->getUnits();
	}

	/* Function unitNameTransform
     * Get a formatted last word, from unit's name
     * @return formatted string name
     */
	public function unitNameTransform($name){
		$name = explode(" ", $name);
    	$name = end($name);
		return strtolower($name);
	}

	/* Function listGroup
     * Get a list group of units
     * @return a HTML formatted list-group
     */
	public function listGroup(){
		$units = $this->loadAllUnits();
		$stDate = date("Y")."-01-01";
		$endDate = date("Y")."-12-31";

		$anchor = "<div class='row'> <div class='col-4'> <div class='list-group' id='list-tab' role='tablist'>";
		$div = "<div class='col-8'> <div class='tab-content' id='nav-tabContent'>";

		foreach ($units as $key => $unit) {
			$count = $this->candidate->countCandidates($stDate,$endDate,$unit['unid']);
			$class = $key==0?" class='list-group-item list-group-item-action active'":"class='list-group-item list-group-item-action'";
			$anchor .= "<a ".$class."id='list-".$this->unitNameTransform($unit['unname'])."-list' data-toggle='list' href='#list-".$this->unitNameTransform($unit['unname'])."' role='tab' aria-controls='".$this->unitNameTransform($unit['unname'])."'>".$unit['unname']."</a>";
			if ($key==(count($units)-1)) {
				$anchor.="</div> </div>";
			}
			$class = $key==0?" class='tab-pane fade show active'":"class='tab-pane fade'";
			$div .= "<div ".$class."id='list-".$this->unitNameTransform($unit['unname'])."' role='tabpanel' aria-labelledby='list-".$this->unitNameTransform($unit['unname'])."-list'> <p>Diretor(a): ".$unit['usname']."</p><p>Quantidade de Candidatos encaminhados : ".array_pop($count[0])."</p></div>";
		}
		return $anchor.$div;
	}

	/* Function loadUnitsData
     * Get all units from units table
     * @return array with units
     */
	public function loadUnitsData(){
		return $this->unit->getUnits();
	}

}

// -------------------------------------------------------
session_start();
$controller = new IndexController($dbconfig);
$controller->validateSession();
