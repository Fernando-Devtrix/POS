<?php 

require_once "conection.php";

class SellsModel{

	/*=============================================
	=                 SHOW SELLS                  =
	=============================================*/

	static public function mdlShowSells($table, $item, $value) {

		if ($item != null) {
					
			$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conection::conect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

			$stmt -> close();

			$stmt = null;

	}

	/*=============================================
	=                 ADD SELLS                  =
	=============================================*/

	static public function mdlAddSell($table, $data) {

		$stmt = Conection::conect()->prepare("INSERT INTO $table(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago)");

		$stmt->bindParam(":codigo", $data["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $data["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $data["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $data["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $data["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $data["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $data["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $data["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}
	





