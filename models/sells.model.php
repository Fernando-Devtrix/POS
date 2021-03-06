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

	/*=============================================
	=               UPDATE SELLS                  =
	=============================================*/

	static public function mdlEditSell($table, $data) {

		$stmt = Conection::conect()->prepare("UPDATE $table SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total= :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

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

	/*=============================================
	=               DELETE SELLS                  =
	=============================================*/

	static public function mdlDeleteSell($table, $data){

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

	/*=============================================
	=                 DATES RANGES               =
	=============================================*/

	static public function mdlSellsDateRange($table, $starterDate, $lastDate) {

		if ($starterDate == null) {

			$stmt = Conection::conect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else if($starterDate == $lastDate){

			$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE fecha like '%$lastDate%'");

			$stmt -> bindParam(":fecha", $lastDate, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$currentDate = new DateTime();
			$currentDate ->add(new DateInterval("P1D"));
			$currentDatePlusOne = $currentDate->format("Y-m-d");

			$lastDate2 = new DateTime($lastDate);
			$lastDate2 ->add(new DateInterval("P1D"));
			$lastDatePlusOne = $lastDate2->format("Y-m-d");

			if ($lastDatePlusOne == $currentDatePlusOne) {

			$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE fecha BETWEEN '$starterDate' AND '$lastDatePlusOne'");
				
			}else{

			$stmt = Conection::conect()->prepare("SELECT * FROM $table WHERE fecha BETWEEN '$starterDate' AND '$lastDate'");

			}
			
			$stmt -> execute();

			return $stmt -> fetchAll();	

		}

	}

	/*===========================================
	=             SUM ALL SELLS                 =
	============================================*/

	static public function mdlSumTotalSells($table){	

		$stmt = Conection::conect()->prepare("SELECT SUM(neto) as total FROM $table");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}
	





