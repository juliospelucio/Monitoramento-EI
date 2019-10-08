<?php
require_once '../assets/helpers.php';
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

	/* Function isAdmin
	 * Checks if is a system administrator and block access to diretor pages
     */
	protected function isAdmin(){
		if (($_SESSION['admin']==1)) {
			header('location: '. myURL(). 'view/index.php');
	        exit;
		}
	}

	/* Function notAdmin
	 * Checks if is not a system administrator block access to administrator pages
     */
	protected function notAdmin(){
		if (!($_SESSION['admin']==1)) {
			header('location: '. myURL(). 'view/home.php');
	        exit;
		}
	}

	/* Function checkFields
     * Checks fields that comes from new_unit form, if not redirects back to new_unit form
     * @param $fields array with form's fields
     */
	protected function checkFields($fields){
		foreach ($fields as $field) {
			if (empty($field)) {
				$dados = array('msg' => 'Todos os campos são necessários', 'type' => $this->error);
				$_SESSION['data'] = $dados;
				header('location: ../view/'.$this->filename);
				exit;
			}
		}
	}

	/* Function importHeader
     * Returns a header path by using user admin or not
     * @param $admin status of the current user in session
     */
	protected function importHeader($admin){
	    if($admin)
	    	return 'template/header.php';
	    return 'template/header_dir.php';
	}
}