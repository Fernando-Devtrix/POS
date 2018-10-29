<?php

class UserController {

	/*========================
	=      User Login        =
	========================*/

	static public function ctrlUserLogin() {

		if (isset($_POST["enterUser"])) {
			
			if (preg_match('/^[-a-zA-Z0-9]+$/', $_POST["enterUser"]) &&
			    preg_match('/^[-a-zA-Z0-9]+$/', $_POST["enterPassword"])) {

				$encript = crypt($_POST["enterPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			    $table = "usuarios";

			    $item = "usuario";

			    $value = $_POST["enterUser"];

			    $answer = UserModel::MdlShowUsers($table, $item, $value);

			    if($answer['usuario'] ==  $_POST["enterUser"] && $answer['password'] == $encript) {

			    	$_SESSION['isLogIn'] = "ok";
			    	$_SESSION["id"] = $answer["id"];
					$_SESSION["nombre"] = $answer["nombre"];
					$_SESSION["usuario"] = $answer["usuario"];
					$_SESSION["foto"] = $answer["foto"];
					$_SESSION["perfil"] = $answer["perfil"];


			    	echo '<script>

						window.location = "main";

			    	</script>';


			    }else{

			    	echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentar</div>';

			    }

		    }

    	}
    }

    /*========================
	=  Create a user record  =
	========================*/

	static public function ctrlCreateUser() {

	if (isset($_POST["newUser"])) {
		
		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])) {

			    /*========================
				=    Immage Validation   =
				========================*/

				$route = "";

				if (isset($_FILES["newPhoto"]["tmp_name"])) {

					list($width, $heigth) = getimagesize($_FILES["newPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeigth= 500;
			 	
			 		/*========================
					=    Immage Validation   =
					========================*/

					$directory = "views/img/users/".$_POST["newUser"];

					mkdir($directory,  0755);

					/*=======================================================
					=    According to the image php functions are applied   =
					========================================================*/

					if ($_FILES["newPhoto"]["type"] == "image/jpeg") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/users/".$_POST["newUser"]."/".$random.".jpg";

						$origin = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagejpeg($destiny, $route);

					}

					if ($_FILES["newPhoto"]["type"] == "image/png") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/users/".$_POST["newUser"]."/".$random.".png";

						$origin = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagepng($destiny, $route);

					}

				}
			
				$table = "usuarios";

				$encript = crypt($_POST["newPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$data = array("nombre" => $_POST["newName"],
					           "usuario" => $_POST["newUser"],
					           "password" => $encript,
					           "perfil" => $_POST["newProfile"],
					       	   "foto" => $route);

				$answer = UserModel::mdlAddUser($table, $data);
			
				if($answer == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "users";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "users";

						}

					});
				

				</script>';

			}


		}


	}
		
}