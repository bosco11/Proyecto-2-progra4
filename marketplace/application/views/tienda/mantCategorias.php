<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
    <div id="panel_app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <?php echo form_open('tienda/addCategoria'); ?>
                    <button type="submit" name="btn_add" id="btn_add" class="btn btn-primary me-2" title="AddProducto">Agregar Categoria</button>
                    <?php echo form_close(); ?>
                    <?php echo form_open('tienda/tiendaHome'); ?>
                    <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </nav>

        <div class="box-header">
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
                                <td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> </td>
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