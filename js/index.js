
var parametro = -1;
var lista = [];
var a = "oi";
var response;
var i;
var url = "backend/index7.php";

function btEditar(p){

    $.post(
        url, 
        {funcao: "buscarId", id: p},
        function(respEditar,status)
        {
          responseEditar = jQuery.parseJSON(respEditar);

          document.getElementById('cliente').value = responseEditar.cliente;
          var p = parseInt(responseEditar.pagamento);
          var e = parseInt(responseEditar.emprestimo);
          var r = parseInt(responseEditar.retirada);

          $("#customControlAutosizingEmprestimo").prop('checked', e);
          $("#customControlAutosizingPagamento").prop('checked', p);
          $("#customControlAutosizingFinal").prop('checked', r);
          checkEmp();
          check();    
          checkFinal();           
          document.getElementById('telefone').value = responseEditar.telefone;    
          document.getElementById('numeroPlaca').value = responseEditar.numeroPlaca;
          document.getElementById('dataEntrada').value = responseEditar.dataEntrada;
          document.getElementById('dataSaida').value = responseEditar.dataSaida;


          $(".tituloEditar").html("EDITANDO CARREGAMENTO - Cliente:<pre> </pre> <div class='cliente'> " + responseEditar.cliente + "</div>");
          $(".salvar").addClass('esconder');
          $(".salvarEditar").removeClass('esconder');
          $(".cancelar").removeClass('esconder');
          $(".row-fim").removeClass('esconder');


          $("#mostrarForm").attr('disabled', true); 
           
          var target_offset = $(".titulo").offset();
          var target_top = target_offset.top;
          $('html, body').animate({ scrollTop: target_top }, 400);
          $("#form").show(400);

        }
    );
}
function editar(){

  if (!validaCamposInserir()) {
    Swal.fire(
      "", 
      "Preencha os campos obrigatórios",
      "info")  
  } else {

    var cliente = $("#cliente").val();
    var telefone = $("#telefone").val();
    var numeroPlaca = $("#numeroPlaca").val();
    var dataEntrada = $("#dataEntrada").val();
    var pagamento = $(".check").is(':checked');
    var emprestimo = $(".checkEmp").is(':checked');
    var dataSaida = $("#dataSaida").val();
    var finaliza = $(".checkFinal").is(':checked');

    $.post(
      url, 
      {funcao: "editar", id: responseEditar.id, dataSaida: dataSaida, finaliza: finaliza, cliente: cliente, telefone: telefone, numeroPlaca : numeroPlaca, dataEntrada: dataEntrada, pagamento: pagamento, emprestimo: emprestimo},
      function(response,status)
      {

        var obj = jQuery.parseJSON(response);
        var labelPagamento;
        var labelEmprestimo;

        if (obj.pagamento == 'true') {
          labelPagamento = '<a class="btn btn-sm btn-verde" >Pago</a>';
          obj.pagamento = 1;
        }
        else{
          labelPagamento = '<a class="btn btn-sm btn-vermelho">Pendente</a>';
          obj.pagamento = 0;

        }
        if (obj.emprestimo == 'true') {
          labelEmprestimo = '<a class="btn btn-sm btn-verde">Sim</a>';
          obj.emprestimo = 1;
        }
        else{
          labelEmprestimo = '<a class="btn btn-sm btn-vermelho">Não</a>';
          obj.emprestimo = 0;
        }
        swal.fire(
          "Alteração salva com sucesso!", 
          "Cliente: " + obj.cliente + "<br>Placa: " + obj.numeroPlaca + "<br>Pagamento: " + labelPagamento + "<br>Empréstimo: " + labelEmprestimo,
          "success").
        then((result) => {
          if (result.value) {
            document.location.reload(false);

          }
        }); 

      }
      );
  }
}

function inicializar(){
    $.get(url, function(data){
       dados(data);
       $("#switch-shadow").prop('checked', parseInt(data));
    });
}
function dados(parametro){
    $.post( url,{funcao: "listar", parametro: parametro}, function( data ) {
   response = jQuery.parseJSON(data);
    var pendente = '<a class="btn btn-sm btn-vermelho">Pendente</a>';
    var pago = '<a class="btn btn-sm btn-verde" >Pago</a>';
    var nao = '<a class="btn btn-sm btn-vermelho">Não</a>';
    var sim = '<a class="btn btn-sm btn-verde">Sim</a>';

  for ( i = 0; i< response.length; i++) {
        var emprestimo;
        var pagamento;
        var telefone;
      if (response[i].emprestimo == 1) {
        emprestimo = sim; 
      }
      else{
        emprestimo = nao;
      }
      if (response[i].pagamento == 1) {
            pagamento = pago;
        } else {
          pagamento = pendente;
        } 
        var cliente;
        if (response[i].retirada == 1) {
          cliente = "<font color='red'>"+response[i].cliente+"</font>";
        } else {
          cliente = response[i].cliente;
        }
        if (response[i].telefone == '') {
          telefone = "N/I";
        } else {
          telefone = response[i].telefone;
        }
      var btEditar = "<a class='btn  btn-sm btn-alterar' title='Finalizar ou editar este carregamento' onclick=btEditar('"+response[i].id+"')><span class='fi-pencil'></span></a>";
      var registro = [cliente, response[i].dataEntrada, telefone, response[i].numeroPlaca, emprestimo, pagamento, response[i].dataSaida, btEditar, response[i].id ];
      lista[i] = registro;
  }
  
  $('#tabela').DataTable( {
    "responsive": true,
    "bJQueryUI": true,
    "order": [[ 8, "desc" ]],

    "data":lista,
    "columns": [
    { 0: 'Cliente' },
    { 1: 'Data da entrada' },
    { 2: 'Telefone' },
    { 3: 'Numero da Placa' },
    { 4: 'Empréstimo' },
    { 5: 'Pagamento' },
    { 6: 'Data da retirada' },
    { 7: 'Editar' },
    { 8: 'Id', visible: false }

    ],
    "oLanguage": {
      "sProcessing":   "Processando...",
      "sLengthMenu":   "Mostrar _MENU_ registros",
      "sZeroRecords":  "Não foram encontrados resultados",
      "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
      "sInfoFiltered": "",
      "sInfoPostFix":  "",
      "sSearch":       "Buscar:",
      "sUrl":          "",
      "oPaginate": {
        "sFirst":    "Primeiro",
        "sPrevious": "Anterior",
        "sNext":     "Seguinte",
        "sLast":     "Último"
      }
    }


  });
});

} 
 
