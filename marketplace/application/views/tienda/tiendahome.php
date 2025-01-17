<?php
if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
	<div id="panel_app">
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark white scrolling-navbar" id="nav-comprador"  style="background-color: black;">
			<div class="container">
				<a class="navbar-brand waves-effect" href="#">
					<strong class="blue-text"><img src="<?php echo site_url('resources/img/tienda.png'); ?>" alt="Marktplace" width="50" height="50"></strong>
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto" id="ul1">
						<li class="nav-item active">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/mantCategoria') ?>">Categorias
								<!-- Se crea un boton para ir a la vista de mantenimineto de categorias -->
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/ventas/' . $this->session->userdata['logged_in']['users_id']); ?>">Reporte de ventas
								<!-- Se crea un boton para ir a la vista de reportes de ventas -->
							</a>
						</li>
					</ul>
					<ul class="navbar-nav nav-flex-icons ml_auto">
						<li title="Cantidad de denuncias" class="nav-item dropdown">
							<a class="nav-link">
								<span class="badge badge-pill bg-danger"><?php echo $tienda['denuncias']?></span>
								<span><i class="fas fa-user-slash" style="font-size: 27px; margin-top: 5px;"></i></span>
							</a>
						</li>
						<li class="nav-item dropdown notifications-nav ">
							<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink151" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<span class="badge badge-pill bg-danger"><?php echo count($notificaciones) ?> </span>
								<span><i class="fas fa-bell" style="font-size: 27px;"></i></span>
							</a>
							<div  style="overflow: auto; max-height: 400px;  padding-left: 5px;" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink151">
								<!-- Se crea un menu modal donde se muestran las notificaiones-->
								<?php foreach ($notificaciones as $notificacion) { ?>
									<a class="dropdown-item" href="<?php echo site_url('/tienda/ocultarNotificacion/' . $notificacion['id_notificaciones'] . "/" . $notificacion['id_productos']) ?>">
										<i class="far fa-bell mr-2" aria-hidden="true"></i>
										<span> <?php echo $notificacion['descripcion'] ?></span>
									</a>
									<hr>
								<?php } ?>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src='<?php echo site_url('/resources/photos/' . $this->session->userdata['logged_in']['imagen']) ?>' class="rounded-circle" style="height: 34px;" alt="avatar image">
							</a>
							<div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink-55">
								<!-- Se crea un menu modal donde se le muestran opcones de ver perfil, editar perfil y salir -->
								<a class="dropdown-item" title="Perfil" href="<?php echo site_url('tienda/perfiltienda/' . $this->session->userdata['logged_in']['users_id']); ?>"><i class="fas fa-user"></i> Ver perfil</a>
								<a class="dropdown-item" title="Editar perfil" href="<?php echo site_url('user/edit/' . $this->session->userdata['logged_in']['users_id']); ?>"><i class="fas fa-edit"></i> Editar perfil</a>
								<a href="<?php echo site_url('auth/logout'); ?>" title="Salir" class="dropdown-item"><i class="fas fa-arrow-left"></i> Salir</a>
							</div>
						</li>
					</ul>

				</div>

			</div>
		</nav>
		<br><br><br><br>
		<?php
		if (isset($logout_message)) {

			echo "<div class='alert alert-success alert-dismissible fade show' role='alert' style='font-size: 20px;'>"
				. $logout_message .
				"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		}

		if (isset($message_display)) {

			echo "<div class='alert alert-success alert-dismissible fade show' role='alert'style='font-size: 20px;'>"
				. $message_display .
				"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		}

		if (isset($error_message)) {

			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'style='font-size: 20px;'>"
				. $error_message .
				"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		}
		?>
		<nav class="navbar navbar-dark bg-dark justify-content-between">
			<div class="container-fluid">
				<?php echo form_open('tienda/buscarProductos/' . $this->session->userdata['logged_in']['users_id'], "class=\"d-flex\"") ?>
				<!-- Se crea un form para filtrar los productos por categoria o descripcion -->
				<select name="cmb_categoria" id="cmb_categoria" variant="primary" aria-label=".form-select-sm example" class="form-select form-select-sm me-2">
					<option selected>Seleccionar categoría</option>
					<?php foreach ($categorias as $cate) { ?>
						<!-- Se carga un combobox con todas las categorias -->
						<option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
					<?php } ?>
				</select>
				<input class="form-control form-sm me-2" type="search" id="txt_buscar" name="txt_buscar" placeholder="Descripcion" aria-label="Descripcion">
				<button class="btn btn-secondary me-2" title="Buscar" type="submit"><i class="fas fa-search"></i> Buscar</button>
				<?php echo form_close(); ?>

				<?php echo form_open('tienda/addProducto/1'); ?>
				<!-- Se crea un form para ir a la vista de agregar productos -->
				<button type="submit" name="btn_add" id="btn_add" class="btn btn-primary me-2" title="Agregar Producto"><i class="fas fa-plus"></i> Agregar Producto</button>
				<?php echo form_close(); ?>
				<?php echo form_open('tienda/viewSuscriptores/' . $this->session->userdata['logged_in']['users_id']); ?>
				<!-- Se crea un form para ir a la vista de ver los suscriptores -->
				<button type="submit" name="btn_add" id="btn_add" class="btn btn-secondary me-2" title="Ver Suscriptores"><i class="fas fa-list-ul"></i> Ver Suscriptores</button>
				<?php echo form_close(); ?>
			</div>
		</nav>
		<br>
		<div id="main_panel">
			<div class="box-header">
				<h3 align="center">PRODUCTOS</h3>
				<div id="tableview">
					<table class="table table-striped table-dark" id="table">
						<thead>
							<tr align="center">
								<td>Descripcion </td>
								<td>Cantidad</td>
								<td>($)Costo envio</td>
								<td>($)Precio del producto(Unidad)</td>
								<td>Fecha publicacion</td>
								<td>Categoria</td>
								<td>Tiempo de entrega</td>
								<td>Ubicacion del producto</td>
								<td>Cantidad de deseos</td>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody id="tbTable">
							<?php foreach ($productos as $pro) { ?>
								<!-- Se carga un tableview con todos los productos -->
								<?php echo form_open('tienda/mantPro/' . $pro['id_productos']); ?>
								<tr align="center">
									<td><?php echo $pro['descripcion'] ?></td>
									<td><?php echo $pro['cantidad'] ?></td>
									<td><?php echo $pro['costo_envio'] ?></td>
									<td><?php echo $pro['precio'] ?></td>
									<td><?php echo $pro['fecha_publicacion'] ?></td>
									<td><?php echo $pro['categorias'] ?></td>
									<td><?php echo $pro['tiempo_promedio'] ?></td>
									<td><?php echo $pro['ubicacion_fisica'] ?></td>
									<td><?php echo $pro['cantidadDeseos'] ?></td>
									<td><button type="submit" name="btn_perfil" id="btn_perfil" class="btn btn-secondary btn-sm" title="Perfil"><i class="fas fa-user"></i></button><button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar"><i class="fas fa-edit"></i></button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button> </td>
								</tr>
								<?php echo form_close(); ?>
							<?php } ?>

						</tbody>
					</table>

				</div>
			</div>

		</div>
	</div>
<?php
} else {
	header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>