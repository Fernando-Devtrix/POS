/*=============================================
=            Edit Category                  =
=============================================*/

$(".btnEditCategory").click(function() {

	var idCategory = $(this).attr("idCategory");

	var data = new FormData();
	data.append("idCategory", idCategory);

	$.ajax({

		url: "ajax/categories.ajax.php",
		method: "POST",
    data: data,
  	cache: false,
    contentType: false,
  	processData: false,
   	dataType:"json",
   	success: function(answer) {

        $("#editCategory").val(answer["categoria"]);
     		$("#idCategory").val(answer["id"]);
     		
     	}

	});

});

/*=============================================
=            Delete Category                  =
=============================================*/

$(".btnDeleteCategory").click(function() {
 
  var idCategory = $(this).attr("idCategory");

   swal({
    title: '¿Está seguro de borrar la categoría?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar categoría!'
   }).then((result)=>{

      if (result.value) {

        window.location = "index.php?route=categories&idCategory="+idCategory;

      }

   });

});


