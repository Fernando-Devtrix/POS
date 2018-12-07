 /*=============================================
=         LOCAL STORAGE VARIABLE             =
=============================================*/

if (localStorage.getItem("getRange") != null) {

	$("#daterange-btn span").html(localStorage.getItem("getRange"));

}else{

	$("#daterange-btn span").html('<i class="fa fa-calendar"></i>Rango de fecha');
};


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

					 '<!-- Product Description -->'+

                      '<div class="col-xs-6" style="padding-right: 0px">'+
                        
                        '<div class="input-group">'+
                          
                          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitProduct" idProduct="'+idProduct+'"><i class="fa fa-times"></i></button></span>'+

                          '<input type="text" class="form-control addProduct newProductDescription" idProduct="'+idProduct+'" name="addProduct" value="'+description+'" readonly required>'+

                       '</div>'+

                      '</div>'+

                      '<!-- Product Quantity -->'+

                      '<div class="col-xs-3">'+
                        
                        '<input type="number" class="form-control newProductQuantity" min="1" value="1" stock="'+stock+'" newStock="'+Number(stock-1)+'" required>'+

                      '</div>'+

                      '<!-- Product Price -->'+

                      '<div class="col-xs-3 inputPrice" style="padding-left: 0px">'+

                        '<div class="input-group">'+
                          
                          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                          '<input type="text" class="form-control newProductPrice" initPrice="'+price+'" name="newProductPrice" value="'+price+'" readonly required>'+
                          
                        '</div>'+
                      
                      '</div>'+

                 '</div>'

			);

			//Sum Products

			sumTotalPrices();

			//Add Tax

			addTax();

			// To list products

			toListProducts();

			// Add number format

			$(".newProductPrice").number(true, 2);

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

	  if ($(".newProduct").children().length == 0) {

	  	$("#newTaxSell").val(0)
	  	$("#newTotalSell").val(0)
	  	$("#totalSell").val(0)
	  	$("#newTotalSell").attr("total", 0)

	  }else{

		  //Sum Products

		  sumTotalPrices();

		  //Add tax

		  addTax();	  	

		  // To list products

		  toListProducts();
	  }

});

/*========================================================
=     Adding products from the button for devices   	 =
========================================================*/

var numProduct = 0;

$(".btnAddProduct").click(function() {

	numProduct ++;

	var data = new FormData();
	data.append("getAllProducts", "ok");

	$.ajax({

		url:"ajax/products.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(answer) {

      		$(".newProduct").append(
      		
      		 '<div class="row" style="padding: 5px 15px">'+

					 '<!-- Product Description -->'+

                      '<div class="col-xs-6" style="padding-right: 0px">'+
                        
                        '<div class="input-group">'+
                          
                          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitProduct" idProduct><i class="fa fa-times"></i></button></span>'+

                          '<select class="form-control newProductDescription" id="producto'+numProduct+'" idProduct name="newProductDescription" required>'+

                          '<option>Seleccione Producto</option>'+

                          '</select>'+

                       '</div>'+

                      '</div>'+

                      '<!-- Product Quantity -->'+

                      '<div class="col-xs-3 inputQuantity">'+
                        
                        '<input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="1" stock newStock required>'+

                      '</div>'+

                      '<!-- Product Price -->'+

                      '<div class="col-xs-3 inputPrice" style="padding-left: 0px">'+

                        '<div class="input-group">'+
                          
                          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                          '<input type="text" class="form-control newProductPrice" initPrice="" name="newProductPrice" readonly required>'+
                          
                        '</div>'+
                      
                      '</div>'+

                 '</div>'

            );

            // ADD PRODUCTS TO THE SELECT

            answer.forEach(functionForEach);

            function functionForEach(item, index){

            	if (item.stock != 0) {

            	$("#producto"+numProduct).append(

            		'<option idProduct="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

            		);
            		
            	}

            	//Sum Products

			 	sumTotalPrices();

			 	//Add Tax

			 	addTax();

			 	// Add number format

				$(".newProductPrice").number(true, 2);
            	
            }

      	}

	});

});

/*========================
=     Select Product   	 =
========================*/

