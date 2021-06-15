<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

    <div id="app" style="background-color: white; color: black; width: 100%; height: 100%;">
        <img style='' src="<?php echo site_url('resources/img/tienda.png'); ?>" alt="logo" width="100" />
        <br>
        <h2 style='text-align: center; padding-top: 60px;'>Factura de compra</h2>
        <h4 style='text-align: center;'>Usuario <?php echo $this->session->userdata['logged_in']['nombre_real'] ?></h4>
        <br>
        <hr>
        <nav class="navbar navbar-light bg-light justify-content-between">
            <?php echo form_open('comprador/compradorHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">Salir</button>
            <?php echo form_close(); ?>
            <div class="nav-item">
                <img style="cursor: pointer;" onclick="window.print()" src="https://www.altadenalibrary.org/wp-content/uploads/2020/08/printericon.png" title="Imprimir" alt="Imprimir" width="40" />
            </div>
        </nav>
        <hr>
        <div style="background-color: white; height: 1000px;" class="box-header-imprimir" id="ReporteSuscripciones">

            <h3 align="center">Suscripciones</h3>
            <hr>
            <h5 align="center">Nombre comprador</h5>
            <h6 align="center"><?php echo $compra['nombre_real'] ?></h6>
            <h5 align="center">Cedula comprador</h5>
            <h6 align="center"><?php echo $compra['cedula'] ?></h6>
            <h5 align="center">Forma de pago</h5>
            <h6 align="center"><?php echo $compra['numero_tarjeta'] ?></h6>
            <h5 align="center">Dirrecion de envio</h5>
            <h6 align="center"><?php echo $compra['pais_direccion'] . " " . $compra['provincia'] . ", casillero: " . $compra['numero_casillero'] ?></h6>
            <h5 align="center">Fecha compra</h5>
            <h6 align="center"><?php echo $compra['fecha'] ?></h6>
            <?php if (isset($compra['id_premios'])) { ?>
                <h5 align="center">Premio seleccionado</h5>
                <h6 align="center"><?php echo $compra['descripcion'] ?></h6>
            <?php } ?>
            <h5 align="center">Productos comprados</h5>
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
                            <td>Tienda</td>
                        </tr>
                    </thead>
                    <tbody id="tbTable">
                        <?php
                        $productos = $compra['productos'];
                        foreach ($productos as $pro) { ?>
                            <tr align="center">
                                <td><?php echo $pro['descripcion'] ?></td>
                                <td><?php echo $pro['fecha_publicacion'] ?></td>
                                <td><?php echo $pro['categorias'] ?></td>
                                <td><?php echo $pro['cantidades'] ?></td>
                                <td><?php echo $pro['costo_envio'] ?></td>
                                <td><?php echo $pro['precio'] ?></td>
                                <td><?php echo $pro['nombre_real'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <h5 align="center">Precio total: <?php echo $compra['precio_total'] ?></h5>
        </div>
    </div>

<?php
} else {
    header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>