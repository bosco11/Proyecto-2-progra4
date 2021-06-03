<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
    <div id="panel_app">
        <div class="box-header">
            <h2 class="box-title">Galeria de Producto</h2>
            <?php echo form_open('tienda/mantPro/' . $producto['id_productos']); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
            <?php echo form_close(); ?>
        </div>
        <div class="container">
            <div class="col-9">
                <div class="row align-items-start">
                    <?php foreach ($fotos as $fot) { ?>
                        <div class="col-3">
                            <img src='<?php echo site_url('/resources/files/' . $fot['imagen_producto']) ?>' class="d-block w-100" alt="...">
                            <?php echo form_open('tienda/deleteFoto/'. $producto['id_productos'].'/' . $fot['id_galeria']); ?>
                            <button type="submit" name="btn_elinfoto" id="btn_elinfoto" class="btn btn-danger me-2" title="Eliminar">X</button>
                            <?php echo form_close(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div>
                <?php echo form_open_multipart('tienda/addFotoProducto/' . $producto['id_productos']); ?>
                <input type="file" name="txt_file" size="20" class="btn btn-info" accept="image/jpeg,image/gif,image/png" />
                <br><br>
                <button type="submit" class="boton">Cargar Foto</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

<?php
} else {
    header("location: " . base_url());
}
?>