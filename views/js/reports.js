 /*=============================================
=         LOCAL STORAGE VARIABLE             =
=============================================*/

if (localStorage.getItem("getRange2") != null) {

	$("#daterange-btn2 span").html(localStorage.getItem("getRange2"));

}else{

	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i>Rango de fecha');
};


/*================================
=        DATE RANGE PICKER       =
=================================*/
$('#daterange-btn2').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

    var starterDate = start.format("YYYY-MM-DD");

    var lastDate = end.format("YYYY-MM-DD");

    var getRange = $("#daterange-btn2 span").html();

    localStorage.setItem("getRange2", getRange);

    window.location = "index.php?route=reports&starterDate="+starterDate+"&lastDate="+lastDate;

  }	
)

/*=============================================
	          CANCEL DATE RANGE
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("getRange2");
	localStorage.clear();
	window.location = "reports";

});

/*================================
=        RANGE DATE PICKER       =
=================================*/

$(".daterangepicker.opensright .ranges li").on("click", function(){

	var textToday = $(this).attr("data-range-key");

	if(textToday == "Hoy"){

		var d = new Date();
		
		var day = d.getDate();
		var month = d.getMonth()+1;
		var year = d.getFullYear();

		if (month < 10) {

			var startDate = year+"-0"+month+"-"+day;
			var lastDate = year+"-0"+month+"-"+day;

		}else if(day < 10) {

			var startDate = year+"-"+month+"-0"+day;
			var lastDate = year+"-"+month+"-0"+day;

		}else if(month < 10 && day < 10) {

			var startDate = year+"-"+month+"-"+day;
			var lastDate = year+"-"+month+"-"+day;
		
		}else{

			var startDate = year+"-"+month+"-"+day;
			var lastDate = year+"-"+month+"-"+day;

		}

		localStorage.setItem("getRange2", "Hoy");

    	window.location = "index.php?route=reports&starterDate="+startDate+"&lastDate="+lastDate;


	}

});