$(".formSell").on("change", "select.newProductDescription", function() {

	var productName = $(this).val();

	var newProductPrice = $(this).parent().parent().parent().children(".inputPrice").children().children(".newProductPrice");
	var newProductQuantity = $(this).parent().parent().parent().children(".inputQuantity").children(".newProductQuantity");

	var data = new FormData();
	data.append("productName", productName);

	$.ajax({

		url:"ajax/products.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(answer) {
      		
      		$(newProductQuantity).attr("stock", answer["stock"]);
      		$(newProductQuantity).attr("newStock", Number(answer["stock"])-1);
      		$(newProductPrice).val(answer["precio_venta"]);
      		$(newProductPrice).attr("initPrice", answer["precio_venta"]);

      	 	// To list products

			toListProducts();

      	}

    });

});

/*========================
=     Change Quantity 	 =
========================*/

$(".formSell").on("change", "input.newProductQuantity", function() {

	var price = $(this).parent().parent().children(".inputPrice").children().children(".newProductPrice");

	var finalPrice = $(this).val() * price.attr("initPrice");

	price.val(finalPrice);

	var newStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("newStock", newStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))) {


		/*============================================================
		=     If quantity is more than stock return initial value 	 =
		============================================================*/

		$(this).val(1);

		var finalPrice = $(this).val() * price.attr("initPrice");

		price.val(finalPrice);

		sumTotalPrices();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	}

	//Sum Products

	sumTotalPrices();

	//Add Tax

	addTax();

	// To list products

	toListProducts();

});

/*====================================
=            Sum Prodcuts            =
==================================== */

function sumTotalPrices() {

	var priceItem = $(".newProductPrice");
	var arraySumPrice = [];

	for (var i = 0; i < priceItem.length; i++) {
		
		arraySumPrice.push(Number($(priceItem[i]).val()));
		
	}

	var sumTotalPrice = arraySumPrice.reduce(function sumArrayPrices(total, number) {

		return total + number;

	});	

	$("#newTotalSell").val(sumTotalPrice);
	$("#totalSell").val(sumTotalPrice);
    $("#newTotalSell").attr("total", sumTotalPrice);
}

/*=====================================
=            Function Add Tax         =
==================================== */

function addTax() {

	var tax = $("#newTaxSell").val();
	var totalPrice = $("#newTotalSell").attr("total");

	var taxPrice = Number(totalPrice * tax / 100);

	var totalWithTax =  Number(taxPrice) + Number(totalPrice);

	$("#newTotalSell").val(totalWithTax);
	$("#totalSell").val(totalWithTax);
	
	$("#newTaxPrice").val(taxPrice);

	$("#newTaxNet").val(totalPrice);

}

/*=====================================
=           When tax changes         =
==================================== */

$("#newTaxSell").change(function() {

	addTax();

});

// Add number format to the final price

$("#newTotalSell").number(true, 2);

/*=====================================
=       Select payment method         =
==================================== */

$("#newPaymentMethod").change(function() {

	var method = $(this).val();

	if (method == "Efectivo") {

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".paymentMethodBoxes").html(

			'<div class="col-xs-4">'+

				'<div class="input-group">'+

					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

					'<input type="text" class="form-control" id="newCashValue" placeholder="000000" required/>'+

				'</div>'+

			'</div>'+

			'<div class="col-xs-4" id="getCashChange" style="padding-left:0px">'+

				'<div class="input-group">'+

					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

					'<input type="text"  class="form-control" id="newCashChange" name="newCashChange" placeholder="000000" readonly required/>'+

				'</div>'+			

			'</div>'


		);

		// Add number format

		$("#newCashChange").number(true, 2);
		$("#newCashValue").number(true, 2);

		// List method in the input

		listPaymentMethods ();

	}else{

		$(this).parent().parent().removeClass("col-xs-4");

		$(this).parent().parent().addClass("col-xs-6");

		$(this).parent().parent().parent().children(".paymentMethodBoxes").html(

		    '<div class="col-xs-6" style="padding-left: 0px">'+
                        
                '<div class="input-group">'+

 	                '<input type="text" class="form-control" id="newTransactionCode" name="newTransactionCode" placeholder="Código de transaction" required>'+

                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                                                                 
                '</div>'+
                    
            '</div>'

		);

	}

});

/*=====================================
=           Efective change           =
==================================== */

$(".formSell").on("change", "input#newCashValue", function() {

	var cash = $(this).val();

	var change = Number(cash) - Number($("#newTotalSell").val());

	var newCashChange = $(this).parent().parent().parent().children("#getCashChange").children().children("#newCashChange");

	newCashChange.val(change);

});

