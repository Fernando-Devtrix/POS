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

			    if($answer["usuario"] ==  $_POST["enterUser"] && $answer['password'] == $encript) {

			    	if ($answer["estado"] == 1) {
			    		
				    	$_SESSION["isLogIn"] = "ok";
				    	$_SESSION["id"] = $answer["id"];
						$_SESSION["nombre"] = $answer["nombre"];
						$_SESSION["usuario"] = $answer["usuario"];
						$_SESSION["foto"] = $answer["foto"];
						$_SESSION["perfil"] = $answer["perfil"];

						/*==========================
						=      Register last login =
						===========================*/

						date_default_timezone_set('America/Mexico_City');

						$date = date('Y-m-d');
						$hour = date('H:i:s');

						$currentDate = $date.' '.$hour;

						$item1 = "ultimo_login";
						$value1 = $currentDate;

						$item2 = "id";
						$value2 = $answer["id"];

						$lastLogin = UserModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

						if ($lastLogin == "ok") {
							
					    	echo '<script>

								window.location = "main";

					    	</script>';

						}


			    	}else{

			    		echo '<br>
					    	<div class="alert alert-danger">El usuario no está activado</div>';
			    	}

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

	/*========================
	=      Show User        =
	========================*/

	static public function ctrlShowUser($item, $value) {

	$table = "usuarios";	
	$answer = UserModel::MdlShowUsers($table, $item, $value);

	return $answer;

	}

	/*========================
	=      Edit User        =
	========================*/

	static public function ctrlEditUser() {

		if (isset($_POST["editUser"])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editName"])) {
			 	
		 		/*========================
				=    Immage Validation   =
				========================*/

				$route = $_POST["currentPhoto"];

				if (isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])) {

					list($width, $heigth) = getimagesize($_FILES["editPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeigth= 500;

					$directory = "views/img/users/".$_POST["editUser"];

					/*======================================
					=    Ask if there exit and img in Db   =
					=======================================*/

					if (!empty($_POST["currentPhoto"])) {
						
						unlink($_POST["currentPhoto"]);

					}else{

						mkdir($directory,  0755);
						
					}


					/*=======================================================
					=    According to the image php functions are applied   =
					========================================================*/

					if ($_FILES["editPhoto"]["type"] == "image/jpeg") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/users/".$_POST["editUser"]."/".$random.".jpg";

						$origin = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagejpeg($destiny, $route);

					}

					if ($_FILES["editPhoto"]["type"] == "image/png") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/users/".$_POST["editUser"]."/".$random.".png";

						$origin = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagepng($destiny, $route);

					}

				}

				$table = "usuarios";

				if ($_POST["editPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editPassword"])) {
						
						$encript = crypt($_POST["editPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					
					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';
					}

				}else{

					$encript = $_POST["currentPassword"];

				}

				$data = array("nombre" => $_POST["editName"],
						   	  "usuario" => $_POST["editUser"],
						   	  "password" => $encript,
						   	  "perfil" => $_POST["editProfile"],
						      "foto" => $route);

				$answer = UserModel::mdlEditUser($table, $data);

				if($answer == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido editado correctamente!",
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
								title: "El nombre no puede ir vacío o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){

									if(result.value){
									
										window.location = "users";

									}

								});
						

							</script>';

			}
			
		}

	}


	/*========================
	=    Delete User         =
	========================*/

	static public function ctrlDeleteUser() {

		if (isset($_GET["userID"])) {
			
			$table = "usuarios";
			$data = $_GET["userID"];

			if ($_GET["userPhoto"] != "") {
				
				unlink($_GET["userPhoto"]);
				rmdir('views/img/users/'.$_GET['user']);

			}

			$answer = UserModel::mdlDeleteUser($table, $data);

			if($answer == "ok"){

				echo '<script>

				swal({

					type: "success",
					title: "¡El usuario ha sido borrado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
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