<?php
require_once 'Controller.php';
require_once '../model/settings.config.php';
require_once '../model/User.php';

Class LoginController extends Controller{

	private $user;

	public function __construct($dbconfig){
		parent::__construct($dbconfig);
		$this->user = new User($dbconfig);
	}

	/* Function isAdmin
     * Checks if is a system administrator
     */
	public function isAdmin(){
		parent::isAdmin();
	}

	/* Function isSigned
     * Checks if form is submitted
     * @return boolean true if is signed.
     */
	public function isSigned(){
		if(isset($_POST['signed'])) { // comes from login form
			$attributes = array('email'=>$_POST['email'],'password'=>md5($_POST['password']));
			// parent::checkFields($attributes);
			$this->user->setAttributes($attributes);
			return true;
		}
		return false;
	}

	/* Function login
     * Checks if a user exist in data base and redirects
     */
	public function login(){
		$this->user = $this->user->checkCredentials();
		$this->user = array_pop($this->user);
		if($this->user) {
			$_SESSION['id'] = $this->user['id'];
			$_SESSION['name'] = $this->user['name'];
			$_SESSION['admin'] = $this->user['admin'];
			$this->isAdmin();
	  		header('location: ../view/home.php');
	  		exit;
	  	}
		$dados = array('msg' => 'Usuário ou senha incorreto!', 'type' => parent::$error);
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
	$controller->login();
}

//Realiza logoff
if (isset($_GET['logoff'])) {
	$controller->logoff();
}