<?php 

class ModelCarregamento{
	
	private $id = "";
	private $cliente = "";
	private $telefone = "";
	private $pagamento = "";
	private $numeroPlaca = "";
	private $dataEntrada = "";
	private $dataSaida = "";
	private $emprestimo = "";
	private $retirada = "";


	public function __construct(){
       

        $this->cliente->setCliente("kkk");
	}

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     *
     * @return self
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     *
     * @return self
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPagamento()
    {
        return $this->pagamento;
    }

    /**
     * @param mixed $pagamento
     *
     * @return self
     */
    public function setPagamento($pagamento)
    {
        $this->pagamento = $pagamento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroPlaca()
    {
        return $this->numeroPlaca;
    }

    /**
     * @param mixed $numeroPlaca
     *
     * @return self
     */
    public function setNumeroPlaca($numeroPlaca)
    {
        $this->numeroPlaca = $numeroPlaca;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

    /**
     * @param mixed $dataEntrada
     *
     * @return self
     */
    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataSaida()
    {
        return $this->dataSaida;
    }

    /**
     * @param mixed $dataSaida
     *
     * @return self
     */
    public function setDataSaida($dataSaida)
    {
        $this->dataSaida = $dataSaida;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmprestimo()
    {
        return $this->emprestimo;
    }

    /**
     * @param mixed $emprestimo
     *
     * @return self
     */
    public function setEmprestimo($emprestimo)
    {
        $this->emprestimo = $emprestimo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetirada()
    {
        return $this->retirada;
    }

    /**
     * @param mixed $retirada
     *
     * @return self
     */
    public function setRetirada($retirada)
    {
        $this->retirada = $retirada;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}


 ?>
