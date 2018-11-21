<?php

class ProductsController {

	static public function ctrlShowProducts($item, $value) {

		$table = "productos";

		$answer = ModelProducts::mdlShowProducts($table, $item, $value); 

		return $answer;

	}

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

}