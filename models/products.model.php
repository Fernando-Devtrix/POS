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

	# =============================================
	# =              ADD PRODUCTS                =
	# =============================================

	static function mdlAddProduct($table, $data) {

		$stmt = Conection::conect()->prepare("INSERT INTO $table(id_categoria, codigo, descripcion, stock, precio_compra, precio_venta, imagen) VALUES (:id_categoria, :codigo, :descripcion, :stock, :precio_compra, :precio_venta, :imagen)");
		
		$stmt->bindParam(":id_categoria", $data["id_categoria"], PDO::PARAM_STR); 
		$stmt->bindParam(":codigo", $data["codigo"], PDO::PARAM_STR); 
		$stmt->bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR); 
		$stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR); 
		$stmt->bindParam(":precio_compra", $data["precio_compra"], PDO::PARAM_STR); 
		$stmt->bindParam(":precio_venta", $data["precio_venta"], PDO::PARAM_STR); 
		$stmt->bindParam(":imagen", $data["imagen"], PDO::PARAM_STR); 


		if ($stmt->execute()) {
			
			return "ok";

		}else {

			return "error";

		}

		$stmt->close();		

		$stmt = null; 

	}

	# =============================================
	# =              ADD PRODUCTS                =
	# =============================================

	static function mdlEditProduct($table, $data) {

		$stmt = Conection::conect()->prepare("UPDATE $table SET id_categoria = :id_categoria, descripcion = :descripcion, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta, imagen = :imagen WHERE codigo = :codigo");
		
		$stmt->bindParam(":id_categoria", $data["id_categoria"], PDO::PARAM_STR); 
		$stmt->bindParam(":codigo", $data["codigo"], PDO::PARAM_STR); 
		$stmt->bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR); 
		$stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR); 
		$stmt->bindParam(":precio_compra", $data["precio_compra"], PDO::PARAM_STR); 
		$stmt->bindParam(":precio_venta", $data["precio_venta"], PDO::PARAM_STR); 
		$stmt->bindParam(":imagen", $data["imagen"], PDO::PARAM_STR); 


		if ($stmt->execute()) {
			
			return "ok";

		}else {

			return "error";

		}

		$stmt->close();		

		$stmt = null; 

	}

	# =============================================
	# =              DELETE PRODUCTS              =
	# =============================================
		
	static public function mdlDeleteProduct($table, $data) {
			
		$stmt = Conection::conect()->prepare("DELETE FROM $table WHERE id = :id");
			
		$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		}else {

			return "error";

		}

		$stmt->close();		

		$stmt = null; 
	}

 }
