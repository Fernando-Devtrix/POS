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

  <!--=====================================
  =                  Body                 =
  ======================================-->  
 
</head>

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
          $_GET["route"] == "reports") {
      
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
</body>
</html>
