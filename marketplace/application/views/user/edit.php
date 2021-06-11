<?php if (!empty($this->session)) {
	if ($this->session->flashdata('error')) {
		echo "<div class='msg_box_user error' >" .  $this->session->flashdata('error') . "</div>";
	}
	if ($this->session->flashdata('success')) {
		echo "<div class='msg_box_user success' >" .  $this->session->flashdata('success') . "</div>";
	}
} ?>

<?php if ($this->session->userdata['logged_in']['users_id'] == $user['id_usuarios'] && $this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

	<div id="panel_app">
		<div class="box-header">
			<h2 class="box-title">Editando Usuario</h2>
			<?php
			if ($this->session->userdata['logged_in']['tipo'] == 'Tienda') { ?>
				<?php echo form_open('tienda/tiendaHome'); ?>
				<button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
				<?php echo form_close(); ?>
			<?php  } else { ?>
				<?php echo form_open('comprador/compradorHome'); ?>
				<button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
				<?php echo form_close(); ?>
			<?php } ?>

		</div>
		<?php echo form_open('user/edit/' . $user['id_usuarios']); ?>
		<div id="edit_panel">

			<div id="div1">
				<label for="txt_usuario" class="control-label"><span class="text-danger">* </span>Usuario:</label>
				<div class="form-group">
					<input type="text" name="txt_usuario" value="<?php echo ($this->input->post('txt_usuario') ? $this->input->post('txt_usuario') : $user['user']); ?>" class="cajatexto" id="txt_usuario" />
					<span class="text-danger"><?php echo form_error('txt_usuario'); ?></span>
				</div>
				<label for="txt_clave" class="control-label"><span class="text-danger">* </span>Contraseña:</label>
				<div class="form-group">
					<input type="password" name="txt_clave" value="<?php echo $this->input->post('txt_clave'); ?>" class="cajatexto" id="txt_clave" />
					<span class="text-danger"><?php echo form_error('txt_clave'); ?></span>
				</div>
				<label for="txt_nombre" class="control-label"><span class="text-danger">* </span>Nombre Real:</label>
				<div class="form-group">
					<input type="text" name="txt_nombre" value="<?php echo ($this->input->post('txt_nombre') ? $this->input->post('txt_nombre') : $user['nombre_real']); ?>" class="cajatexto" id="txt_nombre" />
					<span class="text-danger"><?php echo form_error('txt_nombre'); ?></span>
				</div>
				<label for="txt_cedula" class="control-label"><span class="text-danger">* </span>Cedula:</label>
				<div class="form-group">
					<input type="text" name="txt_cedula" value="<?php echo ($this->input->post('txt_cedula') ? $this->input->post('txt_cedula') : $user['cedula']); ?>" class="cajatexto" id="txt_cedula" />
					<span class="text-danger"><?php echo form_error('txt_cedula'); ?></span>
				</div>

			</div>

			<div id="div2">
				<label for="txt_telefono" class="control-label"><span class="text-danger">* </span>Telefono:</label>
				<div class="form-group">
					<input type="number" name="txt_telefono" value="<?php echo ($this->input->post('txt_telefono') ? $this->input->post('txt_telefono') : $user['telefono']); ?>" class="cajatexto" id="txt_telefono" />
					<span class="text-danger"><?php echo form_error('txt_telefono'); ?></span>
				</div>
				<label for="txt_correo" class="control-label"><span class="text-danger">* </span>Correo:</label>
				<div class="form-group">
					<input type="email" name="txt_correo" value="<?php echo ($this->input->post('txt_correo') ? $this->input->post('txt_correo') : $user['correo']); ?>" class="cajatexto" id="txt_correo" />
					<span class="text-danger"><?php echo form_error('txt_correo'); ?></span>
				</div>
				<label for="cmb_tipo" class="control-label"><span class="text-danger">* </span>Tipo usuario:</label>
				<div class="form-group">
					<select name="cmb_tipo" id="cmb_tipo" variant="primary" <?php echo ($this->input->post('cmb_tipo') ? $this->input->post('cmb_tipo') : $user['tipo_usuario']); ?> class="form-select form-select-sm" aria-label=".form-select-sm example" class="d-flex form-control form-control-sm">
						<?php if ($user['tipo_usuario'] == 'Comprador') { ?>
							<option value="Comprador" selected> Comprador</option>
							<option value="Tienda">Tienda</option>
						<?php } else { ?>
							<option value="Comprador"> Comprador</option>
							<option value="Tienda" selected>Tienda</option>
						<?php } ?>
					</select>
				</div>
				<label for="txt_pais" class="control-label"><span class="text-danger">* </span>Pais:</label>
				<div class="form-group">
					<input type="text" name="txt_pais" value="<?php echo ($this->input->post('txt_pais') ? $this->input->post('txt_pais') : $user['pais']); ?>" class="cajatexto" id="txt_pais" />
					<span class="text-danger"><?php echo form_error('txt_pais'); ?></span>
				</div>
				<label for="txt_direccion" class="control-label"><span class="text-danger">* </span>Direccion:</label>
				<div class="form-group">
					<input type="text" name="txt_direccion" value="<?php echo ($this->input->post('txt_direccion') ? $this->input->post('txt_direccion') : $user['direccion']); ?>" class="cajatexto" id="txt_direccion" />
					<span class="text-danger"><?php echo form_error('txt_direccion'); ?></span>
				</div>
			</div>

			<br><br><br><br>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
			<!-- <div id="actions">
				<a href="<?php echo site_url('user/delete/' . $user['id_usuarios']); ?>" id="btn_eliminar" name="btn_eliminar" title="Eliminar" onclick="send()">🗙 Eliminar mi cuenta</a>
			</div>
			<br><br><br><br> -->
			<?php echo form_close(); ?>

			<?php echo form_open('user/social'); ?>
			<div id="bt_social2">
				<button id="bt_social" type="submit" class="btn btn-primary">Redes sociales,direcciones,metodo pagos</button>
			</div>
			<?php echo form_close(); ?>

			<div class="box-body">
				<div class="form-group-photo">
					<?php echo "<img src='" . site_url('/resources/photos/' . $user['imagen'])
						. "' alt='Editar Foto' title='Editar Foto'  width=70 height=70 id='photo_profile' />"; ?>

					<?php echo form_open_multipart('user/upload_photo/' . $user['id_usuarios']); ?>
					<input type="file" name="txt_file" size="20" class="btn btn-info" accept="image/jpeg,image/gif,image/png" />
					<br><br>
					<button type="submit" class="boton">Cargar Foto</button>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

<?php
} else {
	header("location: " . base_url());
}
?>