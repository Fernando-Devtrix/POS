<?php 

  session_start();

 ?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Change icon -->
  <link rel="icon" href="views/img/template/icono-negro.png">

  <!--=====================================
  =            Plugins CSS                =
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="views/plugins/iCheck/all.css">


  <!--=====================================
  =            Plugins JS            =
  ======================================-->
 
  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 
  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
 
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2-->
  <script src="views/plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="views/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>

</head>

  <!--=====================================
  =                  Body                 =
  ======================================-->  
 
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">


  <?php

  if (isset($_SESSION['isLogIn']) && $_SESSION["isLogIn"] == "ok") {
  

    echo '<div class="wrapper">';

    /*============================
    =            Menu            =
    ============================*/

    include "modules/header.php";

     /*============================
    =            Menu            =
    ============================*/

    include "modules/menu.php";

      /*============================
    =        Starting Page       =
    ============================*/

    if (isset($_GET["route"])) {
      
      if ($_GET["route"] == "main" ||
          $_GET["route"] == "users" ||
          $_GET["route"] == "categories" ||
          $_GET["route"] == "products" ||
          $_GET["route"] == "clients" ||
          $_GET["route"] == "sells" ||
          $_GET["route"] == "create-sell" ||
          $_GET["route"] == "reports" ||
          $_GET["route"] == "exit") {
      
        include "modules/".$_GET["route"].".php";
        
      }else{

        include "modules/404.php";

      }
    }else{

        include "modules/main.php";

    }


    /*============================
    =            Footer         =
    ============================*/

    include "modules/footer.php";

    echo '</div>';

   }else{

    include "modules/login.php";

   }

  ?>
  
</div>
<!-- ./wrapper -->
<script src="views/js/template.js"></script>
<script src="views/js/users.js"></script>
<script src="views/js/categories.js"></script>
<script src="views/js/products.js"></script>
<script src="views/js/clients.js"></script>
<script src="views/js/sells.js"></script>
</body>
</html>
