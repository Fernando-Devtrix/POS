
  <div class="content-wrapper">

    <section class="content-header">
     
      <h1>

        Tablero
        <small>Panel de control</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="main"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Tablero</li>

      </ol>

    </section>

    <section class="content">

      <div class="row">
        
        <?php 

          if($_SESSION["perfil"] == "Administrador") {

            include "main/upper-boxes.php";

          }


        ?>

      </div>

      <div class="row">
        

        <div class="col-lg-12">

          <?php 

            if($_SESSION["perfil"] == "Administrador") {

              include "reports/sells-charter.php";
  
            }


          ?>
          
        </div>

        <div class="col-lg-6">

          <?php 

            if($_SESSION["perfil"] == "Administrador") {

              include "reports/most-sold-products.php";

            }


          ?>
          
        </div>

        <div class="col-lg-6">

          <?php 

            if($_SESSION["perfil"] == "Administrador") {

             include "main/recently-products.php";

            }

          ?>
          
        </div>

        <div class="col-lg-12">

          <?php 

            if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

                echo '

                  <div class="box box-success">
                    
                    <div class="box-header">

                      <h1>Bienvenid@ '.$_SESSION["nombre"].'</h1>
                      <h6>Rold: '.$_SESSION["perfil"].'</h6>

                    </div>

                  </div>
                ';

            }

          ?>
          
        </div>

      </div>

    </section>

  </div>
