<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class AjaxProducts{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $categoryID;

  public function ajaxCreateProductCode(){

    $item = "id_categoria";
    $value = $this->categoryID;

    $answer = ProductsController::ctrlShowProducts($item, $value);

    echo json_encode($answer);

  }

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/ 

if(isset($_POST["categoryID"])){

  $productCode = new AjaxProducts();
  $productCode -> categoryID = $_POST["categoryID"];
  $productCode -> ajaxCreateProductCode();

}





