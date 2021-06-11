<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reporte</title>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@2.0.0-rc.28/dist/bootstrap-vue.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-vue@0.15.8/dist/bootstrap-vue.css" crossorigin="anonymous">

</head>

<body>
    <div id="app">
        <img style='float: left;' src="https://image.freepik.com/vector-gratis/plantilla-logotipo-supermercado-carrito-compras_23-2148470295.jpg" alt="logo" width="190" />
        <h2 style='position: relative; text-align: center; padding-top: 60px;'>Reporte General</h2>
        <br>
        <img style="cursor: pointer;" onclick="window.print()" src="https://www.altadenalibrary.org/wp-content/uploads/2020/08/printericon.png" title="Imprimir" alt="Imprimir" width="40" />
        <div class="box-header-imprimir" id="ReporteVentas">
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
                            <?php echo form_open('tienda/mantPro/' . $pro['id_productos']); ?>
                            <tr align="center">
                                <td><?php echo $pro['descripcion'] ?></td>
                                <td><?php echo $pro['fecha'] ?></td>
                                <td><?php echo $pro['categorias'] ?></td>
                                <td><?php echo $pro['cantidades'] ?></td>
                                <td><?php echo $pro['costo_envio'] ?></td>
                                <td><?php echo $pro['precio'] ?></td>
                            </tr>
                            <?php echo form_close(); ?>
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
            <div style="text-align: center;"></div>
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
                        title: 'Cantidad de unidades vendidas por producto',
                        width: 900,
                        height: 500,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
            </script>
            <div id="piechart"></div>
        </div>
    </div>
</body>

</html>