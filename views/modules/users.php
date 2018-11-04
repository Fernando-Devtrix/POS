
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

            <?php 

              $item = null;
              $value = null;

              $users = UserController::ctrlShowUser($item, $value);

              foreach ($users as $key => $value) {

                echo '<tr>
                        <td>1</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["usuario"].'</td>';

                        if ($value["foto"] != "") {
                          
                         echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px" alt="Profile Image"></td>';

                        }else{

                          echo '<td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px" alt="Profile Anonymous Image"></td>';
                        
                        }


                 echo '<td>'.$value["perfil"].'</td>
                        <td><button class="btn btn-success btn-xs">Activado</button></td>
                        <td>'.$value["ultimo_login"].'</td>
                        <td>
                          
                          <div class="btn-group">
                            
                            <button class="btn btn-warning btnUserEdit" userID="'.$value["id"].'" data-toggle="modal" data-target="#modalUserEdit"><i class="fa fa-pencil"></i></button>
                            
                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>

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
              =    Password Input          =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                  <input type="password" class="form-control input-lg" name="newPassword" placeholder="Ingresar contraseña" required>

                </div>

              </div>

              <!--======================
              =    Profile Input          =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" name="newProfile">
                    
                    <option value="">Selecciona perfil</option>
                    
                    <option value="Administrador">Administrador</option>

                    <option value="Especial">Especial</option>

                    <option value="Vendedor">Vendedor</option>

                  </select>

                </div>

              </div>

              <!--======================
              =    Photo Input         =
              =======================-->
              <div class="form-group">
                
                <div class="panel">SUBIR FOTO</div>

                <input type="file" class="newPhoto" name="newPhoto">

                <p class="help-block">Peso máximo de la foto: 2 MB</p>

                <img src="views/img/users/default/anonymous.png" alt="Anonymous Photo" class="img-thumbnail" width="100px">

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

          <?php 

            $createUsers = new UserController();
            $createUsers -> ctrlCreateUser();

          ?>

        </form>

      </div>

    </div>

  </div>

 <!--===========================
   =     Modal: Edit User       =
  ============================-->


  <div id="modalUserEdit" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">
          
          <!--===========================
          =     Modal's head            =
          ============================-->

          <div class="modal-header" style="background:#3c8dbc; color:white;">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar usuario</h4>

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

                  <input type="text" class="form-control input-lg" id="editName" name="editName" value="" required>

                </div>

              </div>

              <!--======================
              =    User Input          =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>

                  <input type="text" class="form-control input-lg" id="editUser" name="editUser" value="" readonly>

                </div>

              </div>
              
             <!--======================
              =    Password Input      =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                  <input type="password" class="form-control input-lg" name="editPassword" placeholder="Escriba la nueva contraseña">

                 <input type="hidden" id="currentPassword" name="currentPassword">

               </div>

              </div>

              <!--======================
              =    Profile        =
              =======================--> 

              <div class="form-group">
                
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select name="editProfile" class="form-control input-lg">
                    
                    <option value="" id="editProfile"></option>
                    
                    <option value="Administrador">Administrador</option>

                    <option value="Especial">Especial</option>

                    <option value="Vendedor">Vendedor</option>

                  </select>

                </div>

              </div>

              <!--======================
              =    Photo Input         =
              =======================-->
              <div class="form-group">
                
                <div class="panel">SUBIR FOTO</div>

                <input type="file" class="newPhoto" name="editPhoto">

                <p class="help-block">Peso máximo de la foto: 2 MB</p>

                <img src="views/img/users/default/anonymous.png" class="img-thumbnail previous" width="100px">

                <input type="hidden" name="currentPhoto" id="currentPhoto">

              </div>

            </div>

          </div>

          <!--===========================
          =     Modal's footer          =
          ============================-->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Modificar usuario</button>

          </div>

          <?php 
          
            $editUser = new UserController();
            $editUser -> ctrlEditUser();
          
           ?>

        </form>

      </div>

    </div>

  </div>




