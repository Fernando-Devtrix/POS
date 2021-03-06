<?php   

  if ($_SESSION["perfil"] == "Especial") {

    echo '
      <script>
      
        window.location = "main";
        
      </script>
  
    ';

  }

?>

<div class="content-wrapper">

  <section class="content-header">
   
    <h1>

      Administrar ventas

    </h1>

    <ol class="breadcrumb">

      <li><a href="main"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar ventas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="create-sell">
          
          <button class="btn btn-primary">
            
            Agregar venta

          </button>
          
        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tables">
         
         <thead>
           
          <tr>
            
            <th style="width:10px">#</th>
            <th>Código factura</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Forma de pago</th>
            <th>Neto</th>
            <th>Total</th>
            <th>Fecha </th>
            <th>Acciones</th>

          </tr>

         </thead>

         <tbody>

          <?php 

          if (isset($_GET["starterDate"])) {

            $starterDate = $_GET["starterDate"];
            $lastDate = $_GET["lastDate"];

          }else{

            $starterDate = null;
            $lastDate = null;

          }

          $answer = SellsController::ctrlSellsDateRange($starterDate, $lastDate);

          foreach ($answer as $key => $value) {
            
            echo '<tr>

              <td>'.($key+1).'</td>

              <td>'.$value["codigo"].'</td>';

              $itemClient = "id";
              $valueClient = $value["id_cliente"];

              $answerClient = ClientsController::ctrlShowClients($itemClient, $valueClient);

              echo '<td>'.$answerClient["nombre"].'</td>';

              $itemUser = "id";
              $valueUser = $value["id_vendedor"];

              $answerUser = UserController::ctrlShowUser($itemUser, $valueUser);

              echo '<td>'.$answerUser["nombre"].'</td>

               <td>'.$value["metodo_pago"].'</td>

               <td>'.number_format($value["neto"],2).'</td>

               <td>'.number_format($value["total"],2).'</td>

               <td>'.$value["fecha"].'</td>
                
               <td>
                  
                  <div class="btn-group">
                    
                    <button class="btn btn-info btnPrintInvoice" sellCode="'.$value["codigo"].'"><i class="fa fa-print"></i></button>';
              
                     if($_SESSION["perfil"] == "Administrador") {

              echo '<button class="btn btn-warning btnEditSell" idSell="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                    
                    <button class="btn btn-danger btnDeleteSell" idSell="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                     }      

            echo '</div>

                </td>

              </tr>';
            }

          ?>
           
         </tbody>

       </table>

       <?php 

        $deleteSell = new SellsController();
        $deleteSell -> ctrlDeleteSell();

       ?>

      </div>

    </div>

  </section>

</div>

   







