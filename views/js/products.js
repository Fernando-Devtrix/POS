/*=============================================
=        LOAD PRODUCTS DINAMIC TABLE          =
=============================================*/

// $.ajax({

// 	url:"ajax/datatable-products.ajax.php",
// 	success:function(answer){

// 		console.log("answer", answer);

// 	}

// });

$('.productsTable').DataTable( {
    "ajax": "ajax/datatable-products.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
	
} );

/*=============================================
=           Get category to set code          =
=============================================*/

$("#newCategory").change(function() {

	var categoryID = $(this).val();

	var data = new FormData();
	data.append("categoryID", categoryID);

	$.ajax({

		url: "ajax/products.ajax.php",
		method: "POST",
	    data: data,
	  	cache: false,
	    contentType: false,
	  	processData: false,
	   	dataType:"json",
	   	success: function(answer) {

	   		if (!answer) {

	   			var newCode = categoryID + "01";
	   			$("#newCode").val(newCode);
	   		
	   		}else{

		   		var newCode = Number(answer["codigo"]) + 1;
		   		$("#newCode").val(newCode);	
			
	   		}
	   		
	    
	     }

	});

});



