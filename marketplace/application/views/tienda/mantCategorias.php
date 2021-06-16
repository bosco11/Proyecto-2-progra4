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
        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <div class="container-fluid">
                <?php echo form_open('tienda/tiendaHome'); ?>
                <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
                <?php echo form_close(); ?>
                <?php echo form_open('tienda/addCategoria'); ?>
                <button type="submit" name="btn_add" id="btn_add" class="btn btn-primary me-2" title="Agregar Categoria"><i class="fas fa-plus"></i> Agregar Categoria</button>
                <?php echo form_close(); ?>

            </div>
        </nav>
        <br>
        <div id="main_panel">
            <h3 align="center">Categorias</h3>
            <div id="tableview">
                <table class="table table-striped table-dark" id="table">
                    <thead>
                        <tr align="center">
                            <td>Nombre de la categoria</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody id="tbTable">
                        <?php foreach ($categorias as $categoria) { ?>
                            <?php echo form_open('tienda/addCategoria/' . $categoria['id_categorias']); ?>
                            <tr align="center">
                                <td><?php echo $categoria['categorias'] ?></td>
                                <td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar"><i class="fas fa-edit"></i></button> </td>
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
    header("location: " . base_url());
}
?>