<?php

 class CategoriesController {

 	/*=============================================
 	=            Create Categories                =
 	=============================================*/

 	static public function ctrlCreateCategory() {

 		if (isset($_POST["newCategory"])) {

 			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])) {
 				
 				$table = "categorias";

 				$data = $_POST["newCategory"];

 				$answer = CategoriesModel::mdlAddCategory($table, $data);

 				if ($answer == "ok") {

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
 	=            Show Categories                 =
 	=============================================*/

 	static public function ctrlShowCategories($item, $value) {

 		$table = "categorias";

 		$answer = CategoriesModel::mdlShowCategories($table, $item, $value);

 		return $answer;
 	}

  	/*=============================================
 	=            Edit Categories                =
 	=============================================*/

 	static public function ctrlEditCategory() {

 		if (isset($_POST["editCategory"])) {

 			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCategory"])) {
 				
 				$table = "categorias";

 				$data = array("categoria"=>$_POST["editCategory"],
 							   "id"=>$_POST["idCategory"]);

 				$answer = CategoriesModel::mdlEditCategory($table, $data);

 				if ($answer == "ok") {

 					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido modificada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';
 					
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

 	}

 	/*=============================================
 	=            Delete Categories                =
 	=============================================*/

 	static public function ctrlDeleteCategory() {

 		if (isset($_GET["idCategory"])) {
 			
 			$table = "categorias";
 			$data = $_GET["idCategory"];

 			$answer = CategoriesModel::mdlDeleteCategory($table, $data);

 			if ($answer == "ok") {

 					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
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
 	
 }