function check(){
    if ($(".check").is(':checked')) {
        $("#pag").css("background-color", "#28a745"); 
        $(".lbPag").html("PAGO");
    }else{
        $("#pag").css("background-color", "#dc3545"); 
        $(".lbPag").html("PENDENTE");
    } 
}
function checkEmp(){
    if ($(".checkEmp").is(':checked')) {
        $("#emp").css("background-color", "#28a745"); 
        $(".lbEmp").html("SIM");
    }else{
        $("#emp").css("background-color", "#dc3545"); 
        $(".lbEmp").html("NÃO");
    } 
}
function checkFinal(){
    if ($(".checkFinal").is(':checked')) {
        $("#finaliza").css("background-color", "#28a745"); 
        $(".lbFim").html("SIM");
    }else{
        $("#finaliza").css("background-color", "#dc3545"); 
        $(".lbFim").html("NÃO");
    } 
}

function validaCamposInserir(){
    var formOk = true;
    $('.validar').each(function(){
      if($(this).val() == "" || $(this).val() == null){
        formOk = false;
      }
      
    }); 
    return formOk;
}
function preenchecheckFinal(){
 
  if($("#dataSaida").val()!=''){
    $("#customControlAutosizingFinal").prop('checked', 1);
    checkFinal();

  }
  else{
    $("#customControlAutosizingFinal").prop('checked', 0);
    checkFinal();

  }

}


$(document).ready(function() {
  
  inicializar();

  $("#switch-shadow").click(function(){
    if ($("#switch-shadow").is(':checked')) {
      $.post(
      url, 
      {funcao: "setParametro", parametro: 1},
      function(){
      document.location.reload(false);
      }
        );
    } else {
            $.post(
      url, 
      {funcao: "setParametro", parametro: 0},
      function(){
      document.location.reload(false);
      }
        );
      
    }
  })

	$("#mostrarForm").click(function(){
	 $("#form").slideToggle(400);
	});
  
  $(".salvar").click(function(){

   

    if (!validaCamposInserir()) {
      Swal.fire(
            "", 
            "Preencha os campos obrigatórios",
            "info")  
    } else {

      var cliente = $("#cliente").val();
      var telefone = $("#telefone").val();
      var numeroPlaca = $("#numeroPlaca").val();
      var dataEntrada = $("#dataEntrada").val();
      var pagamento = $(".check").is(':checked');
      var emprestimo = $(".checkEmp").is(':checked');       

      $.post(
        url, 
        {funcao: "inserir", cliente: cliente, telefone: telefone, numeroPlaca : numeroPlaca, dataEntrada: dataEntrada, pagamento: pagamento, emprestimo: emprestimo},
        function(response,status)
        {

          var obj = jQuery.parseJSON(response);
          var labelPagamento;
          var labelEmprestimo;

          if (obj.pagamento == 'true') {
            labelPagamento = '<a class="btn btn-sm btn-verde">Pago</a>';
            obj.pagamento = 1;
          }
          else{
            labelPagamento = '<a class="btn btn-sm btn-vermelho">Pendente</a>';
            obj.pagamento = 0;

          }
          if (obj.emprestimo == 'true') {
            labelEmprestimo = '<a class="btn btn-sm btn-verde">Sim</a>';
            obj.emprestimo = 1;
          }
          else{
            labelEmprestimo = '<a class="btn btn-sm btn-vermelho">Não</a>';
            obj.emprestimo = 0;
          }
          swal.fire(
            "Bateria Registrada!", 
            "Cliente: " + obj.cliente + "<br>Placa: " + obj.numeroPlaca + "<br>Pagamento: " + labelPagamento + "<br>Empréstimo: " + labelEmprestimo,
            "success").
          then((result) => {
            if (result.value) {
              document.location.reload(false);

            }
          }); 

        }
        );
    }



  })

  $(".cancelar").click(function(){
    document.location.reload(true);

  });
  $(".salvarEditar").click(function(){
    editar();
  

  })
               
        $(".pag").change(function(){
            check();
         
        });
        $(".emp").change(function(){
          
            checkEmp();
        });
        $(".fim").change(function(){
          
            checkFinal();
        });
        
        check();
        checkEmp();
        checkFinal();

});

