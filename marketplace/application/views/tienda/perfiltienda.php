<div id="panel_app" style=" align-items: center;">
    <div class="box-header">
        <h2 class="box-title">Informacion de la tienda</h2>
        <?php echo form_open('comprador/compradorHome'); ?>
        <button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Regresar">←</button>
        <?php echo form_close(); ?>
    </div>
    <div class="container-fluid" style=" align-items: center;">
        <div class="col-md-5">
            <img id="item-display" src='<?php echo site_url('/resources/photos/' . $tienda['imagen']) ?>' class="d-block w-100" height="300px" width="600px" alt="...">

        </div>

        <div class="product-title"><?php echo $tienda['nombre_real'] ?></div>

        <div class="product-rating">
            <i class="fa fa-star gold"></i>
            <i class="fa fa-star gold"></i>
            <i class="fa fa-star gold"></i>
            <i class="fa fa-star gold"></i>
            <i class="fa fa-star gold"></i>
        </div>
        <?php if (isset($this->session->userdata['logged_in']) AND $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) { ?>
            <hr>
            <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Suscribirse</button>
        <?php } ?>
        <hr>
        <div class="col-md-16 product-info">
            <ul id="myTab" class="nav nav-tabs">

                <li class="nav-item me-2">
                    <a class="nav-link active" href="#service-one" data-toggle="tab">PRODUCTOS</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link" href="#service-two" data-toggle="tab">INFORMACIÓN TIENDA</a>
                </li>
                <?php if (isset($this->session->userdata['logged_in']) AND $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) { ?>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="#service-three" data-toggle="tab">CALIFICACIONES</a>
                    </li>
                <?php } ?>

            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="service-one" style="font-size: 18px;">

                    <section class="container product-info">

                        <div id="tableview">
                            <table class="table table-striped table-dark" id="table">
                                <thead>
                                    <tr align="center">
                                        <td>Descripcion </td>
                                        <td>Cantidad disponible</td>
                                        <td>Costo envio</td>
                                        <td>Precio</td>
                                        <td>Fecha publicacion</td>
                                        <td>Categoria</td>
                                        <td>Tiempo de entrega</td>
                                        <td>Ubcacion del producto</td>
                                        <?php if (isset($this->session->userdata['logged_in']) AND $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) { ?>
                                            <td>Acciones</td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody id="tbTable">
                                    <?php foreach ($productos as $pro) { ?>
                                        <?php echo form_open('tienda/mantPro/' . $pro['id_productos']); ?>
                                        <tr align="center">
                                            <td><?php echo $pro['descripcion'] ?></td>
                                            <td><?php echo $pro['cantidad'] ?></td>
                                            <td><?php echo $pro['costo_envio'] ?></td>
                                            <td><?php echo $pro['precio'] ?></td>
                                            <td><?php echo $pro['fecha_publicacion'] ?></td>
                                            <td><?php echo $pro['categorias'] ?></td>
                                            <td><?php echo $pro['tiempo_promedio'] ?></td>
                                            <td><?php echo $pro['ubicacion_fisica'] ?></td>
                                            <?php if (isset($this->session->userdata['logged_in']) AND $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) { ?>
                                                <td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">🛒</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar">❤️</button> </td>
                                            <?php } ?>

                                        </tr>
                                        <?php echo form_close(); ?>
                                    <?php } ?>

                                </tbody>
                            </table>

                        </div>

                </div>
                <div class="tab-pane fade" id="service-two" style="font-size: 18px;">

                    <section class="container shop-info">
                        <br>
                        <br>
                        <img src='<?php echo site_url('/resources/photos/' . $tienda['imagen']) ?>' width="200" alt="">
                        <h3> Información de tienda: </h3>
                        <li>Nombre tienda:<?php echo $tienda['nombre_real'] ?></li>
                        <li>Teléfono:<?php echo $tienda['telefono'] ?></li>
                        <li>Correo:<?php echo $tienda['correo'] ?></li>
                        <li>País:<?php echo $tienda['pais'] ?></li>
                        <li>Dirección: <?php echo $tienda['direccion'] ?></li>

                    </section>

                </div>
                <?php if (isset($this->session->userdata['logged_in'])) { ?>
                    <div class="tab-pane fade" id="service-three">
                        <section class="container reviews-info">
                            <div class="container d-flex justify-content-center mt-200">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="stars">
                                            <?php echo form_open('tienda/calificarPro/' . $tienda['id_usuarios'] AND $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) ?>
                                            <!-- checked="checked" -->
                                            <div action="">
                                                <input value="5" class="star star-5" id="star-5" type="radio" name="star" /> <label class="star star-5" for="star-5"></label>
                                                <input value="4" class="star star-4" id="star-4" type="radio" name="star" /> <label class="star star-4" for="star-4"></label>
                                                <input value="3" class="star star-3" id="star-3" type="radio" name="star" /> <label class="star star-3" for="star-3"></label>
                                                <input value="2" class="star star-2" id="star-2" type="radio" name="star" /> <label class="star star-2" for="star-2"></label>
                                                <input value="1" class="star star-1" id="star-1" type="radio" name="star" /> <label class="star star-1" for="star-1"></label>
                                                <button type="submit" name="btn_" id="btn_" class="btn btn-secondary me-2" title="Editar">Calificar</button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                <?php } ?>
            </div>
            <hr>
        </div>
    </div>
</div>
</div>