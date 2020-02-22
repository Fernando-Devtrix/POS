 /*=============================================
=        LOAD PRODUCTS DINAMIC TABLE          =
=============================================*/

// $.ajax({

// 	url:"ajax/datatable-products.ajax.php",
// 	success:function(answer){

// 		console.log("answer", answer);

// 	}

// });

var hiddenProfile = $("#hiddenProfile").val();
// console.log("hiddenProfile", hiddenProfile);

$('.productsTable').DataTable( {
    "ajax": "ajax/datatable-products.ajax.php?hiddenProfile="+hiddenProfile,
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

// $("#newCategory").change(function() {

// 	var categoryID = $(this).val();

// 	var data = new FormData();
// 	data.append("categoryID", categoryID);

// 	$.ajax({

// 		url: "ajax/products.ajax.php",
// 		method: "POST",
// 	    data: data,
// 	  	cache: false,
// 	    contentType: false,
// 	  	processData: false,
// 	   	dataType:"json",
// 	   	success: function(answer) {

// 	   		if (!answer) {

// 	   			var newCode = categoryID + "01";
// 	   			$("#newCode").val(newCode);
	   		
// 	   		}else{

// 		   		var newCode = Number(answer["codigo"]) + 1;
// 		   		$("#newCode").val(newCode);	
			
// 	   		}
	   		
	    
// 	     }

// 	});

// });

/*=============================================
=               ADD SELL PRICE                =
=============================================*/

$("#newPricePurchase, #editPricePurchase").change(function() {

	if ($(".percentage").prop("checked")) {

		var valuePercentage = $(".newPercentage").val();

		var percentage = Number($("#newPricePurchase").val() * valuePercentage / 100) + Number($("#newPricePurchase").val()); 
		
		var editPercentage = Number($("#editPricePurchase").val() * valuePercentage / 100) + Number($("#editPricePurchase").val()); 

		$("#newPriceSell").val(percentage);
		$("#newPriceSell").prop("readonly", true);

		$("#editPriceSell").val(editPercentage);
		$("#editPriceSell").prop("readonly", true);
		
	}

});

/*=============================================
=               CHANGE PERCENTAGE            =
=============================================*/

$(".newPercentage").change(function() {

	if ($(".percentage").prop("checked")) {

		var valuePercentage = $(this).val();

		var percentage = Number(($("#newPricePurchase").val() * valuePercentage / 100)) + Number($("#newPricePurchase").val()); 

		var editPercentage = Number($("#editPricePurchase").val() * valuePercentage / 100) + Number($("#editPricePurchase").val()); 

		$("#newPriceSell").val(percentage);
		$("#newPriceSell").prop("readonly", true);

		$("#editPriceSell").val(editPercentage);
		$("#editPriceSell").prop("readonly", true)
		
	}

});

$(".percentage").on("ifUnchecked",function(){

	$("#newPriceSell").prop("readonly",false);
	$("#editPriceSell").prop("readonly",false);

});

$(".percentage").on("ifChecked",function(){

	$("#newPriceSell").prop("readonly",true);
	$("#editPriceSell").prop("readonly",true);

});

/*=============================================
=            Upload Product photo             =
=============================================*/


$(".newImage").change(function() {

	var image = this.files[0];

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

/*=============================================
=                Edit Product                 =
=============================================*/

$(".productsTable").on("click", "button.btnEditProduct", function() {

	var idProduct = $(this).attr("idProduct");

	var data = new FormData();
	data.append("idProduct", idProduct);

	$.ajax({

		url:"ajax/products.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(answer) {

			var categoryData = new FormData();
			categoryData.append("idCategory", answer["id_categoria"]);

	       $.ajax({

	       	url:"ajax/categories.ajax.php",
			method: "POST",
			data: categoryData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(answer) {
				
				$("#editCategory").val(answer["id"]);
				$("#editCategory").html(answer["categoria"]);


				}

	       });

			$("#editCode").val(answer["codigo"]);
			$("#editDescription").val(answer["descripcion"]);
			$("#editStock").val(answer["stock"]);
			$("#editPricePurchase").val(answer["precio_compra"]);
			$("#editPriceSell").val(answer["precio_venta"]);
			
			if (answer["imagen"] != "") {

				$("#currentImage").val(answer["imagen"]);

				$(".preview").attr("src", answer["imagen"]);
				
			}

		}

	});

});

/*=============================================
=                Edit Product                 =
=============================================*/

$(".productsTable").on("click", "button.btnDeleteProduct", function() {

	var idProduct = $(this).attr("idProduct");
	var code = $(this).attr("code");
	var image = $(this).attr("image");

	swal({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {

        	if (result.value) {

        		window.location = "index.php?route=products&idProduct="+idProduct+"&image"+image+"&code"+code;

        	}

        });

});



	




