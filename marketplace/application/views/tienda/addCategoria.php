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

                     <?php echo form_open('tienda/mantCategoria'); ?> <!-- Se crea un form para regresar a la vista mentenimiento categoria -->
                    <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button><!-- Se crea un boton de regresar -->
                    <?php echo form_close(); ?>
                </div>
            </nav>
        </div>
        <br>
        <?php if ($categoria != null) { //Condicion para determinar si la vista se utilizara para editar o crear una categoria.
            echo form_open('tienda/addCategoria/' . $categoria['id_categorias']);
        } else {
            echo form_open('tienda/addCategoria');
        }
        ?>
        <div id="edit_panel">
        <h2 style="text-align: center;" class="box-title">Mantenimiento Categorias</h2>
            <label for="txt_categoria" class="control-label"><span class="text-danger">* </span> Nombre de la categoria:</label>
            <?php if ($categoria != null) { ?>
                <div class="form-group">
                    <input type="text" name="txt_categoria" value="<?php echo $this->input->post('txt_categoria') ? $this->input->post('txt_categoria') : $categoria['categorias']; ?>" class="cajatexto" id="txt_categoria" />
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <input type="text" name="txt_categoria" value="<?php echo $this->input->post('txt_categoria');  ?>" class="cajatexto" id="txt_categoria" />
                </div>
            <?php  } ?>
            <div>
                <div class="box-footer">
                    <button type="submit" title="Guardar" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
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