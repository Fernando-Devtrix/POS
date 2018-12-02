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

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b = $date.' '.$hour;

			$clientsPurchases = ClientsModel::mdlUpdateClient($clientsTable, $item1b, $value1b, $value);

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

}