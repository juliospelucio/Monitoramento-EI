<?php
	
require_once 'DBConnection.php';
require_once '../model/settings.config.php';


$pdo = new DBConnection($dbconfig);
if(!$pdo){
    die('Erro ao iniciar a conexão');
}
 
$pdo->beginTransaction();/* Inicia a transação */
$usuario = $pdo->query("INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`) VALUES (NULL, 'User', 'user@gmail.com', '123', '0');");
 
if(!$usuario){
    die('Erro ao inserir usuário'); /*É disparado em caso de erro na inserção do usuário*/
}

$uId = $pdo->lastInsertId();
 
$atualiza_usuario = $pdo->query("UPDATE `users` SET `name` = 'fox' WHERE id = $uId");
 
if(!$atualiza_usuario){
    $pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
    die('Erro ao atualizar usuário'.$uId);
}


 
$pdo->commit(); /* Se não houve erro nas querys, confirma os dados no banco */
echo 'Lançamento efetuado com sucesso!';
echo '<br>';
echo 'User id: '.$uId;

?>