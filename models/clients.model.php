<?php 

require_once "conection.php";

class ClientsModel {

	/*=============================================
	=                CREATE CLIENT                =
	=============================================*/

	static public function mdlAddClient($table, $data) {

		$stmt = Conection::conect()->prepare("INSERT INTO $table(nombre, documento, email, telefono, direccion, fecha_nacimiento) VALUES (:nombre, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");

		$stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $data["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $data["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $data["fecha_nacimiento"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		}else {

			return "error";

		}

		$stmt->close();		

		$stmt = null; 

	}
	
}	