<?php 
  $DB_host="localhost";
  $DB_login="root";
  $DB_pass="a571";
  $DB_db="baterias";
  
  mysql_connect($DB_host,$DB_login ,$DB_pass) or die (mysql_error());
  mysql_select_db($DB_db) or die (mysql_error()); 


  switch ($_POST['funcao']) {
  	case 'listar':
  		
  		listar();
  		
  		break;
  	case 'inserir':
  		
  		inserir();
  		
  		break;
  	case 'buscarId':
  		
  		buscarId();
  		
  		break;
  	case 'editar':
  		
  		editar();
  		
  		break;
  	default:
		echo "***ACESSO RESTRITO***";
		// listar();
  		break;
  }


  function listar(){
  	$listar = mysql_query("SELECT * FROM carregamentos");
  	$registros['data'];
  	$cont = 0;
  	while ($dados = mysql_fetch_array($listar)) {
  		
  		$registro  = array(
		'cliente' => $dados[cliente],
		'telefone' => $dados[telefone],
		'numeroPlaca' => $dados[numeroPlaca],
		'pagamento' => $dados[pagamento],
		'dataEntrada' => $dados[dataEntrada],
		'id' => $dados[id],
		// 'retirada' => $dados[retirada],
		'emprestimo' => $dados[emprestimo]);


		$registros[$cont] = $registro;
		$cont++;
  	}

	
	echo json_encode($registros);
  }

  function buscarId(){
  	$id = $_POST['id'];
  	$listar = mysql_query("SELECT * FROM carregamentos where id = $id ");
  	$registro;
  	while ($dados = mysql_fetch_array($listar)) {
  		
  		$registro  = array(
		'cliente' => $dados[cliente],
		'telefone' => $dados[telefone],
		'numeroPlaca' => $dados[numeroPlaca],
		'pagamento' => $dados[pagamento],
		'dataEntrada' => $dados[dataEntrada],
		'id' => $dados[id],
		// 'retirada' => $dados[retirada],
		'emprestimo' => $dados[emprestimo]);

  	}

	
	echo json_encode($registro);
  }

  function inserir(){
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