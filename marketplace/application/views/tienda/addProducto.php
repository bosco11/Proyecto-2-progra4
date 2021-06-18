<?php
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
            <nav class="navbar navbar-dark bg-dark justify-content-between">
                <div class="container-fluid">
                    <?php echo form_open('tienda/tiendaHome'); ?><!-- Se crea un form para regresar a la vista anterior -->
                    <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
                    <?php echo form_close(); ?>
                </div>
            </nav>
        </div>
        <br>
        <?php echo form_open('tienda/addProducto/0'); ?><!-- Se crea un form para añadir un producto nuevo-->
        <div id="edit_panel">
            <h2 style="text-align: center;" class="box-title">Mantenimiento Producto</h2>
            <div id="div1">
                <label for="txt_descripcion" class="control-label"><span class="text-danger">* </span>Descripcion:</label>
                <div class="form-group">
                    <input type="text" name="txt_descripcion" value="<?php echo $this->input->post('txt_descripcion'); ?>" class="cajatexto" id="txt_descripcion" />

                </div>
                <label for="txt_cantidad" class="control-label"><span class="text-danger">* </span>Cantidad:</label>
                <div class="form-group">
                    <input type="number" name="txt_cantidad" value="<?php echo $this->input->post('txt_cantidad'); ?>" class="cajatexto" id="txt_cantidad" />

                </div>
                <label for="txt_costoEnvio" class="control-label"><span class="text-danger">* </span>Costo de Envio:</label>
                <div class="form-group">
                    <input type="number" name="txt_costoEnvio" value="<?php echo $this->input->post('txt_costoEnvio'); ?>" class="cajatexto" id="txt_costoEnvio" />

                </div>
                <label for="txt_precio" class="control-label"><span class="text-danger">* </span>Precio:</label>
                <div class="form-group">
                    <input type="number" name="txt_precio" value="<?php echo $this->input->post('txt_precio'); ?>" class="cajatexto" id="txt_precio" />

                </div>
            </div>
            <div id="div2">
                <label for="cmb_categoria" class="control-label"><span class="text-danger">* </span>Categoria:</label>
                <div class="form-group">
                    <select name="cmb_categoria" id="cmb_categoria" variant="primary" class="form-select form-select-sm" aria-label=".form-select-sm example" class="d-flex form-control form-control-sm">
                        <?php foreach ($categorias as $cate) { ?><!-- Se carga un combobox con todas las categorias -->
                            <option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label for="txt_entrega" class="control-label"><span class="text-danger">* </span>Tiempo de entrega:</label>
                <div class="form-group">
                    <input type="text" name="txt_entrega" value="<?php echo $this->input->post('txt_entrega'); ?>" class="cajatexto" id="txt_entrega" />

                </div>
                <label for="txt_ubicacion" class="control-label"><span class="text-danger">* </span>Ubicacion:</label>
                <div class="form-group">
                    <input type="text" name="txt_ubicacion" value="<?php echo $this->input->post('txt_ubicacion'); ?>" class="cajatexto" id="txt_ubicacion" />

                </div>
            </div>


            <div>
                <div class="box-footer">
                    <button type="submit" title="Guardar"class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
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