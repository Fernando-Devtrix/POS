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

/*=============================================
=               ADD SELL PRICE                =
=============================================*/

$("#newPricePurchase").change(function() {

	if ($(".percentage").prop("checked")) {

		var valuePercentage = $(".newPercentage").val();

		var percentage = Number($("#newPricePurchase").val() * valuePercentage / 100) + Number($("#newPricePurchase").val()); 

		$("#newPriceSell").val(percentage);
		$("#newPriceSell").prop("readonly", true);
		
	}

});

/*=============================================
=               CHANGE PERCENTAGE            =
=============================================*/

$(".newPercentage").change(function() {

	if ($(".percentage").prop("checked")) {

		var valuePercentage = $(".newPercentage").val();

		var percentage = Number($("#newPricePurchase").val() * valuePercentage / 100) + Number($("#newPricePurchase").val()); 

		$("#newPriceSell").val(percentage);
		$("#newPriceSell").prop("readonly", true);
		
	}

});

$(".percentage").on("ifUnchecked", function() {

	$("#newPriceSell").prop("readonly", false);

}); 
	
$(".percentage").on("checked", function() {

	$("#newPriceSell").prop("readonly", true);

}); 

/*=============================================
=            Upload Product photo             =
=============================================*/


$(".newImage").change(function() {

	var image = this.files[0];
	console.log("image", image);

	/*=============================================
	=    Validate image format(.jpg or .png)      =
	=============================================*/

	if (image["type"] != "image/jpeg" && image["type"] != "image/png") {

		$(".newImage").val("");

		    swal({

					title: "Problema al subir imagen",
					text: "La imagen debe ser formato .JPG o .PNG",
					type: "error",
					confirmButtonText: "Cerrar"

				 });

	}else if (image["size"] > 2000000) {

		$(".newImage").val("");

		 swal({

					title: "Problema al subir imagen",
					text: "La imagen no debe pesar más de 2MB",
					type: "error",
					confirmButtonText: "Cerrar"

				 });

	}else{

		var imageData = new FileReader;
		imageData.readAsDataURL(image);

		$(imageData).on("load", function(ev) {

			var imageRoute =  ev.target.result;

			$(".preview").attr("src", imageRoute);

		});

	}

});

	




