<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fernando Baterias</title>
     
    <link href="./cdn/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="./cdn/icons/font/css/open-iconic-foundation.css" rel="stylesheet">
    <link href="./css/estilo.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="./cdn/datatables/datatables.css">
    <link rel="stylesheet" href="./cdn/datatables/DataTables/css/responsive.dataTables.css">
    <link rel="stylesheet" href="./cdn/sweetalert2/css/sweetalert2.css">
   <link href="https://fonts.googleapis.com/css?family=Sacramento&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet"> 
    


</head>
  <body >
    <div class="row-fluid side">
        <div class="container-fluid">            
             <div class="col-sm-12">
                <nav class="navbar">
                    <strong>
                      <center>
                        <div class="titulo">
                          Controle do carregamento de baterias
                        </div>
                        <div>
                          
                        </div>
                      </center>
                      
                    </strong><!-- <h2 >Fernando Baterias</h2> -->
                  <img src="./imagens/bat.png" width="180" height="62"  alt="">

                </nav>
            </div>
           
        </div>
    </div>



    <div class="container-fluid">
      <button class="btn btnForm" id="mostrarForm" type="button"><span class='fi-plus'></span> Registrar bateria</button>
    </div>    
      <div class="container form" id="form">
        <div class="form-row">
          
        <div class="col-sm-6">
          <div class="form-group">
            <label for="cliente">Cliente</label>
            <input type="text" class="form-control" id="cliente" >

          </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="text" class="form-control" id="telefone">
        </div>
          </div>
        <div class="col-sm-2" id="pag" >
        <div class="form-group" >
          <label for="Pagamento" class="pag">Pagamento</label>
<div class="custom-control custom-checkbox pag mr-sm-2" >
        <input  type="checkbox" class="custom-control-input check" id="customControlAutosizingPagamento" >
        <label class="custom-control-label lbPag" id="labelCheck" for="customControlAutosizingPagamento">PAGO</label>
      </div>
        </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="cliente">Número da placa</label>
              <input type="text" class="form-control" id="numeroPlaca" >

            </div>
          </div>
          <div class="col-sm-4">
          <div class="form-group">
            <label for="telefone">Data de entrada</label>
            <input type="date" class="form-control" id="dataEntrada">
          </div>
            </div>
          <div class="col-sm-2" id="emp" >
          <div class="form-group" >
            <label for="Pagamento" class="pag">Empréstimo de bateria</label>
          <div class="custom-control custom-checkbox emp mr-sm-2" >
          <input  type="checkbox" class="custom-control-input checkEmp" id="customControlAutosizingEmprestimo" >
          <label class="custom-control-label lbEmp" id="labelCheck" for="customControlAutosizingEmprestimo">Não</label>
        </div>
          </div>
            </div>

        </div>
 
        <button type="button" class="btn btn-block btnForm salvar">
          <svg id="i-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 38" width="28" height="28" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="M2 20 L12 28 30 4" />
          </svg>
          Salvar
        </button>                      
      </div>

      <div class="container-fluid form">
        <table id="tabela" class="table display responsive nowrap table-striped" >
        <thead>
            <tr>
               
                <th data-priority="1" >Cliente</th>
                <th  data-priority="7">Telefone</th>
                <th data-priority="2" >Número da placa</th>
                <th  data-priority="3">Data da entrada</th>
                <th  data-priority="4">Empréstimo</th>
                <th data-priority="5">Pagamento</th>
                <th data-priority="6">Editar</th>
            </tr>
        </thead>
                 
        </table>
      </div>
  <footer>
    <center>
      Desenvolvido por <a href="https://www.instagram.com/mardebrahma/" target="blank" id="dev">Rafael Mardegan
      </a>      
    </center>
  </footer>
    <script src="./cdn/axios/axios.min.js"></script>
    <script src="./cdn/jquery/jquery-3.4.1.min.js"></script>
    <script src="./cdn/bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="./cdn/mask/mask.js"></script>
    <script src="./cdn/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="./cdn/datatables/datatables.js"></script>
    <script src="./cdn/datatables/DataTables/js/dataTables.responsive.js"></script>
    <script src="./cdn/sweetalert2/js/sweetalert2.js"></script>
    <script src="./js/index.js"></script>

  </body>
</html>
