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

                    <?php echo form_open('tienda/mantPro/' . $producto['id_productos']); ?><!-- Se crea un form para regresar a la vista anterior -->
                    <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
                    <?php echo form_close(); ?>
                    <?php echo form_open_multipart('tienda/addFotoProducto/' . $producto['id_productos']); ?><!-- Se crea un form para cargar y agregar una foto -->
                    <input type="file" name="txt_file" size="20" class="btn btn-info" accept="image/jpeg,image/gif,image/png" />
                    <button type="submit" title="Cargar foto" class="btn btn-primary"><i class="fas fa-arrow-up"></i> Cargar Foto</button>
                    <?php echo form_close(); ?>
                </div>
            </nav>
        </div>
        <br>
        <div class="container">
            <div id="main_panel">
                <h2 style="text-align: center;" class="box-title">Galeria de Producto</h2>
                <div class="col-9">
                    <div class="row align-items-start">
                        <?php foreach ($fotos as $fot) { ?><!-- Muestra todas las fotos de un producto -->
                            <div style="border: 1px solid #253341; margin-bottom: 5px;  text-align: center;" class="col-3">
                                <img src='<?php echo site_url('/resources/files/' . $fot['imagen_producto']) ?>' class="d-block w-100" alt="Producto" width="170" height="250">
                                <?php echo form_open('tienda/deleteFoto/' . $producto['id_productos'] . '/' . $fot['id_galeria']); ?>
                                <button type="submit" name="btn_elinfoto" id="btn_elinfoto" class="btn btn-danger" title="Eliminar"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                <?php echo form_close(); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    header("location: " . base_url());
}
?>