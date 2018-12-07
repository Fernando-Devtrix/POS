<?php

$item = null;
$valor = null;

$sells = SellsController::ctrlShowSells($item, $valor);
$clients = ClientsController::ctrlShowClients($item, $valor);

$clientsArray = array();
$clientsListArray = array();

foreach ($sells as $key => $valueSells) {
  
  foreach ($clients as $key => $valueClients) {
    
      if($valueClients["id"] == $valueSells["id_cliente"]){

        //Get clients into an array
        array_push($clientsArray, $valueClients["nombre"]);

        //Get clients and net values in the same array
        $clientsListArray = array($valueClients["nombre"] => $valueSells["neto"]);

        //Sum nets of each client
        foreach ($clientsListArray as $key => $value) {
          
          $clientsTotalSum[$key] += $value;
        
        }

      }   
  }

}

//Avoid repeating names
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

      echo "{y: '".$value."', a: '".$clientsTotalSum[$value]."'},";

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