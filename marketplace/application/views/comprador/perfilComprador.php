<div id="panel_app">
    <div class="box-header">
        <h2 class="box-title">Informacion del usuario</h2>

        <?php
        if ($this->session->userdata['logged_in']['tipo'] == 'Tienda') { ?>
            <?php echo form_open('tienda/tiendaHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
            <?php echo form_close(); ?>
        <?php  } else { ?>
            <?php echo form_open('comprador/compradorHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
            <?php echo form_close(); ?>
        <?php } ?>

    </div>
    <div class="container-fluid" style="color: white;">
        <div class="col-md-4">
            <!-- <center> -->
            <div>
                <img style="border-radius: 10px;" id="item-display" src='<?php echo site_url('/resources/photos/' . $user['imagen']) ?>' class="d-block w-100" height="300px" width="50px" alt="">
            </div>
            <!-- </center> -->
        </div>
        <br>
        <div class="col-md-12">
            <h2>Informacion del usuario</h2>
            <hr>
            <h3>Nombre completo:<?php echo $user['nombre_real'] ?></h3>
            <h3>Identificacion:<?php echo $user['cedula'] ?></h3>
            <h3>Telefono:<?php echo $user['telefono'] ?></h3>
            <h3>Correo:<?php echo $user['correo'] ?></h3>
            <h3>Dirección:<?php echo $user['direccion'] ?></h3>
            <h3>País:<?php echo $user['pais'] ?></h3>
            <?php print_r($carrito) ?>

        </div>
    </div>
</div>
<div class="container-fluid" style=" color: white;">
    <div class="col-md-12 product-info">
        <ul id="myTab" class="nav nav-pills">

            <li class="nav-item me-2">
                <a class="nav-link active" href="#service-one" data-toggle="tab">Lista Deseos</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="#service-two" data-toggle="tab">Tiendas suscritas</a>
            </li>
            <!-- <li class="nav-item me-2">
                <a class="nav-link" href="#service-three" data-toggle="tab">RESEÑAS Y CALIFICACIONES</a>
            </li> -->

        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane container active" id="service-one" style="font-size: 18px;">

                <section class="container lista-deseo">
                <!-- <div id="tableview2">
                        <table class="table table-striped table-dark" id="table">
                            <thead>
                                <tr align="center">
                                    <td>Pais </td>
                                    <td>Provincia</td>
                                    <td>Casillero</td>
                                    <td>Codigo Postal</td>
                                    <td>Observaciones</td>
                                    <td>Acciones</td>

                                </tr>
                            </thead>
                            <tbody id="tbTable">
                                <?php foreach ($direcciones as $pro) { ?>
                                    <?php echo form_open('user/mantDir/' . $pro['id_direcciones']); ?>
                                    <tr align="center">
                                        <td><?php echo $pro['pais_direccion'] ?></td>
                                        <td><?php echo $pro['provincia'] ?></td>
                                        <td><?php echo $pro['numero_casillero'] ?></td>
                                        <td><?php echo $pro['codigo_postal'] ?></td>
                                        <td><?php echo $pro['observaciones'] ?></td>
                                        <td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar">Eliminar</button> </td>
                                    </tr>
                                    <?php echo form_close(); ?>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div> -->

                </section>

            </div>
            <div class="tab-pane container" id="service-two" style="font-size: 18px;">

                <section class="container suscripciones">

                </section>

            </div>
            <!-- <div class="tab-pane container" id="service-three">
                <section class="container reviews-info">

                </section>
            </div> -->
        </div>

    </div>
</div>