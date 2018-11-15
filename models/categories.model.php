<?php 

require_once 'conection.php';

class CategoriesModel {

	/*=============================================
                CREATE CATEGORIES
	=============================================*/

	static public function mdlAddCategory($table, $data) {

		$stmt = Conection::conect()->prepare("INSERT INTO $table(categoria) VALUES (:categoria)");

		$stmt -> bindParam(":categoria", $data, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	
	}

	/*=============================================
	=           SHOW CATEGORIES                   =
	=============================================*/

	static public function mdlShowCategories($table, $item, $value) {

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
                UPDATE CATEGORIES
	=============================================*/

	static public function mdlEditCategory($table, $data) {

		$stmt = Conection::conect()->prepare("UPDATE $table SET categoria = :categoria WHERE id = :id");

		$stmt -> bindParam(":categoria", $data["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $data["id"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	
	}

	/*=============================================
                DELETE CATEGORIES
	=============================================*/

	static public function mdlDeleteCategory($table, $data) {

		$stmt = Conection::conect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	
	}
	
}