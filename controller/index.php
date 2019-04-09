<?php 
require_once('../model/settings.config.php');
require_once('../model/Address.php');
require_once('../model/User.php');


//ADDRESS
//---------------------------------------------------------
$address = new Address($dbconfig);
$address->setAttributes(array("address"=>"Rua1","number"=>1,"neighborhood"=>"Bairro1"));
echo $address;

echo "<pre>";
// print_r($address->getAddresses());
echo "-------------------------<br>";
print_r($address->getAddress(1));
echo "-------------------------<br>";
// print_r($address->insertAddress());
echo "-------------------------<br>";
// print_r($address->deleteAddress(3));
echo "-------------------------<br>";
// print_r($address->updateAddress(array(":id"=>1,":address"=>"RuaUpdate",":number"=>5,":neighborhood"=>"BairroUpdate")));
echo "</pre>";

//ADDRESS END
//------------------------------------------------------------


//USERS
//---------------------------------------------------------
$user = new User($dbconfig);
$user->setAttributes(array("name"=>"usuário","email"=>"usuário@gmail.com","password"=>"123","admin"=>1));

echo "<pre>";
// print_r($user->getUsers());
echo "-------------------------<br>";
// print_r($user->getUser(1));
echo "-------------------------<br>";
// print_r($user->insertUser());
echo "-------------------------<br>";
// print_r($user->deleteUser(4));
echo "-------------------------<br>";
// print_r($user->updateUser(array(":id"=>4,":name"=>"Julio",
// 								":email"=>"julio@gmailcom",
// 								":password"=>"12345",
// 								":admin"=>0,
// 								":units_id"=>2)));
echo "-------------------------<br>";
echo "</pre>";
//USERS END
//------------------------------------------------------------


