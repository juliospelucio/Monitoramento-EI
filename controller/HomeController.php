<?php
require_once 'Controller.php';
require_once('../model/settings.config.php');
require_once '../model/Candidate.php';
require_once '../model/Unit.php';
require_once '../model/Address.php';
require_once '../model/Parents.php';

Class HomeController extends Controller{

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

	/* Function isAdmin
     * Checks if is a system administrator
     */
	public function isAdmin(){
		parent::isAdmin();
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

}

// -------------------------------------------------------
session_start();
$controller = new HomeController($dbconfig);
$controller->validateSession();
$rows = $controller->waitingList($_SESSION['id']);