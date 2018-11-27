<?php 

require_once "conection.php";

class SellsModel{

	/*=============================================
	=                 SHOW SELLS                  =
	=============================================*/

	static public function mdlShowSells($table, $item, $value) {

		if ($item != null) {
					
			$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY fecha DESC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conection::conect()->prepare("SELECT * FROM $table ORDER BY fecha DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

			$stmt -> close();

			$stmt = null;

	}

}
	





