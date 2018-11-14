/*=============================================
=            Upload user photo                =
=============================================*/


$(".newPhoto").change(function() {

	var image = this.files[0];
	console.log("image", image);

	/*=============================================
	=    Validate image format(.jpg or .png)      =
	=============================================*/

	if (image["type"] != "image/jpeg" && image["type"] != "image/png") {

		$(".newPhoto").val("");

		    swal({

					title: "Problema al subir imagen",
					text: "La imagen debe ser formato .JPG o .PNG",
					type: "error",
					confirmButtonText: "Cerrar"

				 });

	}else if (image["size"] > 2000000) {

		$(".newPhoto").val("");

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

			$(".previous").attr("src", imageRoute);

		});

	}

});

/*=============================================
=               User Edit                     =
=============================================*/

$(document).on("click", ".btnUserEdit", function() {

	var userID = $(this).attr("userID");

	var data = new FormData();
	data.append("userID", userID)

	$.ajax({

		url:"ajax/users.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(answer) {

			$("#editName").val(answer["nombre"]);
			$("#editUser").val(answer["usuario"]);
			$("#editProfile").html(answer["perfil"]);
			$("#editProfile").val(answer["perfil"]);
			$("#currentPhoto").val(answer["foto"]);

			$("#currentPassword").val(answer["password"]);

			if(answer["foto"] != "") {

				$(".previous").attr("src", answer["foto"]);

			}

		}

	});

});

/*=============================================
=                Edit User Status             =
=============================================*/

$(document).on("click",".btnActivate", function(){

	var userId = $(this).attr("userId");
	var userStatus = $(this).attr("userStatus");

	var data = new FormData;
	data.append("activateId", userId);
	data.append("activateUser", userStatus);

	$.ajax({

		url:"ajax/users.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(answer){

			if(window.matchMedia("(max-width:767px)").matches){
		
	      		 swal({
			      	title: "El usuario ha sido actualizado",
			      	type: "success",
			      	confirmButtonText: "¡Cerrar!"
			    	}).then(function(result) {
			        
			        	if (result.value) {

			        	window.location = "users";

		       		}

			    });

	 		}

		}

	});

	if (userStatus == 0) { 

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('userStatus', 1);

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('userStatus', 0);

	}

});

/*=============================================
=       Check if user already exits           =
=============================================*/

$("#newUser").change(function(){

	$(".alert").remove();

	var user = $(this).val();

	var data = new FormData();
	data.append("validateUser", user);

	 $.ajax({
	    url:"ajax/users.ajax.php",
	    method:"POST",
	    data: data,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(answer){

			if(answer){

	    		$("#newUser").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#newUser").val("");

	    	}
	    }
	});
});

/*=============================================
=       Check if user already exits           =
=============================================*/

$(document).on("click",  ".btnDeleteUser", function() {

	var userID = $(this).attr("userID");
	var userPhoto = $(this).attr("userPhoto");
	var user = $(this).attr("user");

	 swal({
	    title: '¿Está seguro de borrar el usuario?',
	    text: "¡Si no lo está puede cancelar la accíón!",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    cancelButtonText: 'Cancelar',
	    confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result) {

  		if (result.value) {

     		 window.location = "index.php?route=users&userID="+userID+"&user="+user+"&userPhoto="+userPhoto;

  		}

  });

});


