<?php

class SellsController {

	/*=============================================
	=                  SHOW SELLS                 =
	=============================================*/
	
	static public function ctrlShowSells($item, $value) {

		$table = "ventas";

		$answer = SellsModel::mdlShowSells($table, $item, $value);

		return $answer;
	}

	/*=============================================
	=              CREATE SELLS                   =
	=============================================*/

	static public function ctrlCreateSell() {

		if (isset($_POST["newPurchase"])) {	

			/*==============================================================================
			= Update client's purchases and decrease the stock and increase priducts sells =
			===============================================================================*/
	
			$listProducts = json_decode($_POST["listProducts"], true);

			$totalProductsBought = array();

			foreach ($listProducts as $key => $value) {

				array_push($totalProductsBought, $value["cantidad"]);
				
				$productsTable = "productos";

				$item = "id";
				$val = $value["id"];

				$getProduct = ModelProducts::mdlShowProducts($productsTable, $item, $val);

				$item1a = "ventas";
				$val1a = $value["cantidad"] + $getProduct["ventas"];

				$newSells = ModelProducts::mdlUpdateProduct($productsTable, $item1a, $val1a, $val);

				$item1b = "stock";
				$val1b = $value["stock"];

				$newStock = ModelProducts::mdlUpdateProduct($productsTable, $item1b, $val1b, $val);

			}

			$clientsTable = "clientes";

			$item = "id";
			$value = $_POST["addClient"];

			$getClients = ClientsModel::mdlShowClients($clientsTable, $item, $value);

			//var_dump($getClients["compras"]);

			$item1a = "compras";
			$value1 = array_sum($totalProductsBought) + $getClients["compras"];

			$clientsPurchases = ClientsModel::mdlUpdateClient($clientsTable, $item1a, $value1, $value);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Mexico_City');

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b = $date.' '.$hour;

			$clientDate = ClientsModel::mdlUpdateClient($clientsTable, $item1b, $value1b, $value);

			/*=============================================
			=                  STORE PURCHASE             =
			=============================================*/

			$table = "ventas";

			$data = array("id_vendedor"=>$_POST["idSeller"],
						   "id_cliente"=>$_POST["addClient"],
						   "codigo"=>$_POST["newPurchase"],
						   "productos"=>$_POST["listProducts"],
						   "impuesto"=>$_POST["newTaxPrice"],
						   "neto"=>$_POST["newTaxNet"],
						   "total"=>$_POST["totalSell"],
						   "metodo_pago"=>$_POST["listPaymentMethod"]);

			$answer = SellsModel::mdlAddSell($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "sells";

								}
							})

