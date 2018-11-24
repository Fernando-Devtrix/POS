<?php 

require_once "../controllers/clients.controller.php";
require_once "../models/clients.model.php";

class AjaxClients {

	/*=============================================
	=               Edit Clients                  =
	=============================================*/

	public $idClient;

	public function ajaxEditClient() {

		$item = "id";

		$value = $this->idClient;

		$answer = ClientsController::ctrlShowClients($item, $value);

		echo json_encode($answer);

	}

}

/*=============================================
=              Edit Client                    =
=============================================*/

if (isset($_POST["idClient"])) {
	
	$client = new AjaxClients();
	$client -> idClient = $_POST["idClient"];
	$client -> ajaxEditClient();

}