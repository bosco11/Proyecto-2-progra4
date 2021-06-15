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
if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
    <div id="panel_app">
        <div class="box-header">
            <h2 class="box-title">Mantenimiento Categorias</h2>
            <?php echo form_open('tienda/tiendaHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
            <?php echo form_close(); ?>
        </div>
        <?php if ($categoria != null) {
            echo form_open('tienda/addCategoria/' . $categoria['id_categorias']);
        } else {
            echo form_open('tienda/addCategoria');
        }
        ?>
        <div id="edit_panel">
            <label for="txt_categoria" class="control-label"><span class="text-danger">* </span> Nombre de la categoria:</label>
            <?php if ($categoria != null) { ?>
                <div class="form-group">
                    <input type="text" name="txt_categoria" value="<?php echo $this->input->post('txt_categoria') ? $this->input->post('txt_categoria') : $categoria['categorias'];?>" class="cajatexto" id="txt_categoria" />
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <input type="text" name="txt_categoria" value="<?php echo $this->input->post('txt_categoria') ;  ?>" class="cajatexto" id="txt_categoria" />
                </div>
            <?php  } ?>
            <div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>


    </div>
<?php
} else {
    header("location: " . base_url());
}
?>