
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>

        Administrar productos

      </h1>

      <ol class="breadcrumb">

        <li><a href="main"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar productos</li>

      </ol>

    </section>

    <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddProduct">
            
            Agregar producto

          </button>

        </div>

        <div class="box-body">

         <table class="table table-bordered table-striped dt-responsive productsTable">
           
           <thead>

            <tr>
              
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Agregado</th>
              <th>Acciones</th>

            </tr>

           </thead>

         </table>

        </div>

      </div>

    </section>

  </div>

      <!--===========================
      =     Modal: Add Product        =
      ============================-->


  <div id="modalAddProduct" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar producto</h4>

          </div>
         <!--===========================
          =     Modal's body           =
          ============================-->

          <div class="modal-body">

            <div class="box-body">

              <!--=================================
              =      Input to select category     =
              ===================================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select name="newCategory" id="newCategory" class="form-control input-lg" required>
                    
                    <option value="">Selecciona categoría</option>

                    <?php 

                      $item = null;
                      $value = null;
                      
                      $categories =  CategoriesController::ctrlShowCategories($item, $value);

                      foreach ($categories as $key => $value) {
                     
                          echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                      }

                    ?>
                    
                  </select>

                </div>

              </div>

              <!--======================
              =    Code Input          =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>

                  <input type="text" class="form-control input-lg" name="newCode" id="newCode" placeholder="Ingresar código" readonly required>

                </div>

              </div>

              <!--======================
              =    Description Input   =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                  <input type="text" class="form-control input-lg" name="newDescription" placeholder="Ingresar descripción" required>

                </div>

              </div>
               
              <!--======================
              =    Stock  Input        =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>

                  <input type="number" class="form-control input-lg" name="newStock" min="0" placeholder="Stock" required>

                </div>

              </div>
        
              <!--=======================
              = Price - Purchase  Input =
              =========================--> 

               <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                    <input type="number" class="form-control input-lg" id="newPricePurchase" name="newPricePurchase" min="0" step="any" placeholder="Precio de compra" required>

                  </div>

                </div>

                <!--=======================
                = Price - Sell  Input     =
                =========================--> 

                <div class="col-xs-12 col-sm-6">  
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                    <input type="number" class="form-control input-lg" id="newPriceSell" name="newPriceSell" min="0" step="any" placeholder="Precio de venta" required>

                  </div>

                  <br>

                  <!--=============================
                  =     Checkbox for percentage   =
                  ===============================-->
                
                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal percentage" checked>
                        Utilizar porcentaje
                      </label>

                    </div>

                  </div>

                  <!--===========================
                  =    Percentage input         =
                  ============================-->
                
                  <div class="col-xs-6" style="padding: 0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

               </div>

              <!--======================
              =    Photo Input         =
              =======================-->
              <div class="form-group">
                
                  <div class="panel">SUBIR IMAGEN</div>

                  <input type="file" class="newImage" name="newImage">

                  <p class="help-block">Peso máximo de la imagen: 2MB</p>

                  <img src="views/img/products/default/anonymous.png" alt="Photo" class="img-thumbnail preview" width="100px">

              </div>

            </div>

          </div>

          <!--===========================
          =     Modal's footer          =
          ============================-->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar producto</button>

          </div>

        </form>

        <?php 

          $createProduct = new ProductsController();
          $createProduct -> ctrlCreateProduct();

        ?>

      </div>

    </div>

  </div>

  <!--===========================
  =     Modal: Edit Product     =
  ============================-->

  <div id="modalEditProduct" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar producto</h4>

          </div>
         <!--===========================
          =     Modal's body           =
          ============================-->

          <div class="modal-body">

            <div class="box-body">

              <!--=================================
              =      Input to select category     =
              ===================================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select name="editCategory" class="form-control input-lg" readonly required>
                    
                    <option id="editCategory">Selecciona categoría</option>
                    
                  </select>

                </div>

              </div>

              <!--======================
              =    Code Input          =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>

                  <input type="text" class="form-control input-lg" name="editCode" id="editCode" readonly required>

                </div>

              </div>

              <!--======================
              =    Description Input   =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                  <input type="text" class="form-control input-lg" name="editDescription" id="editDescription" required>

                </div>

              </div>
               
              <!--======================
              =    Stock  Input        =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>

                  <input type="number" class="form-control input-lg" name="editStock" id="editStock" min="0" required>

                </div>

              </div>
        
              <!--=======================
              = Price - Purchase  Input =
              =========================--> 

               <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                    <input type="number" class="form-control input-lg" id="editPricePurchase" name="editPricePurchase" min="0" step="any" required>

                  </div>

                </div>

                <!--=======================
                = Price - Sell  Input     =
                =========================--> 

                <div class="col-xs-12 col-sm-6">  
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                    <input type="number" class="form-control input-lg" id="editPriceSell" name="editPriceSell" min="0" step="any" readonly required>

                  </div>

                  <br>

                  <!--=============================
                  =     Checkbox for percentage   =
                  ===============================-->
                
                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal percentage" checked>
                        Utilizar porcentaje
                      </label>

                    </div>

                  </div>

                  <!--===========================
                  =    Percentage input         =
                  ============================-->
                
                  <div class="col-xs-6" style="padding: 0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

               </div>

              <!--======================
              =    Photo Input         =
              =======================-->
              <div class="form-group">
                
                  <div class="panel">SUBIR IMAGEN</div>

                  <input type="file" class="newImage" name="editImage">

                  <p class="help-block">Peso máximo de la imagen: 2MB</p>

                  <img src="views/img/products/default/anonymous.png" alt="Photo" class="img-thumbnail preview" width="100px">

                  <input type="hidden" name="currentImage" id="currentImage"></input>

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

        </form>

        <?php 

          $editProduct = new ProductsController();
          $editProduct -> ctrlEditProduct();

        ?>

      </div>

    </div>

  </div>

<?php 

$deleteProduct = new ProductsController();
$deleteProduct -> ctrlDeleteProduct();

?>





