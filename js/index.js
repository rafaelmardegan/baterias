
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
function datatable(){
     $('#tabela').DataTable( {
        "responsive": true,
       "bJQueryUI": true,
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
}

$(document).ready(function() {

	$("#mostrarForm").click(function(){
		$("#form").slideToggle(400);

	});
    var pendente = '<a class="btn btn-sm btn-vermelho">Pendente</a>';
    var pago = '<a class="btn btn-sm btn-verde">Pendente</a>';

	$("#valor").mask('000000000000000.00' , { reverse : true});
	$("#telefone").mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
        });

       $.get("backend/index.php",function(data, status){
    var lista = jQuery.parseJSON(data);

        lista.forEach(obj => {
                $("tbody").append("<tr>")
                // console.log("___________")
        Object.entries(obj).forEach(([key, value]) => {
            // console.log(` ${value}`);
            $("tr").append(`<td> ${value}</td>`);
        });
                $("td").append("</tr>")
                // console.log("-----------")

           

    });

   })

   

   // $.get("backend/index.php",function(data, status){
   //  var lista = jQuery.parseJSON(data);

   //      lista.forEach(obj => {
   //              $("tbody").append("<tr>")
   //      Object.entries(obj).forEach(([key, value]) => {
   //          console.log(` ${value}`);
   //          $("tbody").append(`<td> ${value}</td>`);
   //      });
   //              $("tbody").append("</tr>")
           

   //  });
   //  // console.log(lista);
   // })
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
                "backend/index.php", 
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
                        document.location.reload(true);
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

