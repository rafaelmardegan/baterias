
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
        },
        // "ajax": {
        //     "url": "./teste.txt",
        //     "dataSrc": "data"
        // }
        //    "ajax": {
        //     "dataType": "json",
        //     "url": "api.php",
        //     "data": "data.item"
        // }
        
    });

   
	    $(".salvar").click(function(){

            Swal.fire({
                title: 'Isso ainda não ta pronto!',
                width: 480,
                padding: '3em',
                background: '#fff url(https://66.media.tumblr.com/31ae8bdb1099aa6a32be3a8aebb100f6/tumblr_pqu6hrmaI91w9murbo1_500.gifv)',
                backdrop: `
               
                top
                no-repeat`
            })

    		var nome = $("#nome").val();
    		var telefone = $("#telefone").val();
    		var numeroPlaca = $("#numeroPlaca").val();
    		var dataRetirada = $("#dataEntrada").val();
    		var valor = $("#valor").val();
    		var retirado = false;
    		var dados = {
    			    data: {nome: nome, telefone: telefone}
    			};

            Url = "index.php";

            $.post(
                Url, //Required URL of the page on server
                dados,
               function(response,status)
               {
                    var obj = jQuery.parseJSON(response);
                    alert(obj.data.nome);
                    alert(obj.data.telefone);      
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

