<?php 
header('Cache-Control: no-cache, must-revalidate'); 
header('Content-Type: application/json; charset=utf-8');

	// $json = json_decode($_POST['dados']);
	// echo $json;
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
var_dump($nome);
echo $nome;
echo $telefone;


 ?>