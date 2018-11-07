<?php 

	require_once "../controllers/users.controller.php";
	require_once "../models/users.model.php";

class AjaxUsers{

	/*=============================================
	EDIT USER
	=============================================*/	

	public $userID;

	public function ajaxEditUser(){

		$item = "id";
		$value = $this->userID;

		$answer = UserController::ctrlShowUser($item, $value);

		echo json_encode($answer);

	}

	/*=============================================
	ACTIVE USUARIO
	=============================================*/	

	public $activateUser;
	public $activateId;

	public function ajaxActivateUser(){

		$table = "usuarios";

		$item1 = "estado";
		$value1 = $this->activateUser;

		$item2 = "id";
		$value2 = $this->activateId;


		$answer = UserModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

	}

	/*=============================================
				VALIDATE USER
	=============================================*/

	public $validateUser;

	public function ajaxValidateUser() {

		$item = "usuario";
		$value = $this->validateUser;

		$answer = UserController::ctrlShowUser($item, $value);

		echo json_encode($answer);

	}

}
	
/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["userID"])){

	$edit = new AjaxUsers();
	$edit -> userID = $_POST["userID"];
	$edit -> ajaxEditUser();

}

/*=============================================
ACTIVATE USER
=============================================*/	

if (isset($_POST["activateUser"])) {
	
	$activateUser = new AjaxUsers();
	$activateUser -> activateUser = $_POST["activateUser"];
	$activateUser -> activateId = $_POST["activateId"];
	$activateUser -> ajaxActivateUser();

}

/*=============================================
			VALIDATE USER
=============================================*/

if(isset($_POST["validateUser"])){

	$valUser = new AjaxUsers();
	$valUser -> validateUser = $_POST["validateUser"];
	$valUser -> ajaxValidateUser();

}

 ?>