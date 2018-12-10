<?php 
  
  $item = null;
  $value = null;
  $order = "id";

  $sells = SellsController::ctrlSumTotalSells();

  $categories = CategoriesController::ctrlShowCategories($item, $value);
  $totalCategories = count($categories);

  $clients = ClientsController::ctrlShowClients($item, $value);
  $totalClients = count($clients);

  $products = ProductsController::ctrlShowProducts($item, $value, $order);
  $totalProducts = count($products);

?>


<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3>$<?php echo number_format($sells["total"], 2); ?></h3>

      <p>Ventas</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="sells" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo $totalCategories; ?></h3>

      <p>Categorías</p>

    </div>

    <div class="icon">

      <i class="ion ion-clipboard"></i>

    </div>

    <a href="categories" class="small-box-footer">

    Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3><?php echo $totalClients; ?></h3>

      <p>Clientes</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="clients" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3><?php echo $totalProducts; ?></h3>

      <p>Productos</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-cart"></i>

    </div>

    <a href="products" class="small-box-footer">

    Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>