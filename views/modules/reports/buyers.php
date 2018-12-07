<?php 

$item = null;
$value = null;

$sells = SellsController::ctrlShowSells($item, $value);
$clients = ClientsController::ctrlShowClients($item, $value);

$clientsArray = array();
$clientsListArray = array();

foreach ($sells as $key => $valueSells) {
	
	foreach ($clients as $key => $valueClients) {
	
		if ($valueSells["id_cliente"] == $valueClients["id"]) {

			//Get sellers array
			array_push($clientsArray, $valueClients["nombre"]);

			//Get names and net values in one array
			$clientsListArray = array($valueClients["nombre"] => $valueSells["neto"]);
		
			//Sum each net seller quantity 

			foreach ($clientsListArray as $key => $value) {
				
				$sumTotalClients[$key] += $value;

		  	}

		}

	}

}

//Avoid repeting names

$noRepeatNames = array_unique($clientsArray);

?>	
	<!--===========================
	=    Create Product         =
	===========================-->
<div class="box box-primary">
	
	<div class="box box-header with-border">
		
		<h3 class="box-tittle">Compradores</h3>

	</div>

	<div class="box-body">

		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart2" style="height: 300px;"></div>

		</div>
		
	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart2',
  resize: true,
  data: [
     <?php
    
    foreach($noRepeatNames as $value){

      echo "{y: '".$value."', a: '".$sumTotalClients[$value]."'},";

    }

  ?>

  ],
  barColors: ['#00a65a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Compras'],
  preUnits: '$',
  hideHover: 'auto'
});
</script>