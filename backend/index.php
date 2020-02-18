<?php 
  $DB_host="localhost";
  $DB_login="root";
  $DB_pass="a571";
  $DB_db="baterias";
  
  mysql_connect($DB_host,$DB_login ,$DB_pass) or die (mysql_error());
  mysql_select_db($DB_db) or die (mysql_error()); 

  

  
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
  	
  	$listar = mysql_query("SELECT * FROM carregamentos");
  	$registros = array();
  	while ($dados = mysql_fetch_array($listar)) {
  		$registro = array(
		'cliente' => $dados[cliente],
		'telefone' => $dados[telefone],
		'numeroPlaca' => $dados[numeroPlaca],
		'pagamento' => $dados[pagamento],
		'dataEntrada' => $dados[dataEntrada],
		'retirada' => $dados[retirada],
		'emprestimo' => $dados[emprestimo]);

		array_push($registros, $registro);
  	}

	
	echo json_encode($registros);
	
  }
  elseif ($_POST['funcao'] == "editar"){
  	# code...
  }
  elseif( $_POST['funcao'] == "inserir"){
  	
	$cliente = $_POST['cliente'];
	$telefone = $_POST['telefone'];
 	$numeroPlaca = $_POST['numeroPlaca'];
    $dataEntrada = $_POST['dataEntrada'];
	$pagamento = $_POST['pagamento'];
	$emprestimo = $_POST['emprestimo'];
	$retirada = 0;

	 mysql_query("INSERT INTO carregamentos (cliente, telefone, numeroPlaca, dataEntrada, pagamento, emprestimo, retirada)
		VALUES ('$cliente', '$telefone', '$numeroPlaca', '$dataEntrada', $pagamento, $emprestimo, $retirada)");

	$registro = array(
		'cliente' => $cliente,
		'telefone' => $telefone,
		'numeroPlaca' => $numeroPlaca,
		'pagamento' => $pagamento,
		'dataEntrada' => $dataEntrada,
		'retirada' => $retirada,
		'emprestimo' => $emprestimo );

	echo json_encode($registro);
  }
  
  

 


   

 ?>