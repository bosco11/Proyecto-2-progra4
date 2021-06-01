<div id="panel_app">
	<div class="box-header">
		<h2 class="box-title">Mantenimiento Producto</h2>
		<?php echo form_open('auth/login'); ?>
		<button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
		<?php echo form_close(); ?>
	</div>
	<?php echo form_open('user/add'); ?>
	<div id="edit_panel">
		<div id="div1">
			<label for="txt_usuario" class="control-label"><span class="text-danger">* </span>Usuario:</label>
			<div class="form-group">
				<input type="text" name="txt_usuario" value="<?php echo $this->input->post('txt_usuario'); ?>" class="cajatexto" id="txt_usuario" />
				<span class="text-danger"><?php echo form_error('txt_usuario'); ?></span>
			</div>
			<label for="txt_clave" class="control-label"><span class="text-danger">* </span>Contraseña:</label>
			<div class="form-group">
				<input type="password" name="txt_clave" value="<?php echo $this->input->post('txt_clave'); ?>" class="cajatexto" id="txt_clave" />
				<span class="text-danger"><?php echo form_error('txt_clave'); ?></span>
			</div>
			<label for="txt_nombre" class="control-label"><span class="text-danger">* </span>Nombre Real:</label>
			<div class="form-group">
				<input type="text" name="txt_nombre" value="<?php echo $this->input->post('txt_nombre'); ?>" class="cajatexto" id="txt_nombre" />
				<span class="text-danger"><?php echo form_error('txt_nombre'); ?></span>
			</div>
			<label for="txt_cedula" class="control-label"><span class="text-danger">* </span>Cedula:</label>
			<div class="form-group">
				<input type="text" name="txt_cedula" value="<?php echo $this->input->post('txt_cedula'); ?>" class="cajatexto" id="txt_cedula" />
				<span class="text-danger"><?php echo form_error('txt_cedula'); ?></span>
			</div>
		</div>
		<div id="div2">
			<label for="txt_telefono" class="control-label"><span class="text-danger">* </span>Telefono:</label>
			<div class="form-group">
				<input type="number" name="txt_telefono" value="<?php echo $this->input->post('txt_telefono'); ?>" class="cajatexto" id="txt_telefono" />
				<span class="text-danger"><?php echo form_error('txt_telefono'); ?></span>
			</div>
			<label for="txt_correo" class="control-label"><span class="text-danger">* </span>Correo:</label>
			<div class="form-group">
				<input type="email" name="txt_correo" value="<?php echo $this->input->post('txt_correo'); ?>" class="cajatexto" id="txt_correo" />
				<span class="text-danger"><?php echo form_error('txt_correo'); ?></span>
			</div>
			<label for="cmb_tipo" class="control-label"><span class="text-danger">* </span>Tipo usuario:</label>
			<div class="form-group">
				<select name="cmb_tipo" id="cmb_tipo" variant="primary" class="form-select form-select-sm" aria-label=".form-select-sm example" class="d-flex form-control form-control-sm" /*v-model="form.id_proveedor" * />
				<option value="Comprador">Comprador</option>
				<option value="Tienda">Tienda</option>
				</select>
			</div>
			<label for="txt_pais" class="control-label"><span class="text-danger">* </span>Pais:</label>
			<div class="form-group">
				<input type="text" name="txt_pais" value="<?php echo $this->input->post('txt_pais'); ?>" class="cajatexto" id="txt_pais" />
				<span class="text-danger"><?php echo form_error('txt_pais'); ?></span>
			</div>
		</div>
		
		
		<div id="div3">
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>

</div>