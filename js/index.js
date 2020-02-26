
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

            // swal.fire(

            //     "Editar", 
            //     "Cliente: "+ responseEditar.cliente + "<br>Placa: " + responseEditar.numeroPlaca


            //     ,
            //     "success").then((result) => {
            //       if (result.value) {
            //         document.location.reload(true);
            //     }
            // }); 
  document.getElementById('cliente').value = responseEditar.cliente;
  // document.getElementsByClassName('check').checked = true; 
  $("#customControlAutosizingEmprestimo").prop('checked', true);         
  // document.getElementById('checkEmp').checked = responseEditar.emprestimo; 
  document.getElementById('telefone').value = responseEditar.telefone;    
  document.getElementById('numeroPlaca').value = responseEditar.numeroPlaca;
  document.getElementById('dataEntrada').value = responseEditar.dataEntrada;    
   
  var target_offset = $(".form").offset();
  var target_top = target_offset.top;
  $('html, body').animate({ scrollTop: target_top }, 400);
  $("#form").show(400);




        }
            );

}
function dados(){
    $.post( url,{funcao: "listar"}, function( data ) {
   response = jQuery.parseJSON(data);
    var pendente = '<a class="btn btn-sm btn-vermelho">Pendente</a>';
    var pago = '<a class="btn btn-sm btn-verde">Pago</a>';
    var nao = '<a class="btn btn-sm btn-vermelho">Não</a>';
    var sim = '<a class="btn btn-sm btn-verde">Sim</a>';

    
    // console.log(response);

  for ( i = 0; i< response.length; i++) {
        var emprestimo;
        var pagamento;
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
        var sa = response[i].cliente; 
      var registro = [response[i].cliente, response[i].telefone, response[i].numeroPlaca, response[i].dataEntrada, emprestimo, pagamento, "<a class='btn  btn-sm btn-alterar' onclick=btEditar('"+response[i].id+"')><span class='fi-pencil'></span></a>"];
      lista[i] = registro;
  }
  
      $('#tabela').DataTable( {
        "responsive": true,
       "bJQueryUI": true,

       "data":lista,
"columns": [
        { 0: 'Cliente' },
        { 1: 'Telefone' },
        { 2: 'Numero da Placa' },
        { 3: 'Data da entrada' },
        { 4: 'Empréstimo' },
        { 5: 'Pagamento' },
        { 6: 'Editar' }

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

$(document).ready(function() {

	$("#mostrarForm").click(function(){
		$("#form").slideToggle(400);

	});

	// $("#telefone").mask("(99) 9999-9999?9")
 //        .focusout(function (event) {  
 //            var target, phone, element;  
 //            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
 //            phone = target.value.replace(/\D/g, '');
 //            element = $(target);  
 //            // element.unmask();  
 //            if(phone.length > 10) {  
 //                element.mask("(99) 99999-999?9");  
 //            } else {  
 //                element.mask("(99) 9999-9999?9");  
 //            }  
 //        });


    dados();
       

        $(".salvar").click(function(){

            // Swal.fire({
            //     title: 'Isso ainda não ta pronto!',
            //     width: 480,
            //     padding: '3em',
            //     background: '#fff url(https://66.media.tumblr.com/31ae8bdb1099aa6a32be3a8aebb100f6/tumblr_pqu6hrmaI91w9murbo1_500.gifv)',
            //     backdrop: `
               
            //     top
            //     no-repeat`
            // })


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

// console.log(response)
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
                        "success").then((result) => {
                      if (result.value) {
                        document.location.reload(false);
                        // dados();
                      }
                    }); 

                


               }
            );

       })


               
        $(".pag").change(function(){
            check();
         
        });
        $(".emp").change(function(){
          
            checkEmp();
        });
        check();
        checkEmp();


});

