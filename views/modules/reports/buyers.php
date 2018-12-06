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
    {y: 'Miguel', a: 100},
    {y: 'Juan', a: 75},
    {y: 'Jorge', a: 50}
  ],
  barColors: ['#00a65a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Compras'],
  preUnits: '$',
  hideHover: 'auto'
});
</script>