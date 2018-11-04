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


