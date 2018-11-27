
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

              <form role="form" method="post">

                <div class="box-body">
                
                  <div class="box">

                   <!--=====================================
                    =         SELLER INPUT                 =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="newSeller" name="newSeller" value="Usuario Administrador" readonly>

                      </div>

                    </div>

                   <!--=====================================
                    =         PURCHASE INPUT               =
                    ======================================-->  

                    <div class="form-group">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="text" class="form-control" id="newPurchase" name="newPurchase" value="1234" readonly>

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

                        </select>

                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddClient" data-dismiss="modal">Agregar Cliente</button></span>

                      </div>

                    </div>

                    <!--=====================================
                    =        ADD PRODUCT INPUT              =
                    ======================================-->  
                    
                    <div class="form-group row newProduct">

                      <!-- Producto Description -->

                      <div class="col-xs-6" style="padding-right: 0px">
                        
                        <div class="input-group">
                          
                          <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                          <input type="text" class="form-control" id="addProduct" name="addProduct" placeholder="Descripción del producto" required>

                        </div>

                      </div>

                      <!-- Producto Quantity -->

                      <div class="col-xs-3">
                        
                        <input type="text" class="form-control" id="newProductQuantity" min="1" placeholder="0" required>

                      </div>

                      <!-- Product Price -->

                      <div class="col-xs-3" style="padding-left: 0px">

                        <div class="input-group">
                          
                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                          <input type="number" min="1" class="form-control" id="newProductPrice" placeholder="000000" readonly required>
                          
                        </div>
                      
                      </div>
                      
                    </div>

                    <!--=====================================
                    =        ADD PRODUCT BUTTON             =
                    ======================================-->  

                    <button type="button" class="btn btn-default hidden-lg">Agregar Producto</button>

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
                                  
                                  <input type="number" class="form-control" min="0" id="newTaxSell" name="newTaxSell" placeholder="0" required>
                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>
                                
                              </td>  

                              <td style="width: 50%">
                                
                                <div class="input-group">

                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                  
                                  <input type="numer" min="1" class="form-control" id="newTotalSell" name="newTotalSell" placeholder="00000" readonly required>

                                </div>

                              </td>                            

                            </tr>

                          </tbody>

                        </table>

                      </div>

                    </div>

                    <hr>
    
                    <!--=====================================
                    =        PAYMENT METHO INPUT            =
                    ======================================--> 

                    <div class="form-group row">
                      
                      <div class="col-xs-6" style="padding-right: 0px">
                        
                        <div class="input-group">
                          
                          <select class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>
                            <option value="">Seleccione método de pago</option>
                            <option value="cash">Efectivo</option>
                            <option value="creditCard">Tarjeta de Crédito</option>
                            <option value="debitCard">Tarjeta de Debito</option>
                          </select>
                          
                        </div>
                        
                      </div>

                        <div class="col-xs-6" style="padding-left: 0px">
                        
                        <div class="input-group">

                          <input type="text" class="form-control" id="newTransactionCode" name="newTransactionCode" placeholder="Código de transaction" required>

                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                 
                        </div>
                        
                      </div>

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
                
                <table class="table table-bordered table-striped dt-responsive tables">
                  
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

                  <tbody>
                    
                    <tr>
                      <td>1</td>
                      <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px" alt="photo"></td>
                      <td>0123</td>
                      <td>Lorem ipsum dolor sit Voluptates.</td>
                      <td>20</td>
                      <td>                        
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary">Agregar</button>
                        </div>
                      </td>

                    </tr>

                  </tbody>

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