 /*=============================================
=        LOAD SELLS DINAMIC TABLE             =
=============================================*/

$.ajax({

	url:"ajax/datatable-sells.ajax.php",
	success:function(answer){

		//|console.log("answer", answer);

	}

});

$('.sellsTable').DataTable( {
    "ajax": "ajax/datatable-sells.ajax.php",
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

 /*======================================================================
=        ADD PRODUCTS TO THE PURCHASE COMING FROM THE TABLE             =
=======================================================================*/

$(".sellsTable tbody").on("click", "button.addProduct", function() {

	var idProduct = $(this).attr("idProduct");
	//console.log("idProduct", idProduct);

	$(this).removeClass("btn-primary addProduct");

	$(this).addClass("btn-default");

	var data = new FormData();
	data.append("idProduct", idProduct);

	$.ajax({

		url:"ajax/products.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(answer) {

			var description = answer["descripcion"];      		
			var stock = answer["stock"];      		
			var price = answer["precio_venta"];    

			/*=============================================
			 =      AVOID ADDING PRODUCTS IF STOCK = 0    =
			 =============================================*/

			 if (stock == 0) {

			 	swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProduct='"+idProduct+"']").addClass("btn-primary addProduct");

			    return;

			 } 	 	

			$(".newProduct").append(

				 '<div class="row" style="padding: 5px 15px">'+

					 '<!-- Producto Description -->'+

                      '<div class="col-xs-6" style="padding-right: 0px">'+
                        
                        '<div class="input-group">'+
                          
                          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitProduct" idProduct="'+idProduct+'"><i class="fa fa-times"></i></button></span>'+

                          '<input type="text" class="form-control" id="addProduct" name="addProduct" value="'+description+'" readonly required>'+

                       '</div>'+

                      '</div>'+

                      '<!-- Producto Quantity -->'+

                      '<div class="col-xs-3">'+
                        
                        '<input type="text" class="form-control" id="newProductQuantity" min="1" value="1" stock="'+stock+'" required>'+

                      '</div>'+

                      '<!-- Product Price -->'+

                      '<div class="col-xs-3" style="padding-left: 0px">'+

                        '<div class="input-group">'+
                          
                          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                          '<input type="number" min="1" class="form-control" id="newProductPrice" value="'+price+'" readonly required>'+
                          
                        '</div>'+
                      
                      '</div>'+

                 '</div>'

			);

      	}

	});

});

/*======================================================================
=          WHEN TABLE LOADS EVERY TIME A USER IS SURFING ON IT         =
=======================================================================*/

$(".sellsTable").on("draw.dt", function() {

	if (localStorage.getItem("removeProduct") != null) {

		var listIdProducts = JSON.parse(localStorage.getItem("removeProduct"));

		for (var i = 0; i < listIdProducts.length; i++) {

			$("button.retrieveButton[idProduct='"+listIdProducts[i]["idProduct"]+"']").removeClass("btn-default");
			$("button.retrieveButton[idProduct='"+listIdProducts[i]["idProduct"]+"']").addClass("btn-primary addProduct");

		}

	}

});


/*======================================================================
=           QUIT PRODUCTS FROM SELL AND RETRIEVE BUTTON             =
=======================================================================*/

var idRemoveProduct = [];

localStorage.removeItem("removeProduct");

$(".formSell").on("click", "button.quitProduct", function() {

	$(this).parent().parent().parent().parent().remove();

	var idProduct = $(this).attr("idProduct");

	 /*=======================================================================
      =     Store in the localstorage Product ID which will be remove   	 =
  	  ======================================================================*/

  	  if (localStorage.getItem("removeProduct") == null) {

  	  	idRemoveProduct = [];

  	  }else{

  	  	idRemoveProduct.concat(localStorage.getItem("removeProduct"));

  	  }

  	  idRemoveProduct.push({"idProduct":idProduct});

  	  localStorage.setItem("removeProduct", JSON.stringify(idRemoveProduct));

   	  $("button.retrieveButton[idProduct='"+idProduct+"']").removeClass("btn-default");

	  $("button.retrieveButton[idProduct='"+idProduct+"']").addClass("btn-primary addProduct");

});