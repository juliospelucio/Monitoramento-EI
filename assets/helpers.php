<?php 
/*Absolute Path*/
function abspath(){
	return dirname(__DIR__);
}

function myURL(){
	return 'http://localhost/Monitoramento-EI/';
}


/*Checks if the session OK*/
function validateSession(){
	if (!isset($_SESSION['id']) || !isset($_SESSION['name']) /*|| $_SESSION['last_activity'] < time() SESSEION TIMOUT*/) {
		unset($_SESSION['id']);
		unset($_SESSION['name']);
		session_destroy();
		header('location: '. myURL().'view/login.php');
		exit;
	}
}

/*Checks if is a system administrator*/
function isAdmin(){
	if (!($_SESSION['admin']==1)) {
		header('location: '. myURL(). 'view/index.php');
        exit;
	}
}


/*Clear all spaces and standardize a string*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/*Transform a number to DB insertion*/
function numberTransform($string) {
   $string = str_replace('-', '', $string); // Replaces all hyphens.

   return preg_replace('/[^0-9\-]/', '', $string); // Number transform.
}

function telephoneFormater($number){
        if(strlen($number) == 10){
            $new = substr_replace($number, '(', 0, 0);
            $new = substr_replace($new, '9', 3, 0);
            $new = substr_replace($new, ')', 3, 0);
            $new = substr_replace($new, '-', 9, 0);
        }else if(strlen($number) == 8) {
            $new = substr_replace($number, '-', 4, 0);
        }else{
            $new = substr_replace($number, '(', 0, 0);
            $new = substr_replace($new, ')', 3, 0);
            $new = substr_replace($new, '-', 7, 0);
        }
        return $new;
}

//Format a date
function stringToDate($dbDate){
    return date("d/m/Y",strtotime($dbDate));
}

/*Return a formated date (Pt-br)*/
function formatDate($string){
    
    $dia_sem= date('w', strtotime($string));

    if($dia_sem == 0){
    $semana = "Domingo";
    }elseif($dia_sem == 1){
    $semana = "Segunda-feira";
    }elseif($dia_sem == 2){
    $semana = "Terça-feira";
    }elseif($dia_sem == 3){
    $semana = "Quarta-feira";
    }elseif($dia_sem == 4){
    $semana = "Quinta-feira";
    }elseif($dia_sem == 5){
    $semana = "Sexta-feira";
    }else{
    $semana = "Sábado";
    }

 	$dia= date('d', strtotime($string));

	$mes_num = date('m', strtotime($string));
 	if($mes_num == 01){
    $mes= "Janeiro";
    }elseif($mes_num == 02){
    $mes = "Fevereiro";
    }elseif($mes_num == 03){
    $mes = "Março";
    }elseif($mes_num == 04){
    $mes = "Abril";
    }elseif($mes_num == 05){
    $mes = "Maio";
    }elseif($mes_num == 06){
    $mes = "Junho";
    }elseif($mes_num == 07){
    $mes = "Julho";
    }elseif($mes_num == "08"){//erro ao utilizar zero a esquerda, use strings ou remova o zero
    $mes = "Agosto";
    }elseif($mes_num == 9){//erro ao utilizar zero a esquerda, use strings ou remova o zero
    $mes = "Setembro";
    }elseif($mes_num == 10){
    $mes = "Outubro";
    }elseif($mes_num == 11){
    $mes = "Novembro";
    }else{
    $mes = "Dezembro";
    }

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));
 
    return $semana.', '.$dia.' de '.$mes.' de '.$ano.' as '.$hora;
}

/*Activates a modal success or error*/
function triggerModal(){
    if ($_SESSION['data']['type']=="Erro") {
        include_once abspath()."/view/template/modalError.php";
    } else if ($_SESSION['data']['type']=="Sucesso") {
        include_once abspath()."/view/template/modalSuccess.php";
    }
    unset($_SESSION['data']);
}

//Difference between two dates %a=days
function dateDifference($date_1, $date_2, $differenceFormat = '%a'){

    $datetime1 = date_create($date_1, timezone_open('America/Sao_Paulo'));
    $datetime2 = date_create($date_2, timezone_open('America/Sao_Paulo'));
    
    $interval = date_diff($datetime1, $datetime2);

    if ($interval->format($differenceFormat) == 0) {// checks if is lower than a year
        $differenceFormat = '%m Meses';
    }
    
    return $interval->format($differenceFormat);  
}

function formatTel($number){
    if(strlen($number) == 10){
        $new = substr_replace($number, '(', 0, 0);
        $new = substr_replace($new, ')', 3, 0);
        $new = substr_replace($new, ' ', 4, 0);
        $new = substr_replace($new, '-', 9, 0);
        $new = substr_replace($new, ' 9', 5, 0);

    }else{
        $new = substr_replace($number, '(', 0, 0);
        $new = substr_replace($new, ')', 3, 0);
        $new = substr_replace($new, '-', 9, 0);
        $new = substr_replace($new, ' ', 4, 0);
    }
    return $new;
}
