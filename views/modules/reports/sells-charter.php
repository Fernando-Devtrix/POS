<?php 

error_reporting(0);

if (isset($_GET["starterDate"])) {

    $starterDate = $_GET["starterDate"];
    $lastDate = $_GET["lastDate"];

  }else{

    $starterDate = null;
    $lastDate = null;

  }

  $answer = SellsController::ctrlSellsDateRange($starterDate, $lastDate);

  $datesArray = array();
  $sellsArray = array();
  $sumMonthlyPayments = array();

  foreach ($answer as $key => $value) {
  	
  	//Get year and month  
  	$date = substr($value["fecha"], 0, 7);
  	
  	//Push dates into the array
  	array_push($datesArray, $date);

  	//Get Sells
  	$sellsArray = array($date => $value["total"]);

  	//Sum all payments
  	foreach ($sellsArray as $key => $value) {
  	
  		$sumMonthlyPayments[$key] += $value;

  	}


  }

 // var_dump($sumMonthlyPayments);

	// foreach ($datesArray as $key => $value) {
	// 	var_dump($key);
	// }

   $noRepeatDates = array_unique($datesArray);
   //var_dump($noRepeatDates);


?>

<!--=====================================
=            SELLS GRAPHIC              =
=======================================-->
<div class="box box-solid bg-teal-gradient">
	
	<div class="box-header">
		
		<i class="fa fa-th"></i>
			
			<h3 class="box-title">Gráfico de Ventas</h3>
			
	</div>

	<div class="box-body border-radious-none newSellsCharter">
		
		<div class="chart" id="line-chart-sells" style="height: 250px;"></div>

	</div>

</div>

<script>
	
	var line = new Morris.Line({
    element          : 'line-chart-sells',
    resize           : true,
    data             : [

    <?php 

    if ($noRepeatDates != null) {

    	foreach ($noRepeatDates as $key) {
    		
    		echo "{ y: '".$key."', ventas: '".$sumMonthlyPayments[$key]."' },";
    	}
    	
    }else{

    		echo "{ y: '0', ventas: '0' }";

    }


    		//echo "{ y: '".$value."', ventas: 2666 },";
    ?>
  
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['Ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10,
    preUnits 		 : "$"
  });

</script>



