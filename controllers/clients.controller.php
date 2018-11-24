<?php

class ClientsController {

	/*=============================================
	=              CREATE CLIENTS                =
	=============================================*/
	
	static public function ctrlCreateClient() {

		if (isset($_POST["newClient"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newClient"]) &&
			   preg_match('/^[0-9]+$/', $_POST["newFileId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["newEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newAddress"])) {
				
			   $table = "clientes";

			   $data = array("nombre"=>$_POST["newClient"],
						     "documento"=>$_POST["newFileId"],
						     "email"=> $_POST["newEmail"],
							 "telefono"=>$_POST["newPhone"],
							 "direccion"=>$_POST["newAddress"],
							 "fecha_nacimiento"=>$_POST["newBornDate"]);

			   $answer = ClientsModel::mdlAddClient($table, $data);

			   	if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clients";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clients";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	SHOW CLIENTS
	=============================================*/
	
	static public function ctrlShowClients($item, $value) {

		$table = "clientes";

		$answer = ClientsModel::mdlShowClients($table, $item, $value);

		return $answer;

	}

	/*=============================================
	=                EDIT CLIENTS                 =
	=============================================*/
	
	static public function ctrlEditClient() {

		if (isset($_POST["editClient"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editClient"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editFileId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editPhone"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editAddress"])) {
				
			   $table = "clientes";

			   $data = array("id"=>$_POST["idClient"],
			   				 "nombre"=>$_POST["editClient"],
						     "documento"=>$_POST["editFileId"],
						     "email"=> $_POST["editEmail"],
							 "telefono"=>$_POST["editPhone"],
							 "direccion"=>$_POST["editAddress"],
							 "fecha_nacimiento"=>$_POST["editBornDate"]);

			   $answer = ClientsModel::mdlEditClient($table, $data);

			   	if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clients";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clients";

							}
						})

			  	</script>';

			}

		}

	}


	/*=============================================
	=              DELETE CLIENTS                 =
	=============================================*/

	static public function ctrlDeleteClient() {

		if (isset($_GET["idClient"])) {
			
			$table = "clientes";

			$data = $_GET["idClient"]; 

			$answer = ClientsModel::mdlDeleteClient($table, $data);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clients";

								}
							})

				</script>';

			}	

		}

	}

}


