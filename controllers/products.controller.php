<?php

class ProductsController {

	static public function ctrlShowProducts($item, $value) {

		$table = "productos";

		$answer = ModelProducts::mdlShowProducts($table, $item, $value); 

		return $answer;

	}

	/*===========================
	=    Create Product         =
	===========================*/

	static public function ctrlCreateProduct() {

		if (isset($_POST["newDescription"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newDescription"]) &&
			    preg_match('/^[0-9]+$/', $_POST["newStock"]) &&	
			    preg_match('/^[0-9.]+$/', $_POST["newPricePurchase"]) &&
			    preg_match('/^[0-9.]+$/', $_POST["newPriceSell"])) {

		 		/*===========================
				=    Image Validation       =
				===========================*/

				$route = "views/img/products/default/anonymous.png";

				if (isset($_FILES["newImage"]["tmp_name"])) {

					list($width, $heigth) = getimagesize($_FILES["newImage"]["tmp_name"]);

					$newWidth = 500;
					$newHeigth= 500;
			 	
			 		/*===========================
					=    Create new directory   =
					===========================*/

					$directory = "views/img/products/".$_POST["newCode"];

					mkdir($directory,  0755);

					/*=======================================================
					=    According to the image php functions are applied   =
					========================================================*/

					if ($_FILES["newImage"]["type"] == "image/jpeg") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/products/".$_POST["newCode"]."/".$random.".jpg";

						$origin = imagecreatefromjpeg($_FILES["newImage"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagejpeg($destiny, $route);

					}

					if ($_FILES["newImage"]["type"] == "image/png") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/products/".$_POST["newCode"]."/".$random.".png";

						$origin = imagecreatefrompng($_FILES["newImage"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagepng($destiny, $route);

					}

				}

				$table = "productos";

				$data = array("id_categoria" => $_POST["newCategory"],
							   "codigo" => $_POST["newCode"],
							   "descripcion" => $_POST["newDescription"],
							   "stock" => $_POST["newStock"],
							   "precio_compra" => $_POST["newPricePurchase"],
							   "precio_venta" => $_POST["newPriceSell"],
							   "imagen" => $route);

				$answer = ModelProducts::mdlAddProduct($table, $data);

					if($answer == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "products";

										}
									})

						</script>';

				}


			}else{

    			echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "products";

							}
						})

			  	</script>';

			}

		}

	}

	/*===========================
	=    Edit  Product         =
	===========================*/

	static public function ctrlEditProduct() {

		if (isset($_POST["editDescription"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editDescription"]) &&
			    preg_match('/^[0-9]+$/', $_POST["editStock"]) &&	
			    preg_match('/^[0-9.]+$/', $_POST["editPricePurchase"]) &&
			    preg_match('/^[0-9.]+$/', $_POST["editPriceSell"])) {

		 		/*===========================
				=    Image Validation       =
				===========================*/

				$route = $_POST["currentImage"];

				if (isset($_FILES["editImage"]["tmp_name"]) && !empty($_FILES["editImage"]["tmp_name"])) {

					list($width, $heigth) = getimagesize($_FILES["editImage"]["tmp_name"]);

					$newWidth = 500;
					$newHeigth= 500;
			 	
			 		/*===========================
					=    Create new directory   =
					===========================*/

					$directory = "views/img/products/".$_POST["editCode"];

				   /*=======================================================
					=   Ask to the DB if already exits another photoc      =
					========================================================*/

					if (!empty($_POST["currentImage"]) && $_POST["currentImage"] != "views/img/products/default/anonymous.png") {

						unlink($_POST["currentImgae"]);
					
					}else{

						mkdir($directory,  0755);
						
					}

					/*=======================================================
					=    According to the image php functions are applied   =
					========================================================*/

					if ($_FILES["editImage"]["type"] == "image/jpeg") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/products/".$_POST["editCode"]."/".$random.".jpg";

						$origin = imagecreatefromjpeg($_FILES["editImage"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagejpeg($destiny, $route);

					}

					if ($_FILES["editImage"]["type"] == "image/png") {
						/*================================
						=    Save image into directory   =
						================================*/
						$random = mt_rand(100, 999);

						$route = "views/img/products/".$_POST["editCode"]."/".$random.".png";

						$origin = imagecreatefrompng($_FILES["editImage"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeigth);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

						imagepng($destiny, $route);

					}

				}

				$table = "productos";

				$data = array("id_categoria" => $_POST["editCategory"],
							   "codigo" => $_POST["editCode"],
							   "descripcion" => $_POST["editDescription"],
							   "stock" => $_POST["editStock"],
							   "precio_compra" => $_POST["editPricePurchase"],
							   "precio_venta" => $_POST["editPriceSell"],
							   "imagen" => $route);

				$answer = ModelProducts::mdlEditProduct($table, $data);

					if($answer == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "products";

										}
									})

						</script>';

				}


			}else{

    			echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "products";

							}
						})

			  	</script>';

			}

		}

	}

	/*===========================
	=    Delete  Product        =
	===========================*/

	public static function ctrlDeleteProduct() {

		if (isset($_GET["idProduct"])) {
			
			$table = "productos";
			$data = $_GET["idProduct"];

			if ($_GET["image"] != "" && $_GET["image"] !="views/img/products/default/anonymous.png") {
				
				unlink($_GET["image"]);
				rmdir('views/img/products/'.$_GET["code"]);
			}

			$answer = ModelProducts::mdlDeleteProduct($table, $data);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "products";

								}
							})

				</script>';

			}		

		}

	}

}