
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

                   <!--=====================================
                    =         SELLER INPUT                 =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="newSeller" name="newSeller" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                        <input type="hidden" name="idSeller"  value="<?php echo $_SESSION["id"]; ?>">

                      </div>

                    </div>

                   <!--=====================================
                    =         PURCHASE INPUT               =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <?php 

                          $item = null;
                          $value = null;

                          $sells = SellsController::ctrlShowSells($item, $value);

                          if (!$sells) {
                            
                             echo '<input type="text" class="form-control" id="newPurchase" name="newPurchase" value="1001" readonly>';
                          }else{

                            foreach ($sells as $key => $value) {
                              


                            }

                            $code = $value["codigo"] + 1;

                              echo '<input type="text" class="form-control" id="newPurchase" name="newPurchase" value="'.$codigo.'" readonly>';
                          }
                        ?>

                      </div>

                    </div>

                    <!--=====================================
                    =           CLIENT INPUT               =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                        <select type="text" class="form-control" id="addClient" name="addClient" placeholder="Agregar Cliente" required>

                        <option value="">Seleccionar cliente</option>

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

                     
                      
                    </div>

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
                                  
                                  <input type="number" class="form-control input-lg" min="0" id="newTaxSell" name="newTaxSell" placeholder="0" required>

                                  <input type="hidden" name="newTaxPrice" id="newTaxPrice" required>

                                  <input type="hidden" name="newTaxNet" id="newTaxNet" required>

                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>
                                
                              </td>  

                              <td style="width: 50%">
                                
                                <div class="input-group">

                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                  
                                  <input type="text" class="form-control input-lg" id="newTotalSell" name="newTotalSell" placeholder="00000" total="" readonly required>

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

                       <!--  <div class="col-xs-6" style="padding-left: 0px">
                        
                        <div class="input-group">

                          <input type="text" class="form-control" id="newTransactionCode" name="newTransactionCode" placeholder="Código de transaction" required>

                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                 
                        </div>
                        
                      </div> -->

                      <div class="paymentMethodBoxes"></div>

                    </div>  

                    <br>            

                  </div>

              </div>               

              <div class="box-footer">  

                <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

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