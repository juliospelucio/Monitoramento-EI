<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'Controller.php';
require_once '../assets/helpers.php';
require_once '../model/settings.config.php';
require_once '../model/User.php';
require_once '../assets/lib/PHPMailer.php';
require_once '../assets/lib/Exception.php';
require_once '../assets/lib/SMTP.php';


Class MailController extends Controller {

  private $user;

  public function __construct($dbconfig){
    parent::__construct($dbconfig);
    $this->user = new User($dbconfig);
  }

  /* Function validateSession
   * Checks if a session is valid or redirects
   */
  public function validateSession(){
    parent::validateSession();
  }

  /* Function checkMail
   * Checks if the mail is valid in database
   * @return a user if its found on the database
   */
  private function checkMail($mail){
    return $this->user->confMail($mail);
  }

  /* Function setNewPassWord
   * Set a new password to the user
   * @return a new password
   */
  private function setNewPassWord($id){

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }

    $newPassword = implode($pass); //turn the array into a string
    $encPassword = md5($newPassword);//encrypt
    
    $fields = array('id'=>$id,'password'=>$encPassword);
    $this->user->updateUser($fields);
    return $newPassword;
  }

  /* Function send
   * send a new password to the user
   * @param $email user's email
   */
  public function send($email){
    $mail = new PHPMailer(true);

    //Check mail
    $user = $this->checkMail($email);
    $user = array_pop($user);
    if (!$user) {
      $dados = array('msg' => 'Email inexistente', 'type' => parent::$error);
      $_SESSION['data'] = $dados;
      header('location: ../view/login.php');
      exit;
    }

    $newpassword = $this->setNewPassWord($user['id']);
    
    //Encoding
    $mail->CharSet ='UTF-8';
    $mail->Encoding = 'base64';

    try {
      //Server settings
      // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
      $mail->isSMTP();                                            // Set mailer to use SMTP
      $mail->Host       = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = '';    // SMTP username
      $mail->Password   = '';                               // SMTP password
      $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
      $mail->Port       = 587;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('diretoria.pedagogia.machado@gmail.com', 'MVEI - Machado');
      $mail->addAddress($user['email'], $user['name']);     // Add a recipient
      // $mail->addAddress('ellen@example.com');               // Name is optional
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      // Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Recuperação de Senha';
      $mail->Body    = "Olá ".$user['name'].", sua nova senha para acesso: <b>$newpassword</b>";
      $mail->AltBody = 'Olá <name>, sua nova senha para acesso: <password>';

      $dados = array('msg' => 'Dentro de minutos um email de recuperação será enviado para: .'.$user['email'], 'type' => parent::$success);
      $_SESSION['data'] = $dados;
      header('location: ../view/login.php');
      $mail->send();
      exit;
    } catch (Exception $e) {
      // echo "E-mail não enviado. Mailer Error: {$mail->ErrorInfo}";
      $dados = array('msg' => 'Erro: E-mail não enviado!', 'type' => parent::$error);
      $_SESSION['data'] = $dados;
      header('location: ../view/login.php');
      exit;
    }
  }
}
//--------------------------------------------------------------
session_start();
$controller = new MailController($dbconfig);
$controller->send($_POST['email']);