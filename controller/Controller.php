<?php

Class Controller {

	protected $dbconfig;

	protected $attributes;

	protected static $error = "Erro";

	protected static $success = "Sucesso";

	public function __construct($dbconfig){
		$this->dbconfig = $dbconfig;
	}

	/* Function validateSession
     * Checks if a session is valid or redirects
     */
	public function validateSession(){
		if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
			unset($_SESSION['id']);
			unset($_SESSION['name']);
			unset($_SESSION['admin']);
			session_destroy();
			header('location: '. myURL().'view/login.php');
			exit;
		}
	}
}