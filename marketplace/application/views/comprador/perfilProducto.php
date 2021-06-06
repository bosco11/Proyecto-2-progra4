<?php

if (isset($logout_message)) {

    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>"
        . $logout_message .
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
if ($message_display != null) {
    if (isset($message_display)) {

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>"
            . $message_display .
            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
}

if (isset($error_message)) {

    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>"
        . $error_message .
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

if (validation_errors() !== "") {

    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>"
        . validation_errors() .
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

?>
<div id="panel_app">
    <div class="box-header">
        <h2 class="box-title">Informacion del producto</h2>
        <?php echo form_open('comprador/compradorHome'); ?>
        <button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Regresar">←</button>
        <?php echo form_close(); ?>
    </div>
    <div class="container-fluid" style="color: black;">
        <div class="content-wrapper">
            <div class="item-container">
                <div class="container">
                    <div class="col-md-12">
                        <div class="product col-md-3 service-image-left">

                            <center>

                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
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
                                                    <img id="item-display" src='<?php echo site_url('/resources/files/' . $g['imagen_producto']) ?>' class="d-block w-100" height="300px" width="600px" alt="...">
                                                </div>

                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <label for=""><?php echo $producto['descripcion'] ?></label>

                                </div>
                            </center>
                        </div>

                        <!-- <div class="container service1-items col-sm-2 col-md-2 pull-left">
						<center>
							<a id="item-1" class="service1-item">
								<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img>
							</a>
							<a id="item-2" class="service1-item">
								<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img>
							</a>
							<a id="item-3" class="service1-item">
								<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img>
							</a>
						</center>
					</div> -->
                    </div>

                    <div class="col-md-7">
                        <div class="product-title"><?php echo $producto['descripcion'] ?></div>

                        <div class="product-rating">
                            <i class="fa fa-star gold"></i>
                            <i class="fa fa-star gold"></i>
                            <i class="fa fa-star gold"></i>
                            <i class="fa fa-star gold"></i>
                            <i class="fa fa-star gold"></i>
                        </div>
                        <hr>
                        <div class="product-price">₡<?php echo $producto['precio'] ?></div>
                        <?php if ($producto['cantidad'] > 0) { ?>
                            <div class="product-stock">En Stock</div>
                        <?php } else { ?>
                            <div class="product-stock2">Sin Stock</div>
                        <?php } ?>
                        <hr>
                        <?php if ($seccion == TRUE) { ?>
                            <div class="btn-group cart">
                                <button type="submit" class="btn btn-success" id="<?php echo $producto['id_productos'] ?>">🛒 agregar al carrito</button>
                            </div>
                            <div class="btn-group wishlist">
                                <button type="submit" class="btn btn-danger" id="<?php echo $producto['id_productos'] ?>">❤️ agregar a la lista de deseos</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid" style=" color: black;">
                <div class="col-md-12 product-info">
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
                        <div class="tab-pane fade in active" id="service-one" style="font-size: 18px;">

                            <section class="container product-info">


                                <h3><?php echo $producto['descripcion'] ?> detalle de producto: </h3>
                                <li>Nombre: <?php echo $producto['descripcion'] ?></li>
                                <li>fecha publicación: <?php echo $producto['fecha_publicacion'] ?></li>
                                <li>Ubicación física: <?php echo $producto['ubicacion_fisica'] ?></li>
                                <li>Precio: ₡<?php echo $producto['precio'] ?></li>
                                <li>Tiempo promedio de envío (horas): <?php echo $producto['tiempo_promedio'] ?></li>
                                <li>Costo de envío: <?php echo $producto['costo_envio'] ?></li>
                                <li>Cantidad en stock: <?php echo $producto['cantidad'] ?></li>
                                <li>Nombre de la tienda: <?php echo $producto['nombre_real'] ?></li>
                                <li>Categoría: <?php echo $producto['categorias'] ?></li>

                        </div>
                        <div class="tab-pane fade" id="service-two" style="font-size: 18px;">

                            <section class="container shop-info">
                                <br>
                                <br>
                                <img src='<?php echo site_url('/resources/photos/' . $producto['imagen']) ?>' width="200" alt="">
                                <h3> Información de tienda: </h3>
                                <li>Nombre tienda:<?php echo $producto['nombre_real'] ?></li>
                                <li>Teléfono:<?php echo $producto['telefono'] ?></li>
                                <li>Correo:<?php echo $producto['correo'] ?></li>
                                <li>País:<?php echo $producto['pais'] ?></li>
                                <li>Dirección: <?php echo $producto['direccion'] ?></li>

                            </section>

                        </div>
                        <div class="tab-pane fade" id="service-three">
                            <section class="container reviews-info">
                                <div class="container d-flex justify-content-center mt-200">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="stars">
                                                <form action="">
                                                    <input class="star star-5" id="star-5" type="radio" name="star" /> <label class="star star-5" for="star-5"></label>
                                                    <input class="star star-4" id="star-4" type="radio" name="star" /> <label class="star star-4" for="star-4"></label>
                                                    <input class="star star-3" id="star-3" type="radio" name="star" /> <label class="star star-3" for="star-3"></label>
                                                    <input class="star star-2" id="star-2" type="radio" name="star" /> <label class="star star-2" for="star-2"></label>
                                                    <input class="star star-1" id="star-1" type="radio" name="star" /> <label class="star star-1" for="star-1"></label>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>