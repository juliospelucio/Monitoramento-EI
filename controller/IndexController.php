<?php
require_once 'Controller.php';
require_once('..\model\settings.config.php');
require_once '..\model\Candidate.php';

Class IndexController extends Controller{

	/* Function loadAllCandidates
     * Get all candidate from cadidate table
     */
	public function loadAllCandidates(){
		$candidates = new Candidate($this->dbconfig);
		return $candidates->getCandidates();
	}
}

// -------------------------------------------------------
session_start();
$controller = new IndexController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllCandidates();