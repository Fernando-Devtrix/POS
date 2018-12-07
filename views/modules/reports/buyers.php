<<<<<<< HEAD
<?php 

$item = null;
$value = null;

$sells = SellsController::ctrlShowSells($item, $value);
$clients = ClientsController::ctrlShowClients($item, $value);
=======
<?php

$item = null;
$valor = null;

$sells = SellsController::ctrlShowSells($item, $valor);
$clients = ClientsController::ctrlShowClients($item, $valor);
>>>>>>> 6e678b393eb016e8ec95dc291116f3313b5fed2a

$clientsArray = array();
$clientsListArray = array();

foreach ($sells as $key => $valueSells) {
<<<<<<< HEAD
	
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
=======
  
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

>>>>>>> 6e678b393eb016e8ec95dc291116f3313b5fed2a
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
<<<<<<< HEAD
     <?php
    
    foreach($noRepeatNames as $value){

      echo "{y: '".$value."', a: '".$sumTotalClients[$value]."'},";
=======
    <?php
    
    foreach($noRepeatNames as $value){

      echo "{y: '".$value."', a: '".$clientsTotalSum[$value]."'},";
>>>>>>> 6e678b393eb016e8ec95dc291116f3313b5fed2a

    }

  ?>
<<<<<<< HEAD

=======
>>>>>>> 6e678b393eb016e8ec95dc291116f3313b5fed2a
  ],
  barColors: ['#00a65a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Compras'],
  preUnits: '$',
  hideHover: 'auto'
});
</script>