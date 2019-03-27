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