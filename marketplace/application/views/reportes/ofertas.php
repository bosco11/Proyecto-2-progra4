<div id="app" style="background-color: white; color: black; width: 100%; height: 100%;">
    <img style='' src="<?php echo site_url('resources/img/tienda.png'); ?>" alt="logo" width="100" />
    <br>
    <h2 style='text-align: center; padding-top: 60px;'>Reporte Ofertas</h2>
    <br>
    <hr>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <?php echo form_open('comprador/compradorHome'); ?>
        <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">Salir</button>
        <?php echo form_close(); ?>
        <div class="nav-item">
            <?php echo form_open('tienda/buscarProductosReportesOfertas', "class=\"d-flex\"") ?>
            <input class="form-control mr-sm-2" type="date" id="FechaInicial" name="FechaInicial" placeholder="Fecha Inicial" aria-label="Fecha Inicial">
            <input class="form-control mr-sm-2" type="date" id="FechaFinal" name="FechaFinal" placeholder="Fecha Final" aria-label="Fecha Final">
            <input class="form-control mr-sm-2" type="number" id="precio" name="precio" placeholder="Precio Maximo" aria-label="Precio Maximo">
            <select name="cmb_categoria" id="cmb_categoria" variant="primary" aria-label=".form-select-sm example" class="form-select form-select-sm me-2">
                <option selected>Seleccionar categoría</option>
                <?php foreach ($categorias as $cate) { ?>
                    <option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
                <?php } ?>
            </select>
            <button class="btn btn-outline-success my-2 my-sm-0 me-2" type="submit">Buscar</button>
            <img style="cursor: pointer;" onclick="window.print()" src="https://www.altadenalibrary.org/wp-content/uploads/2020/08/printericon.png" title="Imprimir" alt="Imprimir" width="40" />
            <?php echo form_close(); ?>
        </div>
    </nav>
    <div style="text-align: center;">
        <h5><?php if ($categoria != null) echo " Categorias: $categoria";
            if ($fechaIni != null) echo " Fecha Inicial: $fechaIni";
            if ($fechaFin != null) echo " Fecha Final: $fechaFin";
            if ($precio != null) echo " Precio maximo: $precio"; ?></h5>
    </div>
    <hr>
    <div style="background-color: white; height: 1000px;" class="box-header-imprimir" id="ReporteSuscripciones">

        <h3 align="center">Tiendas</h3>
        <?php
        foreach ($tiendas as $Tienda) {
            $productos = $Tienda['productos']
        ?>
            <hr>
            <h4><?php echo $Tienda['nombre_real'] ?></h4>


            <h5 align="center">Productos</h5>
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