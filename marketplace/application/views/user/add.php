<?php
if (isset($logout_message)) {

	echo "<div style='font-size: 18px;' class='alert alert-success alert-dismissible fade show' role='alert'><i class='fas fa-check-circle'></i>"
		. $logout_message .
		"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

if (isset($message_display)) {

	echo "<div style='font-size: 18px;' class='alert alert-success alert-dismissible fade show' role='alert'><i class='fas fa-check-circle'></i>"
		. $message_display .
		"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}


if (isset($error_message)) {

	echo "<div style='font-size: 18px;' class='alert alert-warning alert-dismissible fade show' role='alert'> <i class='fas fa-exclamation-triangle'></i>"
		. $error_message .
		"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

if (validation_errors() !== "") {

	echo "<div style='font-size: 18px;' class='alert alert-warning alert-dismissible fade show' role='alert'><i class='fas fa-exclamation-triangle'></i>"
		. validation_errors() .
		"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

?>
<!-- Vista de insercion de usuarios -->
<div id="panel_app">
	<div class="box-header">
		<nav class="navbar navbar-dark bg-dark justify-content-between">
			<div class="container-fluid">

				<?php echo form_open('comprador/compradorHome'); ?>
				<button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
				<?php echo form_close(); ?>
			</div>
		</nav>
	</div>
	<br>
	<?php echo form_open_multipart('user/agregarUsuario'); ?>
	<div>
		<h2 style="text-align: center;" class="box-title">Agregando Usuario</h2>
		<div id="div1">
			<label for="txt_usuario" class="control-label"><span class="text-danger">* </span>Usuario:</label>
			<div class="form-group">
				<input type="text" name="txt_usuario" value="<?php echo $this->input->post('txt_usuario'); ?>" class="cajatexto" id="txt_usuario" maxlength="50" />
				<span class="text-danger"><?php echo form_error('txt_usuario'); ?></span>
			</div>
			<label for="txt_clave" class="control-label"><span class="text-danger">* </span>Contraseña:</label>
			<div class="form-group">
				<input type="password" name="txt_clave" value="<?php echo $this->input->post('txt_clave'); ?>" class="cajatexto" id="txt_clave" maxlength="200" />
				<span class="text-danger"><?php echo form_error('txt_clave'); ?></span>
			</div>
			<label for="txt_nombre" class="control-label"><span class="text-danger">* </span>Nombre Real:</label>
			<div class="form-group">
				<input type="text" name="txt_nombre" value="<?php echo $this->input->post('txt_nombre'); ?>" class="cajatexto" id="txt_nombre" maxlength="100" />
				<span class="text-danger"><?php echo form_error('txt_nombre'); ?></span>
			</div>
			<label for="txt_cedula" class="control-label"><span class="text-danger">* </span>Cedula:</label>
			<div class="form-group">
				<input type="text" name="txt_cedula" value="<?php echo $this->input->post('txt_cedula'); ?>" class="cajatexto" id="txt_cedula" maxlength="12" />
				<span class="text-danger"><?php echo form_error('txt_cedula'); ?></span>
			</div>
		</div>

		<div id="div2">
			<label for="txt_telefono" class="control-label"><span class="text-danger">* </span>Telefono:</label>
			<div class="form-group">
				<input type="text" name="txt_telefono" value="<?php echo $this->input->post('txt_telefono'); ?>" class="cajatexto" id="txt_telefono" maxlength="14" />
				<span class="text-danger"><?php echo form_error('txt_telefono'); ?></span>
			</div>
			<label for="txt_correo" class="control-label"><span class="text-danger">* </span>Correo:</label>
			<div class="form-group">
				<input type="email" name="txt_correo" value="<?php echo $this->input->post('txt_correo'); ?>" class="cajatexto" id="txt_correo" maxlength="45" />
				<span class="text-danger"><?php echo form_error('txt_correo'); ?></span>
			</div>
			<label for="cmb_tipo" class="control-label"><span class="text-danger">* </span>Tipo usuario:</label>
			<div class="form-group">
				<select name="cmb_tipo" id="cmb_tipo" variant="primary" class="form-select form-select-sm" aria-label=".form-select-sm example" class="d-flex form-control form-control-sm">
					<option value="Comprador">Comprador</option>
					<option value="Tienda">Tienda</option>
				</select>
			</div>
			<label for="txt_pais" class="control-label"><span class="text-danger">* </span>Pais:</label>
			<div class="form-group">
				<input type="text" name="txt_pais" value="<?php echo $this->input->post('txt_pais'); ?>" class="cajatexto" id="txt_pais" maxlength="100"/>
				<span class="text-danger"><?php echo form_error('txt_pais'); ?></span>
			</div>
			<label for="txt_direccion" class="control-label"><span class="text-danger">* </span>Direccion:</label>
			<div class="form-group">
				<input type="text" name="txt_direccion" value="<?php echo $this->input->post('txt_direccion'); ?>" class="cajatexto" id="txt_direccion" maxlength="200"/>
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
<script>
	window.addEventListener('load', miFuncionLoad, false);

	function miFuncionLoad() {		
		var nrc = document.getElementById('txt_cedula');
		nrc.addEventListener('keyup', validarNumero, false);
		var nrc = document.getElementById('txt_telefono');
		nrc.addEventListener('keyup', validarNumero, false);	
	}

	function validarNumero() {
		var val = document.getElementById(this.id).value;
		if (isNaN(document.getElementById(this.id).value)) {
			this.value = val.substring(0, val.length - 1);
		}
	}
</script>