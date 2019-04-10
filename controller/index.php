<?php 
require_once('../model/settings.config.php');
require_once('../model/Address.php');
require_once('../model/User.php');
require_once('../model/Parents.php');
require_once('../model/Unit.php');
require_once('../model/Candidate.php');


//ADDRESS
//---------------------------------------------------------
/*$address = new Address($dbconfig);
$address->setAttributes(array("address"=>"Rua1","number"=>1,"neighborhood"=>"Bairro1"));
echo $address;*/

echo "<pre>";
// print_r($address->getAddresses());
echo "-------------------------<br>";
// print_r($address->getAddress(1));
echo "-------------------------<br>";
// print_r($address->insertAddress());
echo "-------------------------<br>";
// print_r($address->deleteAddress(3));
echo "-------------------------<br>";
// print_r($address->updateAddress(array(":id"=>1,":address"=>"RuaUpdate1",":number"=>51,":neighborhood"=>"BairroUpdate1")));
echo "</pre>";
//ADDRESS END
//------------------------------------------------------------


//USERS
//---------------------------------------------------------
/*$user = new User($dbconfig);
$user->setAttributes(array("name"=>"usuário","email"=>"usuário@gmail.com","password"=>"123","admin"=>1));
echo $user;*/

echo "<pre>";
// print_r($user->getUsers());
echo "-------------------------<br>";
// print_r($user->getUser(1));
echo "-------------------------<br>";
// print_r($user->insertUser());
echo "-------------------------<br>";
// print_r($user->deleteUser(2));
echo "-------------------------<br>";
// print_r($user->updateUser(array(":id"=>1,":name"=>"Julio",":email"=>"julio@gmailcom",":password"=>"12345",":admin"=>0)));
echo "-------------------------<br>";
echo "</pre>";
//USERS END
//------------------------------------------------------------


//PARENTS
//---------------------------------------------------------
/*$parents = new Parents($dbconfig);
$parents->setAttributes(array("mother"=>"Maria", "father"=>"João"));
echo $parents;*/

echo "<pre>";
// print_r($parents->getParents());
echo "-------------------------<br>";
// print_r($parents->getParent(1));
echo "-------------------------<br>";
// print_r($parents->insertParent());
echo "-------------------------<br>";
// echo print_r($parents->deleteParent(3));
echo "-------------------------<br>";
// print_r($parents->updateParent(array(":id"=>1,":mother"=>"Joana",":father"=>"Fábio")));
echo "-------------------------<br>";
echo "</pre>";
//PARENTS END
//---------------------------------------------------------

//UNITS
//---------------------------------------------------------
/*$unit = new Unit($dbconfig);
$unit->setAttributes(array("name"=>"SEMED","users_id"=>null));
echo $unit;*/

echo "<pre>";
// print_r($unit->getUnits());
echo "-------------------------<br>";
// print_r($unit->getUnit(1));
echo "-------------------------<br>";
// print_r($unit->insertUnit());
echo "-------------------------<br>";
// print_r($unit->deleteUnit(3));
echo "-------------------------<br>";
// print_r($unit->updateUnit(array(":id"=>4,":name"=>"creche",":users_id"=>1)));
echo "-------------------------<br>";
echo "</pre>";
//UNITS END
//---------------------------------------------------------

//CANDIDATES
//---------------------------------------------------------
/*$candidate = new Candidate($dbconfig);
$candidate->setAttributes(array("name"=>"Junior","birth_date"=>"2017-02-27","tel1"=>32958700,"tel2"=>32958714,"inscription_date"=>date("Y-m-d"),"situation"=> "","units_id"=>4,"parents_id"=>1));
echo $candidate;*/

echo "<pre>";
// print_r($candidate->getCandidates());
echo "-------------------------<br>";
// print_r($candidate->getCandidate(1));
echo "-------------------------<br>";
// print_r($candidate->insertCandidate());
echo "-------------------------<br>";
// print_r($candidate->deleteCandidate(3));
echo "-------------------------<br>";
// print_r($candidate->updateCandidate(array(":id"=>1,"name"=>"Humberto Jr","birth_date"=>"2017-02-27","tel1"=>32958700,"tel2"=>32958714,"inscription_date"=>date("Y-m-d"),"situation"=> "","units_id"=>4,"parents_id"=>1)));
echo "-------------------------<br>";
echo "</pre>";

//ADDRESSES_HAS_CANDIDATES
//---------------------------------------------------------

//ADDRESSES_HAS_CANDIDATES END
//---------------------------------------------------------