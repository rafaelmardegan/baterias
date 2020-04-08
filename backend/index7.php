<?php 
  $DB_host="localhost:3306";
  $DB_login="root";
  $DB_pass="fernandobaterias5";
  $DB_db="baterias";
  
//php 7
 $conexao = "";
 $conexao = mysqli_connect($DB_host,$DB_login ,$DB_pass);
 $x = mysqli_select_db($conexao, $DB_db);

require_once('PhpMailer/PHPMailer.php'); 
require_once('PhpMailer/SMTP.php'); 
require_once('PhpMailer/Exception.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// inserir($conexao);
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
    case 'backup':
      
      backup($conexao);

      break;    
  	default:
		echo "***ACESSO RESTRITO***";
	
  		break;
  }
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
  getParametro($conexao);
  // backup($conexao);
}
else{
	echo "NO REQUEST";
  // listar($conexao);
}


  function listar($conexao, $parametro){
    $query1 = "SELECT * FROM carregamentos order by id desc";
    $query2 = "SELECT * FROM carregamentos where retirada = 0 order by id desc ";

    $listar = "";
    if ($parametro == 0) {
      $listar = mysqli_query($conexao, $query2);
      
    } else {
      $listar = mysqli_query($conexao, $query1);
      
    }
  	// $listar = mysqli_query($conexao, $query1);
  	$cont = 0;
  	while ($dados = mysqli_fetch_array($listar)) {
      $dataSaida = "-";
  		if ($dados['dataSaida'] != null) {

        $dataSaida = data($dados['dataSaida']);
      }
  		$registro  = array(
		'cliente' => $dados['cliente'],
		'telefone' => $dados['telefone'],
		'numeroPlaca' => $dados['numeroPlaca'],
    'pagamento' => $dados['pagamento'],
    'marca' => $dados['marca'],
		'amperagem' => $dados['amperagem'],
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
    'marca' => $dados['marca'],
    'amperagem' => $dados['amperagem'],
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
    $marca = $_POST['marca'];
	  $amperagem = (int )$_POST['amperagem'];
	  $retirada = 0;

	 mysqli_query($conexao, "INSERT INTO carregamentos (cliente, telefone, numeroPlaca, dataEntrada, marca, amperagem, pagamento, emprestimo, retirada)
		VALUES ('$cliente', '$telefone', '$numeroPlaca', '$dataEntrada', '$marca', $amperagem, $pagamento, $emprestimo, $retirada)");

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
    $marca = $_POST['marca'];
    $amperagem = $_POST['amperagem'];
    $retirada = $_POST['finaliza'];
    $id = $_POST['id'];


   mysqli_query($conexao, "UPDATE carregamentos set cliente = '$cliente', telefone = '$telefone', numeroPlaca = '$numeroPlaca', dataEntrada = '$dataEntrada', marca = '$marca', amperagem = '$amperagem', pagamento = $pagamento, emprestimo = $emprestimo, retirada = $retirada, dataSaida = $dataSaida where id = $id"); 
 
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

  function backup($conexao){
    $backupFile = "backupBaterias-" . date("Y-m-d") . ".sql";
   
  system("mysqldump  -uroot -pfernandobaterias5 baterias > C:/backupBaterias/$backupFile");

  enviaEmail();

  }

  function enviaEmail(){

    $mail = new PhpMailer(true);

    try {
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'rafael.bakups@gmail.com';
      $mail->Password = 'sistemasBackup$89';
      $mail->Port = 587;
      $mail->setFrom('rafael.bakups@gmail.com');
      $mail->addAddress('rafael.bakups@gmail.com');
      // $mail->setFrom('rafaelmardegan89@gmail.com');
      // $mail->addAddress('rafaelmardegan89@gmail.com');

      $mail->Subject = "BACKUP SISTEMA DE CARREGAMENTO DE BATERIAS - ".date("d/m/Y");
      $mail->Body = 'Segue em anexo o backup da base de dados do Sistema de Controle de Carregamento de Baterias';
      $mail -> addAttachment ("C:/backupBaterias/backupBaterias-" . date("Y-m-d") . ".sql");
      
      if ($mail->send()) {

        echo "Email enviado com sucesso!";

      } else {

        echo "Email NÃO enviado.";
      }

    } catch (Exception $e) {
      echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";

    }
  }

  function data($data){
    return date("d/m/Y", strtotime($data));
}
  

   

 ?>