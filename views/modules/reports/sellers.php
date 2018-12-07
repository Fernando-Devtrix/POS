<?php

$item = null;
$valor = null;

$sells = SellsController::ctrlShowSells($item, $valor);
$users = UserController::ctrlShowUser($item, $valor);

$sellersArray = array();
$sellersListArray = array();

foreach ($sells as $key => $valueSells) {

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

    <?php
    
    foreach($noRepeatNames as $value){

      echo "{y: '".$value."', a: '".$sellersTotalSum[$value]."'},";

    }

  ?>
  
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Ventas'],
  hideHover: 'auto'
});
</script>