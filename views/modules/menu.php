<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">

			<?php 

				if($_SESSION["perfil"] == "Administrador"){

					echo '

					<li class="active">
						<a href="main">
							<i class="fa fa-home"></i>
								<span>Inicio</span>
						</a>
					</li>

					<li>
						<a href="users">
							<i class="fa fa-user"></i>
								<span>Usuarios</span>
						</a>
					</li>';

				}

			
				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

					echo '

						<li>
							<a href="categories">
								<i class="fa fa-th"></i>
									<span>Categorias</span>
							</a>
						</li>

						<li>
							<a href="products">
								<i class="fa fa-product-hunt"></i>
									<span>Productos</span>
							</a>
						</li>

					';

				}

				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

					echo '

						<li>
							<a href="clients">
								<i class="fa fa-users"></i>
									<span>Clientes</span>
							</a>
						</li>

					';

				}

				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

					echo '
					<li class="treeview">
						<a href="#">
							<i class="fa fa-list-ul"></i>
								<span>Ventas</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
						</a>

						<ul class="treeview-menu">
							<li>
								<a href="sells">	
									<i class="fa fa-circle-o">
										<span>Administrar Ventas</span>
									</i>
								</a>
							</li>

							<li>
								<a href="create-sell">	
									<i class="fa fa-circle-o">
										<span>Crear Ventas</span>
									</i>
								</a>
							</li>			
	
					';

				

				
						if($_SESSION["perfil"] == "Administrador"){

							echo '

							<li>
								<a href="reports">	
									<i class="fa fa-circle-o">
										<span>Reporte de Ventas</span>
									</i>
								</a>
							</li>

							';
						}




						echo '</ul>

					</li>';
				}

			?>

		</ul>

	</section>

</aside>