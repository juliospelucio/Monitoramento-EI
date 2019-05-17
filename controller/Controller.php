<?php

abstract Class Controller {

	protected $dbconfig;

	protected $attributes;

	public $filename;

	protected static $error = "Erro";

	protected static $success = "Sucesso";

	public function __construct($dbconfig){
		$this->dbconfig = $dbconfig;
	}

	/* Function validateSession
     * Checks if a session is valid or redirects
     */
	protected function validateSession(){
		if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
			unset($_SESSION['id']);
			unset($_SESSION['name']);
			unset($_SESSION['admin']);
			session_destroy();
			header('location: '. myURL().'view/login.php');
			exit;
		}
	}

	/* Function checkFields
     * Checks fields that comes from new_unit form, if not redirects back to new_unit form
     * @param $fields array with form's fields
     */
	protected function checkFields($fields){
		foreach ($fields as $field) {
			if (!isset($field)) {
				$dados = array('msg' => 'Todos os campos são necessários', 'type' => $this->error);
				$_SESSION['data'] = $dados;
				header('location: ../view/error.php'/*.$this->filename*/);
				exit;
			}
		}
	}
}