<?php 

require('../model/dbTable/DbTableCarregamento.php');


class ControllerCarregamento{

	// private $dbTableCarregamento;

	public function __construct(){
		// $dbTableCarregamento = new DbTableCarregamento();

		// echo $this->$dbTableCarregamento->listar();
		
	}

		
	

	public listar(){
		echo "eco";

	}

	public function salvar(){

	}

	public function editar(){

	}
	public function excluir(){

	}



 }

 $instancia = new ControllerCarregamento();

 $instancia->listar();
?>