<?php 
require_once 'Controller.php';
require_once 'PHPMailer.php';
require_once '../assets/helpers.php';
require_once '../model/settings.config.php';
require_once '../model/Candidate.php';

Class PHPMailerController extends Controller{

  private $candidate;

  public function __construct($dbconfig){
    parent::__construct($dbconfig);
    $this->candidate = new Candidate($dbconfig);
  }

  /* Function validateSession
     * Checks if a session is valid or redirects
     */
  public function validateSession(){
    parent::validateSession();
  }

  public function mail(){
    # code...
  }

  
}
//--------------------------------------------------------------
session_start();
$controller = new ExportController($dbconfig);
$controller->validateSession();

if (isset($_POST['export']) && $_POST['export']=='export') {
  $controller->gerCSV($_POST['insc-date']);
}