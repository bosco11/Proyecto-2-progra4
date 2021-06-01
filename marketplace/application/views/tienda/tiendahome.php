<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
	<div id="panel_app">
		<div id="user_box">
			<?php
			echo "<img src='" . site_url('/resources/photos/' . $this->session->userdata['logged_in']['imagen'])
				. "' alt='photo_profile'  width=50 id='photo_profile' />"
				. $this->session->userdata['logged_in']['nombre_real'] . ".</span>";
			?>

			<div id="logout">
				<?php echo form_open('auth/logout'); ?>
				<button type="submit" name="btn_logout" id="btn_logout" class="btn btn-danger" title="Salir">X</button>
				<?php echo form_close(); ?>
			</div>
		</div>

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
							<?php echo form_open('tienda/mantPro/'.$pro['id_productos']); ?>
							<tr align="center">
								<td><?php echo $pro['descripcion'] ?></td>
								<td><?php echo $pro['cantidad'] ?></td>
								<td><?php echo $pro['costo_envio'] ?></td>
								<td><?php echo $pro['precio'] ?></td>
								<td><?php echo $pro['fecha_publicacion'] ?></td>
								<td><?php echo $pro['categorias'] ?></td>
								<td><?php echo $pro['tiempo_promedio'] ?></td>
								<td><?php echo $pro['ubicacion_fisica'] ?></td>
								<td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar" >Eliminar</button> </td>
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