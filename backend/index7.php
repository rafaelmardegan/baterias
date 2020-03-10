<?php 
  $DB_host="localhost:3306";
  $DB_login="root";
  $DB_pass="";
  $DB_db="baterias";
  
//php 7
 $conexao = "";
 $conexao = mysqli_connect($DB_host,$DB_login ,$DB_pass);
 $x = mysqli_select_db($conexao, $DB_db);

 

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	
   
    	
 switch ($_POST['funcao']) {
  	case 'listar':
  		
  		listar($conexao, $_POST['parametro']);
  		
  		break;
  	case 'inserir':
  		
  		inserir($conexao);
  		
  		break;
  	case 'buscarId':
  		
  		buscarId($conexao);
  		
  		break;
  	case 'editar':
  		
  		editar($conexao);
  		
  		break;
    case 'setParametro':
    
      setParametro($conexao, $_POST['parametro']);

      break;  
  	default:
		echo "***ACESSO RESTRITO***";
	
  		break;
  }
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
  getParametro($conexao);
}
else{
	echo "NO REQUEST";
  // listar($conexao);
}


  function listar($conexao, $parametro){
    $query1 = "SELECT * FROM carregamentos";
    $query2 = "SELECT * FROM carregamentos where retirada = 0 ";

    $listar = "";
    if ($parametro == 0) {
      $listar = mysqli_query($conexao, $query2);
      
    } else {
      $listar = mysqli_query($conexao, $query1);
      
    }
  	// $listar = mysqli_query($conexao, $query1);
  	$cont = 0;
  	while ($dados = mysqli_fetch_array($listar)) {
      $dataSaida = "N/I";
  		if ($dados['dataSaida'] != null) {

        $dataSaida = data($dados['dataSaida']);
      }
  		$registro  = array(
		'cliente' => $dados['cliente'],
		'telefone' => $dados['telefone'],
		'numeroPlaca' => $dados['numeroPlaca'],
		'pagamento' => $dados['pagamento'],
		'dataEntrada' => data($dados['dataEntrada']),
		'id' => $dados['id'],
		'dataSaida' => $dataSaida,
    'retirada' => $dados['retirada'],
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
		'retirada' => $dados['retirada'],
    'dataSaida' => $dados['dataSaida'],
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
  function editar($conexao){
    $dataEntrada = '';
    $dataSaida = '';

    // if ($_POST['dataEntrada']=='') {
    //   $dataEntrada = null;
    // }
    if ($_POST['dataSaida']=='') {
      $dataSaida = "NULL";
    }
    else{
      $dataSaida = "'".$_POST['dataSaida']."'";
    }

    $cliente = $_POST['cliente'];
    $telefone = $_POST['telefone'];
    $numeroPlaca = $_POST['numeroPlaca'];
    $dataEntrada = $_POST['dataEntrada'];
    $pagamento = $_POST['pagamento'];
    $emprestimo = $_POST['emprestimo'];
    $retirada = $_POST['finaliza'];
    // $dataSaida = $_POST['dataSaida'];
    $id = $_POST['id'];


   mysqli_query($conexao, "UPDATE carregamentos set cliente = '$cliente', telefone = '$telefone', numeroPlaca = ' $numeroPlaca', dataEntrada = '$dataEntrada', pagamento = $pagamento, emprestimo = $emprestimo, retirada = $retirada, dataSaida = $dataSaida where id = $id"); 
 
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

  function getParametro($conexao){
    $init = mysqli_query($conexao, "SELECT mostrarFinalizados from parametro where id = 1");
    $init = mysqli_fetch_array($init);
    echo (int )$init['mostrarFinalizados'];
  }

  function setParametro($conexao, $param){
    $edit = mysqli_query($conexao, "UPDATE parametro set mostrarFinalizados = $param where id = 1");
  }

  function data($data){
    return date("d/m/Y", strtotime($data));
}
  

   

 ?>