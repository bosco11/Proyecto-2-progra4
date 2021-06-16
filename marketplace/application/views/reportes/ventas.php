<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

    <div  id="app" style="background-color: white; color: black; width: 100%; height: 100%;">
        <img style='' src="<?php echo site_url('resources/img/tienda.png'); ?>" alt="logo" width="100" height="100"/>
        <br>
        <h2 style='text-align: center; padding-top: 60px;'>Reporte Ventas</h2>
        <h4 style='text-align: center;'>Tienda <?php echo $this->session->userdata['logged_in']['nombre_real'] ?></h4>
        <br>
        <hr>
        <nav class="navbar navbar-light bg-light justify-content-between">
            <?php echo form_open('tienda/tiendaHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
            <?php echo form_close(); ?>
            <div class="nav-item">
                <?php echo form_open('tienda/buscarProductosReportes', "class=\"d-flex\"") ?>
                <input class="form-control me-2" type="date" id="FechaInicial" name="FechaInicial" placeholder="Fecha Inicial" aria-label="Fecha Inicial">
                <input class="form-control me-2" type="date" id="FechaFinal" name="FechaFinal" placeholder="Fecha Final" aria-label="Fecha Final">
                <button class="btn btn-secondary me-2"title="Buscar" type="submit"><i class="fas fa-search"></i>Buscar</button>
                <img style="cursor: pointer;" onclick="window.print()" src="https://www.altadenalibrary.org/wp-content/uploads/2020/08/printericon.png" title="Imprimir" alt="Imprimir" width="40" />
                <?php echo form_close(); ?>
            </div>
        </nav>
        <div style="text-align: center;">
            <?php if ($FechaIni != null) { ?>
                <h5>Fecha Inicial: <?php echo $FechaIni  ?> | Fecha Final: <?php echo $FechaFin ?></h5>
            <?php } ?>
        </div>
        <hr>
        <div style="background-color: white; height: 1000px;" class="box-header-imprimir" id="ReporteVentas">

            <h3 align="center">PRODUCTOS</h3>
            <div id="tableview">
                <table class="table table-striped table-white" id="table">
                    <thead>
                        <tr align="center">
                            <td>Descripcion </td>
                            <td>Fecha compra</td>
                            <td>Categoria</td>
                            <td>Cantidad de vendido</td>
                            <td>Costo envio</td>
                            <td>Precio del producto(Unidad)</td>
                        </tr>
                    </thead>
                    <tbody id="tbTable">
                        <?php foreach ($productos as $pro) { ?>
                            <tr align="center">
                                <td><?php echo $pro['descripcion'] ?></td>
                                <td><?php echo $pro['fecha'] ?></td>
                                <td><?php echo $pro['categorias'] ?></td>
                                <td><?php echo $pro['cantidades'] ?></td>
                                <td><?php echo $pro['costo_envio'] ?></td>
                                <td><?php echo $pro['precio'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            <hr>
            <?php
            $productosGrafico = array();

            $precioTotal = 0;
            foreach ($productos as $pro) {
                for ($i = 0; $i < $pro['cantidades']; $i++) {
                    $precioTotal += ($pro['costo_envio'] + $pro['precio']);
                }
            }

            foreach ($productos as $pro) {
                $cantidadProductos = 0;
                $band = true;
                foreach ($productosGrafico as $proGra) {
                    if ($proGra['id_productos'] == $pro['id_productos']) {
                        $band = false;
                    }
                }
                if ($band) {
                    foreach ($productos as $pro2) {
                        if ($pro2['id_productos'] == $pro['id_productos'])
                            $cantidadProductos += $pro2['cantidades'];
                    }
                    array_push($productosGrafico, array("id_productos" => $pro['id_productos'], "descripcion" => $pro['descripcion'], "cantidades" => $cantidadProductos));
                }
            }
            echo "<h3>Precio Total : " . $precioTotal . "</h3>";
            ?>
            <hr>
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Language', 'Rating'],
                        <?php
                        foreach ($productosGrafico as $pro) {
                            echo "['" . $pro['descripcion'] . "', " . $pro['cantidades'] . "],";
                        }
                        ?>
                    ]);

                    var options = {
                        title: 'Grafico unidades vendidas por producto',
                        width: "100%",
                        height: 500,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
            </script>
            <div style="text-align: center;" id="piechart"></div>
        </div>
    </div>

<?php
} else {
    header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>