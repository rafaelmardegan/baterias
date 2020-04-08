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
                          CONTROLE DE CARGA
                        </div>
                        <div>
                          
                        </div>
                      </center>
                      
                    </strong><!-- <h2 >Fernando Baterias</h2> -->
                  <img id="imgBat" src="./imagens/bat.png" id="img-bat" width="180" height="62"  alt="">

                </nav>
            </div>
           
        </div>
    </div>

    <div class="container-fluid" id="menu">
      <div class="row">
        <div class="col" style=" display:flex">
          <button class="btn btnForm" id="mostrarForm" title="Registrar um nova bateria para carregar" type="button"><span class='fi-plus'></span> Novo carregamento</button>         
        </div>
        <div class="col colSwitch" >
          <label id="labelSwitch" title="Mostra os carregamentos já finalizados" for="">Mostrar finalizados</label>
          <input id="switch-shadow" class="switch switch--shadow" type="checkbox" >
          <label for="switch-shadow" title="Mostra os carregamentos já finalizados"></label>
        </div>
      </div>
    </div>   
          <div class="container-fluid container-backup" id="label-backup">
        <label ><img src="imagens/preloader.gif" width="50" alt=""> Gerando backup. Aguarde...</label>
      </div>
      <div class="container-fluid container-backup">
        <button type="button"  class="btn btn-sm" id="btn-backup" title="Gera um backup da base de dados e envia por email" onclick="backup()" style="cursor: pointer" title=""><span class='fi-cog'> Gerar backup</span></button>
      </div>
      <div class="container form" id="form">
        <div class="container tituloEditar " id="esconder">INSERINDO NOVO CARREGAMENTO</div>
        <div class="form-row">
          
        <div class="col-sm-6">
          <div class="form-group">
            <form  class="was-validated">
            <label for="cliente">Cliente</label>
            <input required maxlength="40" type="text" class="form-control validar" id="cliente" >
            <div class="invalid-feedback">(campo obrigatório)</div>
          </form>
          </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="text" maxlength="30" class="form-control" id="telefone">
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
               <form  class="was-validated">
              <label for="cliente">Número da placa</label>
              <input required type="text" class="form-control validar" id="numeroPlaca" >
              <div class="invalid-feedback">(campo obrigatório)</div>
              </form>
            </div>
          </div>
          <div class="col-sm-4">
          <div class="form-group">
           <form  class="was-validated">
            <label for="dataEntrada">Data de entrada</label>
            <input required type="date" class="form-control validar" id="dataEntrada">
            <div class="invalid-feedback">(campo obrigatório)</div>
            </form>
          </div>
            </div>
          <div class="col-sm-2" id="emp" >
          <div class="form-group" >
            <label for="emprestimo" class="pag">Empréstimo de bateria</label>
          <div class="custom-control custom-checkbox emp mr-sm-2" >
          <input  type="checkbox" class="custom-control-input checkEmp" id="customControlAutosizingEmprestimo" >
          <label class="custom-control-label lbEmp" id="labelCheck" for="customControlAutosizingEmprestimo">Não</label>
        </div>
          </div>
            </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="cliente">Marca</label>
              <input type="text" class="form-control" id="marca">
            </div>           
          </div>  
          <div class="col-sm-6">
            <label for="cliente">Amperagem</label>
            <div class="input-group">
              <input type="number" class="form-control" id="amperagem">
              <div class="input-group-append">
                <span class="input-group-text">Ah</span>
              </div>
            </div>
          </div>
        </div>
 
        <div class="row">
          <div class="col">
            <button type="button" class="btn btn-block btnForm salvar">
              <svg id="i-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 38" width="28" height="28" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M2 20 L12 28 30 4" />
              </svg>
              Salvar
            </button>   
          </div>
          <div class="col">
            <button type="button" class="btn btn-block btnForm cancelar" onclick="document.location.reload(true)" >
              <span class='fi-x'>
              Cancelar
            </button> 
          </div>
        </div>   
        <div class="form-row row-fim esconder"> 
          <div class="col-sm-12 col-fim">
            <h4>Retirada de Bateria</h4>            
          </div>
          <div class="col-sm"></div>
          <div class="col-sm-2">
          <div class="form-group">
            <label for="dataSaida">Data de saída</label>
            <input type="date" class="form-control" onblur="preenchecheckFinal()" id="dataSaida">
          </div>
            </div>
            <div class="col-sm-2" id="finaliza">
              <div class="form-group" >
                <label for="final" class="pag">Finalizar</label>
                <div class="custom-control custom-checkbox fim mr-sm-2" >
                  <input disabled type="checkbox" class="custom-control-input checkFinal" id="customControlAutosizingFinal" >
                  <label class="custom-control-label lbFim" id="labelCheck" for="customControlAutosizingFinal">Não</label>
                </div>
              </div>
            </div>
          <div class="col-sm"></div>

        </div>
        <!-- Botões salvar e cancelar - Edição -->
        <div class="row">
          <div class="col">
            <button type="button" class="btn btn-block btnForm salvarEditar esconder">
              <svg id="i-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 38" width="28" height="28" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M2 20 L12 28 30 4" />
              </svg>
              Salvar
            </button>   
          </div>
          <div class="col">
            <button type="button" class="btn btn-block btnForm cancelarEditar esconder" onclick="document.location.reload(true)" >
              <span class='fi-x'>
              Cancelar
            </button> 
          </div>
        </div>                      
      </div>

      <div class="container-fluid form">
        <table id="tabela" class="table display responsive nowrap table-striped" >
        <thead>
            <tr>
                <th data-priority="1" >Cliente</th>
                <th  data-priority="2">Data da entrada</th>
                <th  data-priority="10">Telefone</th>
                <th data-priority="3" >Número da placa</th>
                <th  data-priority="4">Empréstimo</th>
                <th data-priority="5">Pagamento</th>
                <th data-priority="7">Marca</th>
                <th data-priority="8">Amperagem</th>
                <th data-priority="9">Data da retirada</th>
                <th data-priority="6">Ação</th>
                <th data-priority="11" >id</th>
                
            </tr>
        </thead>
                 
        </table>
      </div>
  <footer>
    <center>
      Desenvolvido por <a id="dev">Rafael Mardegan </a> - 
      <a target="blank" href="https://www.instagram.com/mardebrahma/">
        <img src="imagens/igg.png" title="Instagram" width="20" alt="">
      </a>
      <a target="blank" href="https://www.facebook.com/rafael.mardegan.3">
        <img src="imagens/fb.png" title="Facebook" width="25" alt=""> 
      </a> 
    </center>
  </footer>
    <script src="./cdn/jquery/jquery-3.4.1.min.js"></script>
    <script src="./cdn/bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="./cdn/mask/mask.js"></script>
    <script src="./cdn/datatables/datatables.js"></script>
    <script src="./cdn/datatables/DataTables/js/dataTables.responsive.js"></script>
    <script src="./cdn/sweetalert2/js/sweetalert2.js"></script>
    <script src="./js/index.js"></script>

  </body>
</html>
