<?php 

$item = null;
$value = null;
$order = "id";

$products = ProductsController::ctrlShowProducts($item, $value, $order);

?>

<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Productvos agregados recientemente</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>

  <div class="box-body">

    <ul class="products-list product-list-in-box">

      <?php  

        for($i = 0; $i < 5; $i++) {

          echo '<li class="item">

                  <div class="product-img">

                    <img src="'.$products[$i]["imagen"].'" alt="Product Image">

                  </div>

                  <div class="product-info">

                    <a href="#" class="product-title">

                      '.$products[$i]["descripcion"].'

                      <span class="label label-warning pull-right">$'.$products[$i]["precio_venta"].'</span></a>

                  </div>

              </li>';
        }

      ?>

    </ul>

  </div>
  
  <div class="box-footer text-center">
    <a href="products" class="uppercase">Ver todos los productos</a>
  </div>
  
</div>