<?php   

  if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '
    
      <script>
      
        window.location = "main";
        
      </script>';

  }

?>
  <div class="content-wrapper">

    <section class="content-header">
     
      <h1>

        Reportes de Ventas

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes de Ventas</li>

      </ol>

    </section>

    <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <div class="input-group">
            
            <div class="input-group">
              
              <button type="button" class="btn btn-default" id="daterange-btn2">
                 
                  <span>
                    <i class="fa fa-calendar"></i> Rango de fecha
                  </span>

                  <i class="fa fa-caret-down"></i>

               </button>
              
            </div>
            
          </div>

          <div class="box-tools pull-right">

            <?php 

              if (isset($_GET["starterDate"])) {
              
                echo '<a href="views/modules/download-report.php?report=report&starterDate='.$_GET["starterDate"].'&lastDate='.$_GET["lastDate"].'">';
                
              }else{

                echo '<a href="views/modules/download-report.php?report=report">';
              }

            ?>
              
              <button class="btn btn-success" style="margin-top: 5px">Descargar reporte en Excel</button>
              
            </a>

          </div>
  
        </div>

        <div class="box-body">

          <div class="col-lg-12">
            
            <?php 

              include "reports/sells-charter.php";

             ?>

          </div>

          <div class="col-md-6 col-xs-12">
            
            <?php 

             include "reports/most-sold-products.php";

            ?>

          </div>

           <div class="col-md-6 col-xs-12">
            
            <?php 

             include "reports/sellers.php";

            ?>

          </div>

           <div class="col-md-6 col-xs-12">
            
            <?php 

             include "reports/buyers.php";

            ?>

          </div>

        </div>

      </div>

    </section>

  </div>
