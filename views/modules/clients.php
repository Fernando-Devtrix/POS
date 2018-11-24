
  <div class="content-wrapper">

    <section class="content-header">
     
      <h1>

        Administrar clientes

      </h1>

      <ol class="breadcrumb">

        <li><a href="main"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar clientes</li>

      </ol>

    </section>

    <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddClient">
            
            Agregar cliente

          </button>

        </div>

        <div class="box-body">

         <table class="table table-bordered table-striped dt-responsive tables">
           
           <thead>
             
            <tr>
              
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Documento ID</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Fecha nacimiento</th>
              <th>Total compras</th>
              <th>Última compra</th>
              <th>Ingreso al sistema</th>
              <th>Acciones</th>

            </tr>

           </thead>

           <tbody>

            <?php 

              $item = null;

              $value = null;

              $clients = ClientsController::ctrlShowClients($item, $value);

              foreach ($clients as $key => $value) {
                
                  echo '<tr>

                            <td>'.($key+1).'</td>

                            <td>'.$value["nombre"].'</td>

                            <td>'.$value["documento"].'</td>

                            <td>'.$value["email"].'</td>

                            <td>'.$value["telefono"].'</td>

                            <td>'.$value["direccion"].'</td>

                            <td>'.$value["fecha_nacimiento"].'</td>

                            <td>'.$value["compras"].'</td>
                            
                            <td>0000-00-00 00:00:00</td>

                            <td>'.$value["fecha"].'</td>

                            <td>
                              
                              <div class="btn-group">
                                
                                <button class="btn btn-warning btnEditClient" data-toggle="modal" data-target="#modalEditClient" idClient="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                                
                                <button class="btn btn-danger btnDeleteClient" idClient="'.$value["id"].'"><i class="fa fa-times"></i></button>

                              </div>

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

      <!--===========================
      =     Modal: Edit Client      =
      ============================-->

  <div id="modalEditClient" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar cliente</h4>

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

                  <input type="text" class="form-control input-lg" name="editClient" id="editClient" required>
                  <input type="hidden" id="idClient" name="idClient">

                </div>

              </div>

             <!--======================
              =    Input file ID       =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>

                  <input type="text" class="form-control input-lg" name="editFileId" id="editFileId" required>

                </div>

              </div>

              <!--======================
              =         Email         =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                  <input type="email" class="form-control input-lg" name="editEmail" id="editEmail" required>

                </div>

              </div>

              <!--======================
              =    Phone Input         =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" name="editPhone" id="editPhone" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                </div>

              </div>

              <!--======================
              =    Address Input         =
              =======================-->          
              
              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                  <input type="text" class="form-control input-lg" name="editAddress" id="editAddress" required>

                </div>

              </div>

              <!--======================
              =    BornDate Input       =
              =======================-->          
              
              <div class="form-group"> 
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  <input type="text" class="form-control input-lg" name="editBornDate" id="editBornDate" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

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

        </form>

         <?php 

          $editClient = new ClientsController();
          $editClient -> ctrlEditClient();

         ?>
 
      </div>

    </div>

  </div>


  <?php 

      $deleteClient = new ClientsController();
      $deleteClient -> ctrlDeleteClient();

  ?>


          <!--===========================
          =     Feat brach              =
          ============================-->

