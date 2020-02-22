<?php 

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class ProductsTable {

	/*=============================================
	=            SHOW PRODUCTS TABLE              =
	=============================================*/

	public function showProductsTable() {

	    $item = null;
        $value = null;
        $order = "id";

        $products = ProductsController::ctrlShowProducts($item, $value, $order);
		        
        $jsonData = '{
				  "data": [';

				  for($i = 0; $i < count($products); $i++) {

				  	/*=============================================
					=                 GET IMAGE                   =
					=============================================*/

					 $image = "<img src='".$products[$i]["imagen"]."' width='40px'>";

					/*=============================================
					=                 GET CATEGORY               =
					=============================================*/

					 $item = "id";
					 $value = $products[$i]["id_categoria"];

					 $categories = CategoriesController::ctrlShowCategories($item, $value);

					/*=============================================
					=                 GET STOCK                   =
					=============================================*/

					if ($products[$i]["stock"] <= 10) {
						
						$stock = "<button class='btn btn-danger'>".$products[$i]["stock"]."</button>";
					
					}else if ($products[$i]["stock"] >= 11 && $products[$i]["stock"] <= 15) {
						
						$stock = "<button class='btn btn-warning'>".$products[$i]["stock"]."</button>";

					}else {

						$stock = "<button class='btn btn-success'>".$products[$i]["stock"]."</button>";
						
					}

					/*=============================================
					=                 GET ACTIONS                 =
					=============================================*/

					if (isset($_GET["hiddenProfile"]) && $_GET["hiddenProfile"] == "Especial") {
						
						$buttons = "<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='".$products[$i]["id"]."' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button></div>";

					} else {

				    	$buttons = "<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='".$products[$i]["id"]."' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeleteProduct' idProduct='".$products[$i]["id"]."' code='".$products[$i]["codigo"]."' image='".$products[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";

					}

				     
				  	 $jsonData .='[
				      "'.($i+1).'",
				      "'.$image.'",
				      "'.$products[$i]["codigo"].'",
				      "'.$products[$i]["descripcion"].'",
				      "'.$categories["categoria"].'",
				      "'.$stock.'",
				      "'.$products[$i]["precio_compra"].'",
				      "'.$products[$i]["precio_venta"].'",
				      "'.$products[$i]["fecha"].'",
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

$activateProducts = new ProductsTable();
$activateProducts -> showProductsTable();