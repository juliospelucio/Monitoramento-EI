<?php
require_once 'Controller.php';
require_once('..\model\settings.config.php');
require_once '..\model\Candidate.php';

Class IndexController extends Controller{

	/* Function validateSession
     * Checks if a session is valid or redirects
     */
	public function validateSession(){
		parent::validateSession();
	}

	/* Function checkFields
     * Checks fields that comes from new_unit form, if not redirects back to new_unit form
     * @param $fields array with form's fields
     */
	public function checkFields($fields){
		parent::checkFields($fields);
	}

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
validateSession();
$controller = new IndexController($dbconfig);
$controller->validateSession();
$rows = $controller->loadAllCandidates();