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
    $order = "id";

    $answer = ProductsController::ctrlShowProducts($item, $value, $order);

    echo json_encode($answer);

  }

  public $idProduct;
  public $getAllProducts;
  public $productName;

  public function ajaxEditProduct() {

    if ($this->getAllProducts == "ok") {

       $item = null;
       $value = null;
       $order = "id";

       $answer = ProductsController::ctrlShowProducts($item, $value, $order);

       echo json_encode($answer);
        
    }else if($this->productName != "") {
      
       $item = "descripcion";
       $value = $this->productName;
       $order = "id";

       $answer = ProductsController::ctrlShowProducts($item, $value, $oder);

       echo json_encode($answer);

    }else{

       $item = "id";
       $value = $this->idProduct;
       $order = "id";

       $answer = ProductsController::ctrlShowProducts($item, $value, $order);

       echo json_encode($answer);

    }

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

if(isset($_POST["idProduct"])){

  $editProduct = new AjaxProducts();
  $editProduct -> idProduct = $_POST["idProduct"];
  $editProduct -> ajaxEditProduct();

}

if(isset($_POST["getAllProducts"])){

  $getAllProducts = new AjaxProducts();
  $getAllProducts -> getAllProducts = $_POST["getAllProducts"];
  $getAllProducts -> ajaxEditProduct();

}

if(isset($_POST["productName"])){

  $getAllProducts = new AjaxProducts();
  $getAllProducts -> productName = $_POST["productName"];
  $getAllProducts -> ajaxEditProduct();

}


