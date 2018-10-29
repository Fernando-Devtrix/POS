
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>

        Administrar Usuarios

      </h1>

      <ol class="breadcrumb">

        <li><a href="main"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Usuarios</li>

      </ol>

    </section>

    <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">
            
            Agregar Usuario

          </button>

        </div>

        <div class="box-body">

         <table class="table table-bordered table-striped dt-responsive tables">
           
           <thead>
             
            <tr>
              
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Última conexión</th>
              <th>Acciones</th>

            </tr>

           </thead>

           <tbody>
             
            <tr>
              <td>1</td>
              <td>Usuario Admninistrador</td>
              <td>admin</td>
              <td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px" alt="Profile Image"></td>
              <td>Admninistrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2018-24-10 09:33:33</td>
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
      =     Modal: Add User        =
      ============================-->


  <div id="modalAddUser" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar usuario</h4>

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

                  <input type="text" class="form-control input-lg" name="newName" placeholder="Ingresar nombre" required>

                </div>

              </div>

              <!--======================
              =    User Input          =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>

                  <input type="text" class="form-control input-lg" name="newUser" placeholder="Ingresar usuario" required>

                </div>

              </div>
              
             <!--======================
              =    User Input          =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                  <input type="password" class="form-control input-lg" name="newPassword" placeholder="Ingresar contraseña" required>

                </div>

              </div>

              <!--======================
              =    User Input          =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select name="newProfile" class="form-control input-lg">
                    
                    <option value="">Selecciona perfil</option>
                    
                    <option value="Manager">Administrador</option>

                    <option value="Personalized">Especial</option>

                    <option value="Seller">Vendedor</option>

                  </select>

                </div>

              </div>

              <!--======================
              =    Photo Input         =
              =======================-->
              <div class="form-group">
                
                <div class="panel">SUBIR FOTO</div>

                <input type="file" id="newPhoto" name="newPhoto">

                <p class="help-block">Peso máximo de la foto: 200 MB</p>

                <img src="views/img/users/default/anonymous.png" alt="Photo" class="img-thumbnail" width="100px">

              </div>

            </div>

          </div>

          <!--===========================
          =     Modal's footer          =
          ============================-->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar usuario</button>

          </div>

        </form>

      </div>

    </div>

  </div>




