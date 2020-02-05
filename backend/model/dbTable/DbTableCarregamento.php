<?php 

require('../ModelCarregamento.php');

class DbTableCarregamento{


	private $modelCarregamento;


	public function __construct(){



	   $modelCarregamento  = new ModelCarregamento();

		
		}

		public function listar(){
			$cliente = $this->modelCarregamento->getCliente();

			return $cliente;
		}
	public function conexao(){

				$link = mysqli_connect("localhost", "ocomon", "@cesso87200", "ocomon");
	 
		if (!$link) {
		    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}
		 
		echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;
		 
		mysqli_close($link);

	}
}






 ?>
