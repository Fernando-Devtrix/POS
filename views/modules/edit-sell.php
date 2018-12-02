
  <div class="content-wrapper">

    <section class="content-header">
     
      <h1>

        Crear Ventas

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Crear Ventas</li>

      </ol>

    </section>

    <section class="content">

      <div class="row">

        <!--=====================================
         =                 FORM                 =
         ======================================-->              
        
        <div class="col-lg-5 col-xs-12" >
          
          <div class="box box-success">

            <div class="box-header with-border"></div>

              <form role="form" method="post" class="formSell">

                <div class="box-body">
                
                  <div class="box">

                      <?php 

                          $item = "id";
                          $value = $_GET["idSell"];

                          $sell = SellsController::ctrlShowSells($item, $value);

                          $itemUser = "id";
                          $valueUser = $sell["id_vendedor"];

                          $seller = UserController::ctrlShowUser($itemUser ,$valueUser);

                          $itemClient = "id";
                          $valueClient = $sell["id_cliente"];

                          $cliente = ClientsController::ctrlShowClients($itemClient ,$valueClient);

                          $taxPercentage = $sell["impuesto"] * 100 / $sell["neto"];

                      ?>

                   <!--=====================================
                    =         SELLER INPUT                 =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="newSeller" value="<?php echo $seller["nombre"]; ?>" readonly>

                        <input type="hidden" name="idSeller"  value="<?php echo $seller["id"]; ?>">

                      </div>

                    </div>

                   <!--=====================================
                    =         PURCHASE INPUT               =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <input type="text" class="form-control" id="editPurchase" name="editPurchase" value="<?php echo $sell["codigo"]; ?>" readonly>
                                                
                      </div>

                    </div>

                    <!--=====================================
                    =           CLIENT INPUT               =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                        <select class="form-control" id="addClient" name="addClient" required>

                        <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                         <?php 

                            $item = null;
                            $value = null;

                            $categories = ClientsController::ctrlShowClients($item, $value);

                            foreach ($categories as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                          }

                         ?>

                        </select>

                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddClient" data-dismiss="modal">Agregar Cliente</button></span>

                      </div>

                    </div>

                    <!--=====================================
                    =        ADD PRODUCT INPUT              =
                    ======================================-->  
                    
                    <div class="form-group row newProduct">

                    <?php 

                      $listProducts = json_decode($sell["productos"], true);

                      foreach ($listProducts as $key => $value) {

                        $item = "id";
                        $val = $value["id"];

                        $productAnswer = ProductsController::ctrlShowProducts($item, $val);

                        $previousStock = ($productAnswer["stock"] + $value["cantidad"]);
                        
                        echo '<div class="row" style="padding: 5px 15px">

                                <!-- Product Description -->

                                <div class="col-xs-6" style="padding-right: 0px">
                        
                                  <div class="input-group">
                          
                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitProduct" idProduct="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                                    <input type="text" class="form-control addProduct newProductDescription" idProduct="'.$value["id"].'" name="addProduct" value="'.$value["descripcion"].'" readonly required>

                                  </div>

                                </div>

                              <!-- Product Quantity -->

                              <div class="col-xs-3">
                        
                                <input type="number" class="form-control newProductQuantity" min="1" value="'.$value["cantidad"].'" stock="'.$previousStock.'" newStock="'.$value["stock"].'" required>

                             </div>

                              <!-- Product Price -->

                              <div class="col-xs-3 inputPrice" style="padding-left: 0px">

                                <div class="input-group">
                        
                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                  <input type="text" class="form-control newProductPrice" initPrice="'.$productAnswer["precio_venta"].'" name="newProductPrice" value="'.$value["precio"].'" readonly required>
                          
                                </div>
                      
                              </div>

                          </div>';
                      }

                    ?>                     
                      
                    </div>

                    <input type="hidden" id="listProducts" name="listProducts">

                    <!--=====================================
                    =        ADD PRODUCT BUTTON             =
                    ======================================-->  

                    <button type="button" class="btn btn-default hidden-lg btnAddProduct">Agregar Producto</button>

                    <hr>

                    <div class="row">

                      <!--=====================================
                       =        TOTAL AND TAXES INPUT         =
                      ======================================-->  
                      
                      <div class="col-xs-8 pull-right">
                        
                        <table class="table">
                          
                          <thead>
                            
                            <tr>
                              
                              <th>Impuesto</th>
                              <th>Total</th>

                            </tr>

                          </thead>

                          <tbody>
                            
                            <tr>

                              <td style="width: 50%">
                                
                                <div class="input-group">
                                  
                                  <input type="number" class="form-control input-lg" min="0" id="newTaxSell" name="newTaxSell" placeholder="0" value="<?php echo $taxPercentage; ?>" required>

                                  <input type="hidden" name="newTaxPrice" id="newTaxPrice" value="<?php echo $sell["impuesto"]; ?>" required>

                                  <input type="hidden" name="newTaxNet" id="newTaxNet" value="<?php echo $sell["neto"]; ?>" required>

                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>
                                
                              </td>  

                              <td style="width: 50%">
                                
                                <div class="input-group">

                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                  
                                  <input type="text" class="form-control input-lg" id="newTotalSell" name="newTotalSell" placeholder="00000" total="" value="<?php echo $sell["total"]; ?>" readonly required>

                                  <input type="hidden" name="totalSell" value="<?php echo $sell["total"]; ?>" id="totalSell">

                                </div>

                              </td>                            

                            </tr>

                          </tbody>

                        </table>

                      </div>

                    </div>

                    <hr>
    
                    <!--=====================================
                    =        PAYMENT METHOD INPUT            =
                    ======================================--> 

                    <div class="form-group row">
                      
                      <div class="col-xs-6" style="padding-right: 0px">
                        
                        <div class="input-group">
                          
                          <select class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>
                            <option value="">Seleccione método de pago</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="TC">Tarjeta de Crédito</option>
                            <option value="TD">Tarjeta de Debito</option>
                          </select>
                          
                        </div>
                        
                      </div>

                      <div class="paymentMethodBoxes"></div>

                      <input type="hidden" id="listPaymentMethod" name="listPaymentMethod">

                    </div>  

                    <br>            

                  </div>

              </div>               

              <div class="box-footer">  

                <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>

              </div>

            </form>


           </div>

         </div>
          
        <!--=====================================
         =           PRDUCTS TABLE               =
         ======================================-->  

         <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

          <div class="box box-warning">

            <div class="box-header with-border">
              
              <div class="box-body">
                
                <table class="table table-bordered table-striped dt-responsive sellsTable">
                  
                  <thead>
                    
                    <tr>
                      
                      <th style="width: 10px">#</th>
                      <th>Imagen</th>
                      <th>Código</th>
                      <th>Descripción</th>
                      <th>Stock</th>
                      <th>Acciones</th>

                    </tr>

                  </thead>                

                </table>

              </div>

            </div>

          </div>
           
         </div>  

      </div>

    </section>
  
  </div>

  <!--===========================
  =     Modal: Add Client       =
  ============================-->


  <div id="modalAddClient" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar cliente</h4>

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
                  
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control input-lg" name="newClient" placeholder="Ingresar nombre" required>

                </div>

              </div>

             <!--======================
              =    Input file ID       =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>

                  <input type="text" class="form-control input-lg" name="newFileId" placeholder="Ingresar documento" required>

                </div>

              </div>

              <!--======================
              =         Email         =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                  <input type="email" class="form-control input-lg" name="newEmail" placeholder="Ingresar correo" required>

                </div>

              </div>

              <!--======================
              =    Phone Input         =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" name="newPhone" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                </div>

              </div>

              <!--======================
              =    Address Input         =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                  <input type="text" class="form-control input-lg" name="newAddress" placeholder="Ingresar dirección" required>

                </div>

              </div>

              <!--======================
              =    BornDate Input       =
              =======================-->          
              
              <div class="form-group"> 
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  <input type="text" class="form-control input-lg" name="newBornDate" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

                </div>

              </div>

            </div>

          </div>

          <!--===========================
          =     Modal's footer          =
          ============================-->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cliente</button>

          </div>

        </form>

        <?php 

          $createClient = new ClientsController();
          $createClient -> ctrlCreateClient();

        ?>

      </div>

    </div>

  </div>