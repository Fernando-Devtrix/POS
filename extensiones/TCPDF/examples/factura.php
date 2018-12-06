<?php 

require_once "../../../controllers/sells.controller.php";
require_once "../../../models/sells.model.php";

require_once "../../../controllers/clients.controller.php";
require_once "../../../models/clients.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";


class printInvoice {

public $code;

public function getPrintedInvoice(){

//Get sell info

$sellItem = "codigo";
$sellValue = $this->code;

$sellAnswer = SellsController::ctrlShowSells($sellItem, $sellValue);

$date = substr($sellAnswer["fecha"],0, -8);
$products = json_decode($sellAnswer["productos"], true);
$neto = number_format($sellAnswer["neto"], 2);
$tax = number_format($sellAnswer["impuesto"], 2);
$total = number_format($sellAnswer["total"], 2);

//Get client info

$clientItem = "id";
$clientValue = $sellAnswer["id_cliente"];

$clientAnswer = ClientsController::ctrlShowClients($clientItem, $clientValue);

//Get seller info

$sellerItem = "id";
$sellerValue = $sellAnswer["id_vendedor"];

$sellerAnswer = UserController::ctrlShowUser($sellerItem, $sellerValue);


require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

/*----------  Bloque 1  ----------*/

$bloque1 = <<<EOF

	<table>

		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png" alt="logo"></td>

			<td style="background-color: white; width: 140px">

				<div style="font-size: 8.5px; text-align: right; line-height: 15px;">
					
					<br>
					Dirección: Calle 606 Col. Sta Julia

				</div>

			</td>

			<td style="background-color: white; width: 140px">

				<div style="font-size: 8.5px; text-align: right; line-height: 15px;">

					<br>
					Teléfono: 7715262181
					<br>
					fernando@outlook.es

				</div>
	
			</td>

			<td style="background-color: white; width: 110px; text-align: center; color:red">

			<br><br>
			FACTURA N°<br>$sellValue
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

/*--------------------------------*/


/*----------  Bloque 2  ----------*/

$bloque2 = <<<EOF

	<table>

		<tr>

			<td style="width:540"><img src="images/back.jpg" alt=""></td>

		</tr>

	</table>

	<table style="font-size: 10px; padding: 5px 10px;">

		<tr>

			<td style="border: 1px solid #666; background-color: white; width: 390px">

				Cliente: $clientAnswer[nombre]

			</td>

			<td style="border: 1px solid #666; background-color: white; width: 150px; text-align: right">

				Fecha: $date
				
			</td>

		</tr>

		<tr>

			<td style="border: 1px solid #666; background-color: white; width: 540px">Vendedor: $sellerAnswer[nombre]</td>

		</tr>

		<tr>

			<td style="border-bottom: 1px solid #666; background-color: white; width: 540px"></td>

		</tr>

	</table> 

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

/*--------------------------------*/


/*----------  Bloque 3  ----------*/

$bloque3 = <<<EOF

	<table style="font-size: 10px; padding: 5px 10px;">

		<tr>

			<td style="border: 1px solid #666; background-color: white; width: 260px; text-align: center">Producto</td>
			<td style="border: 1px solid #666; background-color: white; width: 80px; text-align: center">Cantidad</td>
			<td style="border: 1px solid #666; background-color: white; width: 100px; text-align: center">Valor Unit.</td>
			<td style="border: 1px solid #666; background-color: white; width: 100px; text-align: center">Valor Total</td>

		</tr>

	</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

/*--------------------------------*/


/*----------  Bloque 4  ----------*/

foreach ($products as $key => $value) {
	
$productItem = "descripcion";
$productValue = $value["descripcion"];
$order = null;

$productAnswer = ProductsController::ctrlShowProducts($productItem, $productValue, $order);

$unitValue = number_format($productAnswer["precio_venta"], 2);

$totalValue = number_format($value["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size: 10px; padding: 5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color: #333; background-color: white; width: 260px; text-align: center">

				$value[descripcion]
	
			</td>
			
			<td style="border: 1px solid #666; color: #333; background-color: white; width: 80px; text-align: center">

				$value[cantidad]
	
			</td>

			<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align: center">

				$unitValue
	
			</td>

			<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align: center">

				$totalValue
	
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

/*--------------------------------*/


/*----------  Bloque 4  ----------*/

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $tax
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>

		
	</table>


EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

/*--------------------------------*/



/*===============================
=        Output File            =
================================*/

$pdf->Output('factura.pdf');

}

}

$invoice = new printInvoice();
$invoice -> code = $_GET["codigo"];
$invoice -> getPrintedInvoice();

?>