<?php   

  if ($_SESSION["perfil"] == "Vendedor") {

    echo '
      <script>
      
        window.location = "main";

      </script>
  
    ';

  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>

        Administrar categorías

      </h1>

      <ol class="breadcrumb">

        <li><a href="main"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar categorías</li>

      </ol>

    </section>

    <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategory">
            
            Agregar categoría

          </button>

        </div>

        <div class="box-body">

         <table class="table table-bordered table-striped dt-responsive tables">
           
           <thead>
             
            <tr>
              
              <th style="width:10px">#</th>
              <th>Categorías</th>
              <th>Acciones</th>

            </tr>

           </thead>

           <tbody>
          
          <?php

            $item = null;
            $value = null;

            $categories = CategoriesController::ctrlShowCategories($item, $value);

            foreach ($categories as $key => $value) {
              
                           
               echo '<tr>

                        <td>'.($key+1).'</td>

                        <td>'.$value["categoria"].'</td>

                        <td>
                          
                          <div class="btn-group">
                            
                            <button class="btn btn-warning btnEditCategory" idCategory="'.$value["id"].'" data-toggle="modal" data-target="#modalEditCategory"><i class="fa fa-pencil"></i></button>';

                            if($_SESSION["perfil"] == "Administrador") {

                              echo '<button class="btn btn-danger btnDeleteCategory" idCategory="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                         
                            }
                            
                     echo '</div>

                        </td>

                     </tr>';
            }

           ?>

           </tbody>

         </table>

        </div>

      </div>

    </section>

  </div>

  <!--===========================
  =     Modal: Add Category     =
  ============================-->


  <div id="modalAddCategory" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar categoría</h4>

          </div>
         <!--===========================
          =     Modal's body           =
          ============================-->

          <div class="modal-body">

            <div class="box-body">

              <!--======================
              =    Name Input          =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <input type="text" class="form-control input-lg" name="newCategory" placeholder="Ingresar categoría" required>

                </div>

              </div>

            </div>

          </div>

          <!--===========================
          =     Modal's footer          =
          ============================-->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar categoría</button>

          </div>

          <?php 

            $createCategory = new CategoriesController();
            $createCategory -> ctrlCreateCategory();

           ?>

        </form>

      </div>

    </div>

  </div>

   <!--===========================
   =     Modal: Edit Category    =
   ============================-->


  <div id="modalEditCategory" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar categoría</h4>

          </div>
         <!--===========================
          =     Modal's body           =
          ============================-->

          <div class="modal-body">

            <div class="box-body">

              <!--======================
              =    Name Input          =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <input type="text" class="form-control input-lg" name="editCategory" id="editCategory" required>

                  <input type="hidden" name="idCategory" id="idCategory" required>

                </div>

              </div>

            </div>

          </div>

          <!--===========================
          =     Modal's footer          =
          ============================-->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>

          </div>

          <?php 

            $editCategory = new CategoriesController();
            $editCategory -> ctrlEditCategory();

           ?>

        </form>

      </div>

    </div>

  </div>

<?php 

  $deleteCategory = new CategoriesController();
  $deleteCategory -> ctrlDeleteCategory();

 ?>

  


