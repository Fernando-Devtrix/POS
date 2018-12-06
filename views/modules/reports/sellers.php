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
    {y: 'Jesus', a: 100},
    {y: 'Kike', a: 75},
    {y: 'IPhone', a: 50},
  
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Ventas'],
  hideHover: 'auto'
});
</script>