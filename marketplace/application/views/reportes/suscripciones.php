<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

    <div id="app" style="background-color: white; color: black; width: 100%; height: 100%;">
        <img style='' src="<?php echo site_url('resources/img/tienda.png'); ?>" alt="logo" width="100" height="100"/>
        <br>
        <h2 style='text-align: center; padding-top: 60px;'>Reporte Suscripciones</h2>
        <h4 style='text-align: center;'>Usuario <?php echo $this->session->userdata['logged_in']['nombre_real'] ?></h4>
        <br>
        <hr>
        <nav class="navbar navbar-light bg-light justify-content-between">
            <?php echo form_open('comprador/compradorHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
            <?php echo form_close(); ?>
            <div class="nav-item">
                <img style="cursor: pointer;" onclick="window.print()" src="https://www.altadenalibrary.org/wp-content/uploads/2020/08/printericon.png" title="Imprimir" alt="Imprimir" width="40" />
            </div>
        </nav>
        <hr>
        <div  style="background-color: white; height: 1000px;" class="box-header-imprimir" id="ReporteSuscripciones">

            <h3 align="center">Suscripciones</h3>
            <?php
            foreach ($tiendas as $Tienda) {
                $productos = $Tienda['productos']
            ?>

                <h4><?php echo $Tienda['nombre_real'] ?></h4>

                <hr>
                <h5 align="center">Productos en lista de deseos</h5>
                <div id="tableview">
                    <table class="table table-striped table-white" id="table">
                        <thead>
                            <tr align="center">
                                <td>Descripcion </td>
                                <td>Fecha publicacion</td>
                                <td>Categoria</td>
                                <td>Cantidad disponible</td>
                                <td>Costo envio</td>
                                <td>Precio del producto(Unidad)</td>
                            </tr>
                        </thead>
                        <tbody id="tbTable">
                            <?php foreach ($productos as $pro) { ?>
                                <tr align="center">
                                    <td><?php echo $pro['descripcion'] ?></td>
                                    <td><?php echo $pro['fecha_publicacion'] ?></td>
                                    <td><?php echo $pro['categorias'] ?></td>
                                    <td><?php echo $pro['cantidad'] ?></td>
                                    <td><?php echo $pro['costo_envio'] ?></td>
                                    <td><?php echo $pro['precio'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            <?php } ?>
        </div>
    </div>

<?php
} else {
    header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>