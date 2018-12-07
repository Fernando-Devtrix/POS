<<<<<<< HEAD
<?php 

$item = null;
$value = null;

$sells = SellsController::ctrlShowSells($item, $value);
$users = UserController::ctrlShowUser($item, $value);
=======
<?php

$item = null;
$valor = null;

$sells = SellsController::ctrlShowSells($item, $valor);
$users = UserController::ctrlShowUser($item, $valor);
>>>>>>> 6e678b393eb016e8ec95dc291116f3313b5fed2a

$sellersArray = array();
$sellersListArray = array();

foreach ($sells as $key => $valueSells) {
<<<<<<< HEAD
	
	foreach ($users as $key => $valueUsers) {
	
		if ($valueSells["id_vendedor"] == $valueUsers["id"]) {

			//Get sellers array
			array_push($sellersArray, $valueUsers["nombre"]);

			//Get names and net values in one array
			$sellersListArray = array($valueUsers["nombre"] => $valueSells["neto"]);
		
			//Sum each net seller quantity 

			foreach ($sellersListArray as $key => $value) {
				
				$sumTotalSellers[$key] += $value;

		  	}

		}

	}

}

//Avoid repeting names

=======

  foreach ($users as $key => $valueUsers) {

    if($valueUsers["id"] == $valueSells["id_vendedor"]){

        //Get sellers into an array
        array_push($sellersArray, $valueUsers["nombre"]);

        //Get sellers and net values in the same array
        $sellersListArray = array($valueUsers["nombre"] => $valueSells["neto"]);

         //Sum nets of each seller
        foreach ($sellersListArray as $key => $value) {

            $sellersTotalSum[$key] += $value;

         }

    }
  
  }

}

//Avoid repeating names
>>>>>>> 6e678b393eb016e8ec95dc291116f3313b5fed2a
$noRepeatNames = array_unique($sellersArray);

?>

	<!--===========================
	=           SELLERS           =
	===========================-->
<div class="box box-success">
	
	<div class="box box-header with-border">
		
		<h3 class="box-tittle">Vendedores</h3>

	</div>

	<div class="box-body">

		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>
		
	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

<<<<<<< HEAD
  <?php 

  	foreach ($noRepeatNames as $value) {
  		
  		echo "{y: '".$value."', a: '".$sumTotalSellers[$value]."'},";

  	}

  ?>
    
=======
    <?php
    
    foreach($noRepeatNames as $value){

      echo "{y: '".$value."', a: '".$sellersTotalSum[$value]."'},";

    }

  ?>
  
>>>>>>> 6e678b393eb016e8ec95dc291116f3313b5fed2a
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Ventas'],
  preUnits: "$",
  hideHover: 'auto'
});

</script>