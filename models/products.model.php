<?php 

require_once "conection.php";

class ModelProducts {

	# =============================================
	# =              SHOW PRODUCTS                =
	# =============================================
		
	static public function mdlShowProducts($table, $item, $value) {

		if ($item != null) {
			
			$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");
			
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

 }
