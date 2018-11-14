<?php

 class CategoriesController {

 	static public function ctrlCreateCategory() {

 		if (isset($_POST["newCategory"])) {

 			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])) {
 				
 				$table = "categorias";

 				$data = $_POST["newCategory"];

 				$answer = CategoriesModel::mdlAddCategory($table, $data);

 				if ($answer == "ok") {
 					
 				}else{

 					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';
 				}

 			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categories";

							}
						})

			  	</script>';
			
 			}

 		}

 	}

 	/*=============================================
 	=            SHOW Categories                 =
 	=============================================*/

 	static public function ctrlShowCategories($item, $value) {

 		$table = "categorias";

 		$answer = CategoriesModel::mdlShowCategories($table, $item, $value);

 		return $answer;
 	}
 	
 }