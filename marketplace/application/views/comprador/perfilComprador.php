<div id="panel_app">
    <div class="box-header">
        <h2 class="box-title">Informacion del usuario</h2>

        <?php
        if ($this->session->userdata['logged_in']['tipo'] == 'Tienda') { ?>
            <?php echo form_open('tienda/tiendaHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
            <?php echo form_close(); ?>
        <?php  } else { ?>
            <?php echo form_open('comprador/compradorHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
            <?php echo form_close(); ?>
        <?php } ?>

    </div>
    <div class="container-fluid" style="color: white;">
        <div class="col-md-4">
            <div>
                <img style="border-radius: 10px;" id="item-display" src='<?php echo site_url('/resources/photos/' . $user['imagen']) ?>' class="d-block w-100" height="300px" width="50px" alt="">
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <h2>Informacion del usuario</h2>
            <hr>
            <h3>Nombre completo: <?php echo $user['nombre_real'] ?></h3>
            <h3>Identificacion: <?php echo $user['cedula'] ?></h3>
            <h3>Telefono: <?php echo $user['telefono'] ?></h3>
            <h3>Correo: <?php echo $user['correo'] ?></h3>
            <h3>Dirección: <?php echo $user['direccion'] ?></h3>
            <h3>País: <?php echo $user['pais'] ?></h3>  
            <hr>
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
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane container active" id="service-one" style="font-size: 18px;">
                <section class="container lista-deseo">
                    <div id="tableview2">
                        <br><br><br>
                        <table class="table table-striped table-dark" id="table">
                            <thead>
                                <tr align="center">
                                    <td>Descripcion </td>
                                    <td>Fecha publicacion</td>
                                    <td>Precio</td>
                                    <td>Tiempo promedio</td>
                                    <td>Costo envío</td>
                                </tr>
                            </thead>
                            <tbody id="tbTable">
                                <?php if (!empty($carrito)) { ?>
                                    <?php foreach ($carrito as $pro) { ?>
                                        <tr align="center">
                                            <td><?php echo $pro['descripcion'] ?></td>
                                            <td><?php echo $pro['fecha_publicacion'] ?></td>
                                            <td><?php echo $pro['precio'] ?></td>
                                            <td><?php echo $pro['tiempo_promedio'] ?></td>
                                            <td><?php echo $pro['costo_envio'] ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <h2>No hay suscripciones por mostar</h2>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="tab-pane container" id="service-two" style="font-size: 18px;">
                <section class="container suscripciones">
                    <div id="tableview2">
                        <br><br><br>
                        <table class="table table-striped table-dark" id="table">
                            <thead>
                                <tr align="center">
                                    <td>Nombre tienda </td>
                                    <td>Logo</td>
                                    <td>Direccion</td>
                                </tr>
                            </thead>
                            <tbody id="tbTable">
                                <?php if (!empty($suscripciones)) { ?>
                                    <?php foreach ($suscripciones as $pro) { ?>
                                        <tr align="center">
                                            <td><?php echo $pro['nombre_real'] ?></td>
                                            <td><img style="border-radius: 10px;" id="item-display" src='<?php echo site_url('/resources/photos/' . $pro['imagen']) ?>'  height="40px" width="50px" alt=""></td>
                                            <td><?php echo $pro['direccion'] ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <h2>No hay suscripciones por mostar</h2>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>