				</script>';

			}


		}

	}

	/*=============================================
	=              EDIT SELLS                   =
	=============================================*/

	static public function ctrlEditSell() {

		if (isset($_POST["editPurchase"])) {	

			/*==================================
			= Reset products and clients table =
			====================================*/

			$table = "ventas";

			$item = "codigo";
			$val = $_POST["editPurchase"];

			$getSell = SellsModel::mdlShowSells($table, $item, $val);

			/*=======================================
			= Check out if products are being edited =
			========================================*/

			if ($_POST["listProducts"] == "") {
				
				$listProducts = $getSell["productos"];
				$isProductChange = false;

			}else{

				$listProducts = $_POST["listProducts"]; 
				$isProductChange = true;
			}

			if ($isProductChange) {
	
				$products = json_decode($getSell["productos"], true);

				$totalProductsBought = array();

				foreach ($products as $key => $value) {

					array_push($totalProductsBought, $value["cantidad"]);

				 	$productsTable = "productos";

					$item = "id";
				 	$val = $value["id"];

				 	$getProduct = ModelProducts::mdlShowProducts($productsTable, $item, $val);

				 	$item1a = "ventas";
				 	$val1a = $getProduct["ventas"] - $value["cantidad"];

				 	$newSells = ModelProducts::mdlUpdateProduct($productsTable, $item1a, $val1a, $val);

				  	$item1b = "stock";
				 	$val1b = $value["cantidad"] + $getProduct["stock"];

				 	$newStock = ModelProducts::mdlUpdateProduct($productsTable, $item1b, $val1b, $val);
					
				}

				$clientsTable = "clientes";

				$itemClient = "id";
				$valueClient = $_POST["addClient"];

				$getClients = ClientsModel::mdlShowClients($clientsTable, $itemClient, $valueClient);

				$item1a = "compras";
				$value1 = $getClients["compras"] - array_sum($totalProductsBought);

				$clientsPurchases = ClientsModel::mdlUpdateClient($clientsTable, $item1a, $value1, $value);

				/*==============================================================================
				= Update client's purchases and decrease the stock and increase priducts sells =
				===============================================================================*/
		
				$listProducts_2 = json_decode($listProducts, true);

				$totalProductsBought_2 = array();

				foreach ($listProducts_2 as $key => $value) {

					array_push($totalProductsBought_2, $value["cantidad"]);
					
					$productsTable_2 = "productos";

					$item_2 = "id";
					$val_2 = $value["id"];

					$getProduct_2 = ModelProducts::mdlShowProducts($productsTable_2, $item_2, $val_2);

					$item1a_2 = "ventas";
					$val1a_2 = $value["cantidad"] + $getProduct_2["ventas"];

					$newSells_2 = ModelProducts::mdlUpdateProduct($productsTable_2, $item1a_2, $val1a_2, $val_2);

					$item1b_2 = "stock";
					$val1b_2 = $value["stock"];

					$newStock_2 = ModelProducts::mdlUpdateProduct($productsTable_2, $item1b_2, $val1b_2, $val_2);

				}

				$clientsTable_2 = "clientes";

				$item_2 = "id";
				$value_2 = $_POST["addClient"];

				$getClients_2 = ClientsModel::mdlShowClients($clientsTable_2, $item_2, $value_2);

				//var_dump($getClients["compras"]);

				$item1a_2 = "compras";
				$value1_2 = array_sum($totalProductsBought) + $getClients_2["compras"];

				$clientsPurchases_2 = ClientsModel::mdlUpdateClient($clientsTable_2, $item1a_2, $value1_2, $value_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Mexico_City');

				$date = date('Y-m-d');
				$hour = date('H:i:s');
				$value1b_2 = $date.' '.$hour;

				$clientDate_2 = ClientsModel::mdlUpdateClient($clientsTable_2, $item1b_2, $value1b_2, $value_2);
					

				}

			/*=============================================
			=            STORE PURCHASE CHANGES           =
			=============================================*/

			$data = array("id_vendedor"=>$_POST["idSeller"],
						   "id_cliente"=>$_POST["addClient"],
						   "codigo"=>$_POST["editPurchase"],
						   "productos"=>$listProducts,
						   "impuesto"=>$_POST["newTaxPrice"],
						   "neto"=>$_POST["newTaxNet"],
						   "total"=>$_POST["totalSell"],
						   "metodo_pago"=>$_POST["listPaymentMethod"]);

			$answer = SellsModel::mdlEditSell($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "sells";

								}
							})

				</script>';

			}

		}

	}

	/*==================================
	=            DELETE SELL           =
	====================================*/

	public static function ctrlDeleteSell() {

		if (isset($_GET["idSell"])) {
			
			$table = "ventas";

			$item = "id";
			$value = $_GET["idSell"];

			$getSell = SellsModel::mdlShowSells($table, $item, $value);

			/*===================================
			=         UPDATE LAST SELL          =
			====================================*/

			$clientsTable = "clientes";

			$sellsItem = null;
			$sellsValue = null;

			$getSells = SellsModel::mdlShowSells($table, $sellsItem, $sellsValue);

			$storeDate = array();

			foreach ($getSells as $key => $value) {
				
				if ($value["id_cliente"] == $getSell["id_cliente"]) {
					
					array_push($storeDate, $value["fecha"]);

				}

			}

			if (count($storeDate) > 1) {

				if ($getSell["fecha"] > $storeDate[count($storeDate)-2]) {
					
					$item = "ultima_compra";
					$value = $storeDate[count($storeDate)-2];
					$idClientValue = $getSell["id_cliente"]; 

					$clientPurchases = ClientsModel::mdlUpdateClient($clientsTable, $item, $value, $idClientValue);
					
				}else{

					$item = "ultima_compra";
					$value = $storeDate[count($storeDate)-1];	
					$idClientValue = $getSell["id_cliente"];

					$clientPurchases = ClientsModel::mdlUpdateClient($clientsTable, $item, $value, $idClientValue);
				}

			}else{

				$item = "ultima_compra";
				$value = "0000-00-00 00:00:00";
				$idClientValue = $getSell["id_cliente"];

				$clientPurchases = ClientsModel::mdlUpdateClient($clientsTable, $item, $value, $idClientValue);

			}

			/*===============================================
			=         RESET PRODUCTS AND CLIENTS TABLES     =
			================================================*/

			$products = json_decode($getSell["productos"], true);

				$totalProductsBought = array();

				foreach ($products as $key => $value) {

					array_push($totalProductsBought, $value["cantidad"]);

				 	$productsTable = "productos";

					$item = "id";
				 	$val = $value["id"];

				 	$getProduct = ModelProducts::mdlShowProducts($productsTable, $item, $val);

				 	$item1a = "ventas";
				 	$val1a = $getProduct["ventas"] - $value["cantidad"];

				 	$newSells = ModelProducts::mdlUpdateProduct($productsTable, $item1a, $val1a, $val);

				  	$item1b = "stock";
				 	$val1b = $value["cantidad"] + $getProduct["stock"];

				 	$newStock = ModelProducts::mdlUpdateProduct($productsTable, $item1b, $val1b, $val);
					
				}

				$clientsTable = "clientes";

				$itemClient = "id";
				$valueClient = $getSell["id_cliente"];

				$getClients = ClientsModel::mdlShowClients($clientsTable, $itemClient, $valueClient);

				$item1a = "compras";
				$value1 = $getClients["compras"] - array_sum($totalProductsBought);

				$clientsPurchases = ClientsModel::mdlUpdateClient($clientsTable, $item1a, $value1, $valueClient);

				/*========================
				=        DELETE SELL     =
				=========================*/

				$answer = SellsModel::mdlDeleteSell($table, $_GET["idSell"]);

				if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La venta ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "sells";

									}
								})

					</script>';

				}	

		}

	}
	
}