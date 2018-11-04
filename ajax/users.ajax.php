<?php 

	require_once "../controllers/users.controller.php";
	require_once "../models/users.model.php";

class AjaxUsuarios{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $userID;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->userID;

		$answer = UserController::ctrlShowUser($item, $valor);

		echo json_encode($answer);

	}

	}
	
/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["userID"])){

	$edit = new AjaxUsuarios();
	$edit -> userID = $_POST["userID"];
	$edit -> ajaxEditarUsuario();

}
 ?>