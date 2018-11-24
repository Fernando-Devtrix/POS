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

	/*=============================================
	=                 SHOW CLIENTS               =
	=============================================*/
	
	static public function mdlShowClients($table, $item, $value) {

		if ($item != null) {

			$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE $item = :$item");
			
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
				
		}else{

			$stmt = Conection::conect()->prepare("SELECT * FROM $table");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null; 
	}

	/*=============================================
	=                EDIT CLIENT                  =
	=============================================*/

	static public function mdlEditClient($table, $data) {

		$stmt = Conection::conect()->prepare("UPDATE $table SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE id = :id");

		$stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
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

  	/*==================================
	=          DELETE CLIENT           =
	===================================*/

	static public function mdlDeleteClient($table, $data) {

			$stmt = Conection::conect()->prepare("DELETE FROM $table WHERE id = :id");

			$stmt -> bindParam(":id", $data, PDO::PARAM_INT);

			if($stmt -> execute()){

				return "ok";
			
			}else{

				return "error";	

			}

			$stmt -> close();

			$stmt = null;


	}
	
}	