
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

         <table class="table table-bordered table-striped dt-responsive tables">
           
           <thead>
             
            <tr>
              
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de compra</th>
              <th>Agregado</th>
              <th>Acciones</th>

            </tr>

           </thead>

           <tbody>
              
            <tr>
              <td>1</td>
              <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px" alt="Profile Image"></td>
              <td>0001</td>
              <td>Lorem ipsum dolor sit amet</td>
              <td>Lorem ipsum dolor </td>
              <td>20</td>
              <td>$ 5.00</td>
              <td>$ 1.00</td>
              <td>2018-11-11 12:05:32</td>
              <td>
                
                <div class="btn-group">
                  
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>

              </td>

            </tr>

                <tr>
                <td>2</td>
                <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px" alt="Profile Image"></td>
                <td>0001</td>
                <td>Lorem ipsum dolor sit amet</td>
                <td>Lorem ipsum dolor </td>
                <td>20</td>
                <td>$ 5.00</td>
                <td>$ 1.00</td>
                <td>2018-11-11 12:05:32</td>
                <td>
                  
                  <div class="btn-group">
                    
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                  </div>

                </td>

            </tr>


           </tbody>

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


              <!--======================
              =    Code Input          =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>

                  <input type="text" class="form-control input-lg" name="newCode" placeholder="Ingresar código" required>

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
               
              <!--=================================
              =      Input to select category     =
              ===================================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select name="newCategory" class="form-control input-lg">
                    
                    <option value="">Selecciona categoría</option>
                    
                    <option value="Taladros">Taladros</option>

                    <option value="Andamios">Andamios</option>

                    <option value="Equipos para construcción">Equipos para construcción</option>

                  </select>

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

                <div class="col-xs-6">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                    <input type="number" class="form-control input-lg" name="newPricePurchase" min="0" placeholder="Precio de compra" required>

                  </div>

                </div>

                <!--=======================
                = Price - Sell  Input     =
                =========================--> 

                <div class="col-xs-6">  
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                    <input type="number" class="form-control input-lg" name="newPriceSell" min="0" placeholder="Precio de venta" required>

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

                  <input type="file" id="newImagen" name="newImagen">

                  <p class="help-block">Peso máximo de la imagen: 2MB</p>

                  <img src="views/img/products/default/anonymous.png" alt="Photo" class="img-thumbnail" width="100px">

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

      </div>

    </div>

  </div>




