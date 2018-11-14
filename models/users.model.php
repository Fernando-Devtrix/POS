<?php 

require_once "conection.php";

class UserModel {

	/*========================
	=      Show Users       =
	========================*/
	
	static public function mdlShowUsers($table, $item, $value) {

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

	/*========================
	=      Edit Users       =
	========================*/

	static public function mdlEditUser($table, $data) {

		$stmt = Conection::conect()->prepare("UPDATE $table SET nombre = :nombre, password = :password, perfil = :perfil, foto =:foto WHERE usuario = :usuario");

		$stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR); 
		$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR); 
		$stmt -> bindParam(":perfil", $data["perfil"], PDO::PARAM_STR); 
		$stmt -> bindParam(":foto", $data["foto"], PDO::PARAM_STR); 
		$stmt -> bindParam(":usuario", $data["usuario"], PDO::PARAM_STR); 

		if ($stmt -> execute()) {
			
			return "ok";

		}else {

			return "error";

		}

		$stmt -> close();		

		$stmt = null; 

	}

	/*========================
	=    Update Users Status =
	========================*/	

	static public function mdlUpdateUser($table, $item1, $value1, $item2, $value2){

			$stmt = Conection::conect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

			$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);

			if($stmt -> execute()){

				return "ok";
			
			}else{

				return "error";	

			}

			$stmt -> close();

			$stmt = null;

	}
	
	/*========================
	=    Update Users Status =
	========================*/

	static public function mdlDeleteUser($table, $data) {

			$stmt = Conection::conect()->prepare("DELETE FROM $table WHERE id = :id");

			$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

			if($stmt -> execute()){

				return "ok";
			
			}else{

				return "error";	

			}

			$stmt -> close();

			$stmt = null;


	}

}