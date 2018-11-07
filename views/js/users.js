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

$(".btnUserEdit").click(function() {

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

$(".btnActivate").click(function(){

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



