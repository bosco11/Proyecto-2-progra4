<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
	<div id="panel_app">
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark white scrolling-navbar" style="background-color: black;">
			<div class="container">

				<!-- Brand -->
				<a class="navbar-brand waves-effect" href="#">
					<strong class="blue-text">MarketPlace</strong>
				</a>

				<!-- Collapse -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Links -->
				<div class="collapse navbar-collapse" id="navbarSupportedContent">

					<!-- Left -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/mantCategoria')?>">Categorias
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/perfiltienda/' . $this->session->userdata['logged_in']['users_id']); ?>">Perfil tienda
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/ventas/' . $this->session->userdata['logged_in']['users_id']); ?>">Reporte tienda
							</a>
						</li>
					</ul>

					<!-- Right -->
					<ul class="navbar-nav nav-flex-icons ml_auto">
						<li class="nav-item dropdown notifications-nav ">
							<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink151" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<span class="badge badge-pill bg-danger"><?php echo count($notificaciones) ?> </span>
								<span><i class="fas fa-bell" style="font-size: 27px; margin-top: 5px;"></i></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink151">
								<?php foreach ($notificaciones as $notificacion) { ?>
									<a class="dropdown-item" href="<?php echo site_url('/tienda/ocultarNotificacion/'.$notificacion['id_notificaciones'])?>">
										<i class="far fa-bell mr-2" aria-hidden="true"></i>
										<span> <?php echo $notificacion['descripcion']?> </span>
										<span class="float-right"><i class="far fa-eye-slash" aria-hidden="true"></i></span>
									</a>
								<?php } ?>
							</div>

						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src='<?php echo site_url('/resources/photos/' . $this->session->userdata['logged_in']['imagen']) ?>' class="rounded-circle" style="height: 34px;" alt="avatar image">
							</a>
							<div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink-55">
								<a class="dropdown-item" href="<?php echo site_url('user/edit/'. $this->session->userdata['logged_in']['users_id']); ?>">Editar perfil</a>
								<a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">Salir</a>
							</div>
						</li>
					</ul>

				</div>

			</div>
		</nav>
		<br><br><br><br>
		</nav>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php echo form_open('tienda/buscarProductos/' . $this->session->userdata['logged_in']['users_id'], "class=\"d-flex\"") ?>
					<select name="cmb_categoria" id="cmb_categoria" variant="primary" aria-label=".form-select-sm example" class="form-select form-select-sm me-2">
						<option selected>Seleccionar categoría</option>
						<?php foreach ($categorias as $cate) { ?>
							<option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
						<?php } ?>
					</select>

					<input class="form-control form-sm me-2" type="search" id="txt_buscar" name="txt_buscar" placeholder="Descripcion" aria-label="Descripcion">
					<button class="btn  btn-outline-secondary  me-2" type="submit">Buscar</button>
					<?php echo form_close(); ?>
					<?php echo form_open('tienda/addProducto'); ?>
					<button type="submit" name="btn_add" id="btn_add" class="btn btn-primary me-2" title="AddProducto">Agregar Producto</button>
					<?php echo form_close(); ?>
					<?php echo form_open('tienda/viewSuscriptores/'. $this->session->userdata['logged_in']['users_id']); ?>
					<button type="submit" name="btn_add" id="btn_add" class="btn btn-secondary me-2" title="AddProducto">Ver Suscriptores</button>
					<?php echo form_close(); ?>
				</div>
			</div>
		</nav>

		<div class="box-header">
			<h3 align="center">PRODUCTOS</h3>
			<div id="tableview">
				<table class="table table-striped table-dark" id="table">
					<thead>
						<tr align="center">
							<td>Descripcion </td>
							<td>Cantidad</td>
							<td>Costo envio</td>
							<td>Precio</td>
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
								<td> <button type="submit" name="btn_perfil" id="btn_perfil" class="btn btn-secondary btn-sm me-2" title="Perfil">Perfil</button>  <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar">Eliminar</button> </td>
							</tr>
							<?php echo form_close(); ?>
						<?php } ?>

					</tbody>
				</table>

			</div>
		</div>
	</div>
<?php
} else {
	header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>