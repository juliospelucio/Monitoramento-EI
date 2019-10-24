<?php
/* 
 * Database Connection Settings
 */
$dbconfig = array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'dbname' => 'infantil_education_mch',
	'username' => 'root',
	'password' => '',
	'options'=> array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
/*$dbconfig = array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'dbname' => 'id8851733_infantil_education_mch',
	'username' => 'id8851733_pedagogic',
	'password' => 'direpedagogia',
	'options'=> array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));*/