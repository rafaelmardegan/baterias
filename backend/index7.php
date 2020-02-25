<?php 
  $DB_host="localhost:3306";
  $DB_login="root";
  $DB_pass="";
  $DB_db="baterias";
  
//php 7
 $k = "";
 $k = mysqli_connect($DB_host,$DB_login ,$DB_pass);
 $x = mysqli_select_db($k, $DB_db);

 

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	
   
    	
 switch ($_POST['funcao']) {
  	case 'listar':
  		
  		listar($k);
  		
  		break;
  	case 'inserir':
  		
  		inserir($k);
  		
  		break;
  	case 'buscarId':
  		
  		buscarId($k);
  		
  		break;
  	case 'editar':
  		
  		editar();
  		
  		break;
  	default:
		echo "***ACESSO RESTRITO***";
		// listar();
  		break;
  }
}
else{
	echo "NO REQUEST";
}


  function listar($conexao){
  	$listar = mysqli_query($conexao, "SELECT * FROM carregamentos");
  	$cont = 0;
  	while ($dados = mysqli_fetch_array($listar)) {
  		
  		$registro  = array(
		'cliente' => $dados['cliente'],
		'telefone' => $dados['telefone'],
		'numeroPlaca' => $dados['numeroPlaca'],
		'pagamento' => $dados['pagamento'],
		'dataEntrada' => data($dados['dataEntrada']),
		'id' => $dados['id'],
		// 'retirada' => $dados[retirada],
		'emprestimo' => $dados['emprestimo']);


		$registros[$cont] = $registro;
		$cont++;
  	}

	
	echo json_encode($registros);
  }

  function buscarId($conexao){
  	$id = $_POST['id'];
  	$listar = mysqli_query($conexao, "SELECT * FROM carregamentos where id = $id ");
  	$registro;
  	while ($dados = mysqli_fetch_array($listar)) {
  		
  		$registro  = array(
		'cliente' => $dados['cliente'],
		'telefone' => $dados['telefone'],
		'numeroPlaca' => $dados['numeroPlaca'],
		'pagamento' => $dados['pagamento'],
		'dataEntrada' => $dados['dataEntrada'],
		'id' => $dados['id'],
		// 'retirada' => $dados[retirada],
		'emprestimo' => $dados['emprestimo']);

  	}

	
	echo json_encode($registro);
  }

  function inserir($conexao){
  	$cliente = $_POST['cliente'];
	$telefone = $_POST['telefone'];
 	$numeroPlaca = $_POST['numeroPlaca'];
    $dataEntrada = $_POST['dataEntrada'];
	$pagamento = $_POST['pagamento'];
	$emprestimo = $_POST['emprestimo'];
	$retirada = 0;

	 mysqli_query($conexao, "INSERT INTO carregamentos (cliente, telefone, numeroPlaca, dataEntrada, pagamento, emprestimo, retirada)
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

  function data($data){
    return date("d/m/Y", strtotime($data));
}
  

   

 ?>