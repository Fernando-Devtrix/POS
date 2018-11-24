/*==================================
=            EDIT CLIENT           =
===================================*/

$(".btnEditClient").click(function(){

	var idClient = $(this).attr("idClient");

	var data = new FormData();
	data.append("idClient", idClient);

	$.ajax({

		url:"ajax/clients.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(answer){

			$("#idClient").val(answer["id"]);
			$("#editClient").val(answer["nombre"]);
			$("#editFileId").val(answer["documento"]);
			$("#editEmail").val(answer["email"]);
			$("#editPhone").val(answer["telefono"]);
			$("#editAddress").val(answer["direccion"]);
			$("#editBornDate").val(answer["fecha_nacimiento"]);

		}

	});

});

/*==================================
=            DELETE CLIENT          =
===================================*/

$(".btnDeleteClient").click(function(){

	var idClient = $(this).attr("idClient");

	 swal({
	    title: '¿Está seguro de borrar el usuario?',
	    text: "¡Si no lo está puede cancelar la accíón!",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    cancelButtonText: 'Cancelar',
	    confirmButtonText: 'Si, borrar usuario!'
  	   }).then((result) => {

  	   	 if (result.value) {

  	   	 	window.location = "index.php?route=clients&idClient="+idClient;

  	    }

    });

});

