<?php 

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class ProductsSellsTable {

	/*=============================================
	=            SHOW PRODUCTS TABLE              =
	=============================================*/

	public function showProductsSellsTable() {

	    $item = null;
        $value = null;

        $products = ProductsController::ctrlShowProducts($item, $value);
		        
        $jsonData = '{
				  "data": [';

				  for($i = 0; $i < count($products); $i++) {

				  	/*=============================================
					=                 GET IMAGE                   =
					=============================================*/

					 $image = "<img src='".$products[$i]["imagen"]."' width='40px'>";
			
					/*=============================================
					=                 GET STOCK                   =
					=============================================*/

					if ($products[$i]["stock"] <= 10) {
						
						$stock = "<button class='btn btn-danger'>".$products[$i]["stock"]."</button>";
					
					}else if ($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15) {
						
						$stock = "<button class='btn btn-warning'>".$products[$i]["stock"]."</button>";

					}else {

						$stock = "<button class='btn btn-success'>".$products[$i]["stock"]."</button>";
						
					}

					/*=============================================
					=                 GET ACTIONS                 =
					=============================================*/

				     $buttons = "<div class='btn-group'><button class='btn btn-primary addProduct retrieveButton' idProduct='".$products[$i]["id"]."'>Agregar Producto</button></div>";
				     
				  	 $jsonData .='[
				      "'.($i+1).'",
				      "'.$image.'",
				      "'.$products[$i]["codigo"].'",
				      "'.$products[$i]["descripcion"].'",
				      "'.$stock.'",
				      "'.$buttons.'"
				    ],';

				  }

				$jsonData = substr($jsonData, 0, -1);  

				$jsonData .=   ']

				}';

    		echo $jsonData;

	}

}

/*=============================================
=            ACTIVATE PRODUCTS TABLE          =
=============================================*/

$activateProducts = new ProductsSellsTable();
$activateProducts -> showProductsSellsTable();