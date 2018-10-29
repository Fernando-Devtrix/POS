<?php 

require_once "conection.php";

class UserModel {

	/*========================
	=      Show Users       =
	========================*/
	
	static public function mdlShowUsers($table, $item, $value) {

		$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE $item = :$item");
		
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null; 
	}

	/*========================
	=      Record Users      =
	========================*/

	static function mdlAddUser($table, $data) {

		$stmt = Conection::conect()->prepare("INSERT INTO $table(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");
		
		$stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR); 
		$stmt->bindParam(":usuario", $data["usuario"], PDO::PARAM_STR); 
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR); 
		$stmt->bindParam(":perfil", $data["perfil"], PDO::PARAM_STR); 
		$stmt->bindParam(":foto", $data["foto"], PDO::PARAM_STR); 


		if ($stmt->execute()) {
			
			return "ok";

		}else {

			return "error";

		}

		$stmt->close();		

		$stmt = null; 

	}

}