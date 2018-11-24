<?php

class ClientsController {

	/*=============================================
	=              CREATE CLIENTS                =
	=============================================*/
	
	static public function ctrlCreateUser() {

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
	
}