/*=====================================
=           Transaction shift         =
==================================== */

$(".formSell").on("change", "input#newTransactionCode", function() {

	// List method in the input

	listPaymentMethods ();

});

/*=====================================
=           List all Products         =
==================================== */

function toListProducts() {

	var listProducts = [];

	var description = $(".newProductDescription");

	var quantity = $(".newProductQuantity");

	var price = $(".newProductPrice");

		for (var i = 0; i < description.length; i++) {

			listProducts.push({"id" : $(description[i]).attr("idProduct"),
							   "descripcion" : $(description[i]).val(),
							   "cantidad" : $(quantity[i]).val(),
							   "stock" : $(quantity[i]).attr("newStock"),
							   "precio" : $(price[i]).attr("initPrice"),
							   "total" : $(price[i]).val()

		});
		
		$("#listProducts").val(JSON.stringify(listProducts));

	}

};

/*=====================================
=           List Payment Method       =
==================================== */

function listPaymentMethods() {

	//var methodsList = "";

	if ($("#newPaymentMethod").val() == "Efectivo") {

		$("#listPaymentMethod").val("Efectivo");

	}else{

		$("#listPaymentMethod").val($("#newPaymentMethod").val()+"-"+$("#newTransactionCode").val());

	}

}

/*================================
=        EDIT SELLS              =
=================================*/

$(".tables").on("click", ".btnEditSell", function() {

	var idSell = $(this).attr("idSell"); 

	window.location = "index.php?route=edit-sell&idSell="+idSell;
	
});

/*==========================================================================
=      DISABLED THE BUTTONS WHEN A PRODUCT WAS ALREADY SELECTED            =
===========================================================================*/

function quitAddProduct() {

		var idProducts = $(".quitProduct");

		var tableButtons = $(".sellsTable tbody button.addProduct");

		for (var i = 0; i < idProducts.length; i++) {
			
			var button = $(idProducts[i]).attr("idProduct");

			for (var j = 0; j < tableButtons.length; j++) {

				if ($(tableButtons[j]).attr("idProduct") == button) {

					$(tableButtons[j]).removeClass("btn-primary addProduct");
					$(tableButtons[j]).addClass("btn-default");
			}

		}

	}

}


$('.sellsTable').on('draw.dt', function() {

	quitAddProduct();

});


/*================================
=        DELETE SELLS            =
=================================*/

$(".tables").on("click", ".btnDeleteSell", function(){

	idSell = $(this).attr("idSell");

	 swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then((result) => {

      	if (result.value) {

      		window.location = "index.php?route=sells&idSell="+idSell;

      	}

      });

});


/*================================
=        PRINT INVOICE           =
=================================*/

$(".tables").on("click", ".btnPrintInvoice", function() {

	sellCode = $(this).attr("sellCode");

	window.open("extensiones/TCPDF/examples/factura.php?codigo="+sellCode, "_blank");

});


/*================================
=        RANGE DATE PICKER       =
=================================*/
$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

    var starterDate = start.format("YYYY-MM-DD");

    var lastDate = end.format("YYYY-MM-DD");

    var getRange = $("#daterange-btn span").html();

    localStorage.setItem("getRange", getRange);

    window.location = "index.php?route=sells&starterDate="+starterDate+"&lastDate="+lastDate;

  }
)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("getRange");
	localStorage.clear();
	window.location = "sells";

});

/*================================
=        RANGE DATE PICKER       =
=================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textToday = $(this).attr("data-range-key");

	if(textToday == "Hoy"){

		var d = new Date();
		
		var day = d.getDate();
		var month = d.getMonth()+1;
		var year = d.getFullYear();

		if (month < 10) {

			var startDate = year+"-0"+month+"-"+day;
			var lastDate = year+"-0"+month+"-"+day;

		}else if(day < 10) {

			var startDate = year+"-"+month+"-0"+day;
			var lastDate = year+"-"+month+"-0"+day;

		}else if(month < 10 && day < 10) {

			var startDate = year+"-0"+month+"-0"+day;
			var lastDate = year+"-0"+month+"-0"+day;
		
		}else{

			var startDate = year+"-"+month+"-"+day;
			var lastDate = year+"-"+month+"-"+day;

		}

		localStorage.setItem("getRange", "Hoy");

    	window.location = "index.php?route=sells&starterDate="+startDate+"&lastDate="+lastDate;


	}

});
