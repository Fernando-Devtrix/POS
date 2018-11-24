
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
              <th>Ingreso añ sistema</th>
              <th>Acciones</th>

            </tr>

           </thead>

           <tbody>
             
            <tr>

              <td>1</td>

              <td>Enesto Antonio</td>

              <td>71651615</td>

              <td>totoneto@gmail.com</td>

              <td>77152518</td>

              <td>calle 16 de sep</td>

              <td>1997-27-07</td>

              <td>2017-27-07 12:05:23</td>
              
              <td>35</td>

              <td>2017-27-07 12:05:23</td>

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
          $createClient -> ctrlCreateUser();

        ?>

      </div>

    </div>

  </div>