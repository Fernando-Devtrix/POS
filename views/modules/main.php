
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

          include "main/upper-boxes.php"

        ?>

      </div>

      <div class="row">
        

        <div class="col-lg-12">

          <?php 

            include "reports/sells-charter.php";

          ?>
          
        </div>

        <div class="col-lg-6">

          <?php 

            include "reports/most-sold-products.php";

          ?>
          
        </div>

        <div class="col-lg-6">

          <?php 

            include "main/recently-products.php";

          ?>
          
        </div>

      </div>

    </section>

  </div>
