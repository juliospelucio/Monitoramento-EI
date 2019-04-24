<?php
require_once 'Controller.php';
require_once('..\model\settings.config.php');
require_once '..\model\User.php';

Class LoginController extends Controller{

	private $email;

	private $password;

	public function __toString(){
		return $this->email."<br>".$this->password;
	}

	/* Function isSigned
     * Checks if form is submitted
     * @return boolean true if is signed.
     */
	public function isSigned(){
		if(isset($_POST['signed'])) { // comes from login form
			$this->email = $_POST['email'];
			$this->password = $_POST['password'];
			return true;
		}
		return false;
	}

	/* Function checkFields
     * Checks fields that comes from login form, if not redirects back to login form
     * @param $fields array with form's fields
     */
	public function checkFields($fields){
		foreach ($fields as $field) {
			if (!isset($field)) {
				$dados = array('msg' => 'Todos os campos são necessários', 'type' => $error);
				$_SESSION['data'] = $dados;
				header('location: ../view/login.php');
				exit;
			}
		}
	}

	/* Function login
     * Checks if a user exist in data base and redirects
     */
	public function login(){
		$user = User::checkCredentials($this->dbconfig,$this->email,$this->password);
		$user = array_pop($user);
		if($user != null) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['name'] = $user['name'];
			$_SESSION['admin'] = $user['admin'];
	  		header('location: ../view/index.php');
	  		exit;
	  	}
		$dados = array('msg' => 'Usuário ou senha incorreto!', 'type' => $error);
		$_SESSION['data'] = $dados;
		header('location: ../view/login.php');
  		exit;
	}

	/* Function logoff
     * Redirects to view.login and destroy session
     */
	public function logoff(){
		session_destroy();
		header('location: ../view/login.php');
		exit;
	}
	
}

// -------------------------------------------------------
session_start();
$controller = new LoginController($dbconfig);

//Realiza login
if ($controller->isSigned()) {
	$fields = array($_POST['email'],$_POST['password']);
	$controller->checkFields($fields);
	$controller->login();
}

//Realiza logoff
if (isset($_GET['logoff'])) {
	$controller->logoff();
}