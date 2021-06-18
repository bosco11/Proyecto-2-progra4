<?php
if ($message_display != null) {
    if (isset($message_display)) {

        echo "<div style='font-size: 18px;' class='alert alert-success alert-dismissible fade show' role='alert'><i class='fas fa-check-circle'></i>"
            . $message_display .
            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
}
if ($error_message != null) {
    if (isset($error_message)) {

        echo "<div style='font-size: 18px;' class='alert alert-warning alert-dismissible fade show' role='alert'> <i class='fas fa-exclamation-triangle'></i>"
            . $error_message .
            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
}

if (validation_errors() !== "") {

    echo "<div style='font-size: 18px;' class='alert alert-warning alert-dismissible fade show' role='alert'><i class='fas fa-exclamation-triangle'></i>"
        . validation_errors() .
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

?>
<div id="panel_app">
    <div class="box-header">
        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <!-- form para regresar a otra vista -->
            <div class="container-fluid">
                <?php if ($seccion == TRUE) { ?>
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
                <?php } else { ?>
                    <?php echo form_open('comprador/compradorHome'); ?>
                    <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
                    <?php echo form_close(); ?>
                <?php } ?>
            </div>
        </nav>
    </div>
    <div id="panel_app">
        <h2 style="text-align: center;" <h2 style="text-align: center;" class="box-title">Informacion del producto</h2>


        <div class="col-md-12">
            <center>
                <!-- form para el carrousel de las fotos del producto -->
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="padding-top: 20px;">
                    <div class="carousel-inner " style="width: 500px; height: 300px; border-radius: 20px;">
                        <?php $cont = 1 ?>
                        <?php if (!empty($galeria)) { ?>
                            <?php foreach ($galeria as $g) { ?>
                                <?php
                                if ($cont == 1) {
                                    $band = 'active';
                                } else {
                                    $band = '';
                                }
                                $cont = $cont + 1;
                                ?>
                                <div class="carousel-item <?php echo $band ?>">
                                    <img id="item-display" src='<?php echo site_url('/resources/files/' . $g['imagen_producto']) ?>' class="d-block w-100" height="300px" width="300px" alt="...">
                                </div>

                            <?php } ?>
                        <?php } ?>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </center>
        </div>
        <br>
        <div>
            <br>
            <!-- form para obtener la calificacion en estrellas globales del producto -->
            <div class="product-title"><?php echo $producto['descripcion'] ?></div>
            <hr>
            <div class="product-title">Calificacion</div>
            <br>
            <div class="product-rating">

                <?php if ($calificacion == 0) { ?>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                <?php } ?>
                <?php if ($calificacion == 1) { ?>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                <?php } ?>

                <?php if ($calificacion == 2) { ?>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                <?php } ?>
                <?php if ($calificacion == 3) { ?>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gray"></i>
                    <i class="fa fa-star gray"></i>
                <?php } ?>
                <?php if ($calificacion == 4) { ?>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gray"></i>
                <?php } ?>
                <?php if ($calificacion == 5) { ?>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                    <i class="fa fa-star gold"></i>
                <?php } ?>
            </div>
            <hr>
            <!-- form para mostrarle al usuario si el producto esta disponible -->
            <div class="product-price">$<?php echo "Precio: " . $producto['precio'] ?></div>
            <?php if ($producto['cantidad'] > 0) { ?>
                <div class="product-stock">Disponible</div>
            <?php } else { ?>
                <div class="product-stock2">No disponible</div>
            <?php } ?>
            <hr />
            <?php if ($seccion == TRUE) { ?>
                <?php if ($this->session->userdata['logged_in']['tipo'] == 'Comprador') { ?>
                    <!-- form para los botones de agregar al carrito de deseos o compras -->
                    <?php echo form_open('comprador/addCarritoDeseo2/' . $producto_id); ?>
                    <div class="btn-group cart">
                        <button type="submit" class="btn btn-success" id=" btn_carrito" name="btn_carrito" title="agregar al carrito" value="btn_carrito"><i class="fas fa-cart-plus"></i></button>
                    </div>
                    <div class="btn-group wishlist">
                        <button id=" btn_deseo" name="btn_deseo" type="submit" class="btn btn-danger" title="agregar a la lista de deseos" value="btn_deseo"><i class="fas fa-heart"></i></button>
                    </div>
                    <?php echo form_close(); ?>
                <?php } ?>
            <?php } ?>
        </div>


        <div class="col-md-16 product-info">
            <!-- form de tab -->
            <ul id="myTab" class="nav nav-tabs">

                <li class="nav-item me-2">
                    <a class="nav-link active" href="#service-one" data-toggle="tab">DESCRIPCION</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link" href="#service-two" data-toggle="tab">INFORMACIÓN TIENDA</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link" href="#service-three" data-toggle="tab">RESEÑAS Y CALIFICACIONES</a>
                </li>

            </ul>
            <div id="myTabContent" class="tab-content">
                <!-- form para mostrar la informacion del producto -->
                <div class="tab-pane container active" id="service-one" style="font-size: 18px;">
                    <div id="tableview2">
                        <section class="container product-info">
                            <h3>Detalle de producto: </h3>
                            <li>Nombre: <?php echo $producto['descripcion'] ?></li>
                            <li>fecha publicación: <?php echo $producto['fecha_publicacion'] ?></li>
                            <li>Ubicación física: <?php echo $producto['ubicacion_fisica'] ?></li>
                            <li>Precio: $<?php echo $producto['precio'] ?></li>
                            <li>Tiempo promedio de envío (horas): <?php echo $producto['tiempo_promedio'] ?></li>
                            <li>Costo de envío: <?php echo $producto['costo_envio'] ?></li>
                            <li>Cantidad disponible: <?php echo $producto['cantidad'] ?></li>
                            <li>Nombre de la tienda: <?php echo $producto['nombre_real'] ?></li>
                            <li>Categoría: <?php echo $producto['categorias'] ?></li>
                        </section>
                    </div>
                </div>
                <!-- form para mostrar la informacion de la tienda -->
                <div class="tab-pane container" id="service-two" style="font-size: 18px;">
                    <div id="tableview2">
                        <section class="container shop-info">
                            <br>
                            <br>
                            <img src='<?php echo site_url('/resources/photos/' . $producto['imagen']) ?>' width="200" alt="">
                            <br>
                            <li>Nombre tienda:<?php echo $producto['nombre_real'] ?></li>
                            <li>Teléfono:<?php echo $producto['telefono'] ?></li>
                            <li>Correo:<?php echo $producto['correo'] ?></li>
                            <li>País:<?php echo $producto['pais'] ?></li>
                            <li>Dirección: <?php echo $producto['direccion'] ?></li>
                            <?php echo form_open('tienda/perfiltienda/' . $producto['id_usuarios']); ?>
                            <button class="btn btn-primary" type="submit">Ver perfil tienda</button>
                            <?php echo form_close(); ?>
                        </section>
                    </div>
                </div>
                <div class="tab-pane container" id="service-three">
                    <!-- form para realizar el proceso de calificacion y comentario -->
                    <br><br>
                    <div id="tableview2">
                        <section class="container reviews-info">
                            <?php if ($seccion == TRUE) { ?>
                                <?php if ($this->session->userdata['logged_in']['tipo'] == 'Comprador') { ?>
                                    <div class="container d-flex">
                                        <div class="row">
                                            <?php if (!empty($calificaciones)) { ?>
                                                <?php foreach ($calificaciones as $cal) {
                                                ?>
                                                    <?php echo form_open('comprador/calificarProducto/' . $producto_id); ?>
                                                    <div class="col-md-12">
                                                        <div class="stars">
                                                            <div action="">
                                                                <input value="5" class="star star-5" id="star-5" type="radio" name="star" <?php if ($cal['calificacion'] == '5' && $cal['id_usuarios'] == $this->session->userdata['logged_in']['users_id'] && $cal['id_productos'] == $producto_id) { ?>checked='true' <?php } ?> /> <label class="star star-5" for="star-5"></label>
                                                                <input value="4" class="star star-4" id="star-4" type="radio" name="star" <?php if ($cal['calificacion'] == '4' && $cal['id_usuarios'] == $this->session->userdata['logged_in']['users_id'] && $cal['id_productos'] == $producto_id) { ?>checked='true' <?php } ?> /> <label class="star star-4" for="star-4"></label>
                                                                <input value="3" class="star star-3" id="star-3" type="radio" name="star" <?php if ($cal['calificacion'] == '3' && $cal['id_usuarios'] == $this->session->userdata['logged_in']['users_id'] && $cal['id_productos'] == $producto_id) { ?>checked='true' <?php } ?> /> <label class="star star-3" for="star-3"></label>
                                                                <input value="2" class="star star-2" id="star-2" type="radio" name="star" <?php if ($cal['calificacion'] == '2' && $cal['id_usuarios'] == $this->session->userdata['logged_in']['users_id'] && $cal['id_productos'] == $producto_id) { ?>checked='true' <?php } ?> /> <label class="star star-2" for="star-2"></label>
                                                                <input value="1" class="star star-1" id="star-1" type="radio" name="star" <?php if ($cal['calificacion'] == '1' && $cal['id_usuarios'] == $this->session->userdata['logged_in']['users_id'] && $cal['id_productos'] == $producto_id) { ?>checked='true' <?php } ?> /> <label class="star star-1" for="star-1"></label>
                                                                <!-- <button type="submit" name="btn_" id="btn_" class="btn btn-secondary me-2" title="Editar">Calificar</button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if ($cal['id_usuarios'] == $this->session->userdata['logged_in']['users_id'] && $cal['comentarios'] == '') { ?>
                                                        <div id="primero2">
                                                            <h2>Comentario</h2>
                                                            <label for="comentario">Ingrese su comentario: </label>
                                                            <input type="text" class="cajatexto3" id="txt_comentario" name="txt_comentario" maxlength="300" placeholder="Ingrese su comentario"><br>
                                                            <button class="btn btn-primary" type="submit" id="btn_rating1" name="btn_rating1" title="calificacion">Publicar</button>
                                                        </div>
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary" type="submit" id="btn_rating2" name="btn_rating2" title="calificacion">Publicar</button>
                                                    <?php } ?>

                                                    <?php echo form_close(); ?>
                                                <?php }
                                            } else { ?>
                                            <!-- form para las estrellas de las calificaciones -->
                                                <?php echo form_open('comprador/calificarProducto/' . $producto_id); ?>
                                                <div class="col-md-12">
                                                    <div class="stars">
                                                        <div action="">
                                                            <input value="5" class="star star-5" id="star-5" type="radio" name="star" /> <label class="star star-5" for="star-5"></label>
                                                            <input value="4" class="star star-4" id="star-4" type="radio" name="star" /> <label class="star star-4" for="star-4"></label>
                                                            <input value="3" class="star star-3" id="star-3" type="radio" name="star" /> <label class="star star-3" for="star-3"></label>
                                                            <input value="2" class="star star-2" id="star-2" type="radio" name="star" /> <label class="star star-2" for="star-2"></label>
                                                            <input value="1" class="star star-1" id="star-1" type="radio" name="star" /> <label class="star star-1" for="star-1"></label>
                                                            <!-- <button type="submit" name="btn_" id="btn_" class="btn btn-secondary me-2" title="Editar">Calificar</button> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="primero1">
                                                    <h2>Comentario</h2>
                                                    <label for="comentario">Ingrese su comentario: </label>
                                                    <input type="text" class="cajatexto3" id="txt_comentario" name="txt_comentario" maxlength="300" placeholder="Ingrese su comentario"><br>
                                                    <button class="btn btn-primary" type="submit" id="btn_rating1" name="btn_rating1" title="calificacion">Publicar</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                        </div>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <br><br><br><br><br>
                            <!-- form para la lista de comentarios -->
                            <div id="comentarios">
                                <h2>Lista Comentarios</h2>
                                <div class='post_block2'>
                                    <?php
                                    foreach ($calificaciones_table as $c) { ?>
                                        <?php if ($c['comentarios'] != '') { ?>
                                            <div id='content_post_<?php echo $c['id_usuarios']; ?>'>

                                                <div class='post_detail2'><?php echo $c['comentarios']; ?><br>
                                                    <?php if ($seccion == TRUE) { ?>
                                                        <?php if ($this->session->userdata['logged_in']['users_id'] == $producto['id_usuarios'] && $this->session->userdata['logged_in']['tipo'] == 'Tienda' && $c['respuetas'] == '') { ?>
                                                            <button class="btn btn-primary" data-toggle="collapse" data-target="#responder">Responder</button>
                                                            <?php echo form_open('comprador/respuestaComentarios/' . $producto_id . '/' . $c['id_usuarios']); ?>
                                                            <div class="collapse" id="responder">
                                                                <input type="text" name="txt_respuesta" id="txt_respuesta" maxlength="300" placeholder="Ingrese las respuesta al comentario" class="cajatexto3">
                                                                <button class="btn btn-primary" type="submit" title="calificacion">Enviar</button>
                                                            </div>
                                                            <?php echo form_close(); ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if ($c['respuetas'] != '') { ?>
                                                        <div class='post_detail'><?php echo $c['respuetas']; ?></div>
                                                    <?php } ?>
                                                </div><br>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>


                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <!-- <hr> -->
        </div>
        <hr>
        <br>
    </div>
</div>