<?php 

require_once "../../controllers/clients.controller.php";
require_once "../../models/clients.model.php";

require_once "../../models/sells.model.php";
require_once "../../controllers/sells.controller.php";

require_once "../../models/users.model.php";
require_once "../../controllers/users.controller.php";

$report = new SellsController();
$report -> ctrlDownloadReport();

?> 