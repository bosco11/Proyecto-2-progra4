<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
	<div id="panel_app">
		<div id="user_box">
			<a href="<?php echo site_url('user/edit/' . $this->session->userdata['logged_in']['users_id']); ?>" title="Editar Perfil">
				<?php
				echo "<img src='" . site_url('/resources/photos/' . $this->session->userdata['logged_in']['imagen'])
					. "' alt='photo_profile'  width=50 id='photo_profile' />"
					. $this->session->userdata['logged_in']['nombre_real'] . ". ✎</span>";
				?>
			</a>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?php echo site_url('comprador/index'); ?>"></h5>MarketPlace</h5></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="<?php echo site_url('comprador/index'); ?>">Inicio</a>
						</li>
					</ul>
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
					<div id="logout">
						<?php echo form_open('auth/logout'); ?>
						<button type="submit" name="btn_logout" id="btn_logout" class="btn btn-danger" title="Salir">Salir</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</nav>

		<div class="box-header">
			<h3 align="center">PROODUCTOS</h3>
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
							<td>Ubcacion del producto</td>
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
								<td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar">Eliminar</button> </td>
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