<?php
if (isset($logout_message)) {

    echo "<div class='alert alert-success alert-dismissible fade show' role='alert' style='font-size: 20px;'>"
        . $logout_message .
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

if (isset($message_display)) {

    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'style='font-size: 20px;'>"
        . $message_display .
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

if (isset($error_message)) {

    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'style='font-size: 20px;'>"
        . $error_message .
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
?>
<div id="panel_app" style=" align-items: center;">
    <div class="box-header">
        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <div class="container-fluid">
                <?php
                if (isset($this->session->userdata['logged_in']) and $this->session->userdata['logged_in']['tipo'] == 'Tienda') { ?>
                    <?php echo form_open('tienda/tiendaHome'); ?>
                    <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
                    <?php echo form_close(); ?>
                <?php  } else { ?>
                    <?php echo form_open('comprador/compradorHome'); ?>
                    <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar"><i class="fas fa-arrow-left"></i></button>
                    <?php echo form_close(); ?>
                <?php } ?>
                <?php if (isset($this->session->userdata['logged_in']) and $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) {
                    $suscribir = "Suscribirse";
                    $icon = "<i class='fas fa-plus'></i> ";
                    if ($suscrito) {
                        $icon = "<i class='fas fa-times'></i> ";
                        $suscribir = "Desuscribirse";
                    } ?>
                    <?php echo form_open('tienda/suscribirseTienda/' . $tienda['id_usuarios']) ?>
                    <button type="submit" name="btn_suscripcion" id="btn_suscripcion" class="btn btn-primary me-2" value="<?php echo $suscribir ?>" title="Suscripcion"><?php echo $icon . $suscribir ?></button>
                    <?php echo form_close(); ?>
                    <?php
                    $abuso = "Denunciar";
                    $icon = "<i class='fas fa-times'></i> ";
                    if ($denuncia) {
                        $icon = "<i class='fas fa-lock'></i> ";
                        $abuso = "Denunciada";
                    } ?>
                    <?php echo form_open('tienda/denunciarTienda/' . $tienda['id_usuarios']) ?>
                    <button type="submit" name="btn_suscripcion" id="btn_suscripcion" class="btn btn-danger me-2" value="denunciar" title="Denuncia"> <?php echo $icon . $abuso ?></button>
                    <?php echo form_close(); ?>
                <?php } ?>
            </div>
        </nav>
    </div>
    <h2 style="text-align: center;" class="box-title">Informacion de la tienda</h2>
    <div class="container-fluid" style=" align-items: center;">
        <center>
            <div class="col-md-5">
                <img id="item-display" src='<?php echo site_url('/resources/photos/' . $tienda['imagen']) ?>' class="d-block w-100" height="300px" width="600px" alt="...">
            </div>
        </center>
        <hr>
        <h4>Nombre de la tienda</h4>
        <div class="product-title"><?php echo $tienda['nombre_real'] ?></div>
        <hr>
        <h4>Calificacion de la tienda</h4>
        <div class="product-rating">
            <?php if ($calificacion >= 1) { ?>
                <i class="fa fa-star gold"></i>
            <?php  } else { ?>
                <i class="fa fa-star"></i>
            <?php  } ?>
            <?php if ($calificacion >= 2) { ?>
                <i class="fa fa-star gold"></i>
            <?php  } else { ?>
                <i class="fa fa-star"></i>
            <?php  } ?>
            <?php if ($calificacion >= 3) { ?>
                <i class="fa fa-star gold"></i>
            <?php  } else { ?>
                <i class="fa fa-star"></i>
            <?php  } ?>
            <?php if ($calificacion >= 4) { ?>
                <i class="fa fa-star gold"></i>
            <?php  } else { ?>
                <i class="fa fa-star"></i>
            <?php  } ?>
            <?php if ($calificacion >= 5) { ?>
                <i class="fa fa-star gold"></i>
            <?php  } else { ?>
                <i class="fa fa-star"></i>
            <?php  } ?>
        </div>
        <hr>
        <div class="col-md-16 product-info">
            <ul id="myTab" class="nav nav-tabs">

                <li class="nav-item me-2">
                    <a class="nav-link active" href="#service-one" data-toggle="tab">PRODUCTOS</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link" href="#service-two" data-toggle="tab">INFORMACIÓN TIENDA</a>
                </li>
                <?php if (isset($this->session->userdata['logged_in']) and $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) { ?>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="#service-three" data-toggle="tab">CALIFICACIONES</a>
                    </li>
                <?php } ?>

            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane container active" id="service-one" style="font-size: 18px;">
                    <div id="tableview2">
                        <section class="container product-info">
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                                <div class="container-fluid">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <?php echo form_open('tienda/buscarProductos/' . $tienda['id_usuarios'].'/1', "class=\"d-flex\"") ?>
                                        <select name="cmb_categoria" id="cmb_categoria" variant="primary" aria-label=".form-select-sm example" class="form-select form-select-sm me-2">
                                            <option selected>Seleccionar categoría</option>
                                            <?php foreach ($categorias as $cate) { ?>
                                                <option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
                                            <?php } ?>
                                        </select>

                                        <input class="form-control form-sm me-2" type="search" id="txt_buscar" name="txt_buscar" placeholder="Descripcion" aria-label="Descripcion">
                                        <button class="btn  btn-secondary  me-2" type="submit" title="Buscar"><i class="fas fa-search"></i> Buscar</button>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </nav>
                            <br>
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
                                            <td>Acciones</td>
                                        </tr>
                                    </thead>
                                    <tbody id="tbTable">
                                        <?php foreach ($productos as $pro) { ?>
                                            <tr align="center">
                                                <td><?php echo $pro['descripcion'] ?></td>
                                                <td><?php echo $pro['cantidad'] ?></td>
                                                <td><?php echo $pro['costo_envio'] ?></td>
                                                <td><?php echo $pro['precio'] ?></td>
                                                <td><?php echo $pro['fecha_publicacion'] ?></td>
                                                <td><?php echo $pro['categorias'] ?></td>
                                                <td><?php echo $pro['tiempo_promedio'] ?></td>
                                                <td><?php echo $pro['ubicacion_fisica'] ?></td>

                                                <?php if (isset($this->session->userdata['logged_in']) and $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) { ?>
                                                    <td> <?php echo form_open('comprador/perfilProducto/' . $pro['id_productos']); ?><button type="submit" name="btn_perfil" id="btn_perfil" class="btn btn-secondary btn-sm me-2" style="float: left;" title="Perfil"><i class="fas fa-user"></i></button> <?php echo form_close(); ?> <?php echo form_open('comprador/addCarritoDeseo/' . $pro['id_productos']); ?> <button type="submit" style="float: left;" name="btn_carrito" id="btn_carrito" value="btn_carrito" class="btn btn-secondary btn-sm me-2" title="Carrito"><i class="fas fa-cart-plus"></i></button> <button type="submit" style="float: left;" value="btn_deseo" name="btn_deseo" id="btn_deseo" class="btn btn-danger btn-sm" title="Deseo"><i class="fas fa-heart"></i></button><?php echo form_close(); ?> </td>
                                                <?php } else { ?>
                                                    <td> <?php echo form_open('comprador/perfilProducto/' . $pro['id_productos']); ?><button type="submit" name="btn_perfil" id="btn_perfil" class="btn btn-secondary btn-sm me-2" title="Perfil"><i class="fas fa-user"></i></button> <?php echo form_close(); ?> </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>

                            </div>
                        </section>
                    </div>
                </div>
                <div class="tab-pane container" id="service-two" style="font-size: 18px;">
                    <div id="tableview2">
                        <section class="container shop-info">
                            <br>
                            <br>
                            <img src='<?php echo site_url('/resources/photos/' . $tienda['imagen']) ?>' width="200" alt="">
                            <br>
                            <li>Nombre tienda:<?php echo $tienda['nombre_real'] ?></li>
                            <li>Teléfono:<?php echo $tienda['telefono'] ?></li>
                            <li>Correo:<?php echo $tienda['correo'] ?></li>
                            <li>País:<?php echo $tienda['pais'] ?></li>
                            <li>Dirección: <?php echo $tienda['direccion'] ?></li>

                        </section>
                    </div>
                </div>
                <?php if (isset($this->session->userdata['logged_in']) and $this->session->userdata['logged_in']['users_id'] != $tienda['id_usuarios']) { ?>
                    <div class="tab-pane container" id="service-three">
                        <br><br>
                        <div id="tableview2">
                            <section class="container reviews-info">
                                <div class="container d-flex">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="stars">
                                                <?php echo form_open('tienda/calificarPro/' . $tienda['id_usuarios']) ?>

                                                <div action="">
                                                    <?php if ($calificacionComprador['calificacion'] == 5) { ?>
                                                        <input checked="checked" value="5" class="star star-5" id="star-5" type="radio" name="star" /> <label class="star star-5" for="star-5"></label>
                                                    <?php  } else { ?>
                                                        <input value="5" class="star star-5" id="star-5" type="radio" name="star" /> <label class="star star-5" for="star-5"></label>
                                                    <?php  } ?>
                                                    <?php if ($calificacionComprador['calificacion'] == 4) { ?>
                                                        <input checked="checked" value="4" class="star star-4" id="star-4" type="radio" name="star" /> <label class="star star-4" for="star-4"></label>
                                                    <?php  } else { ?>
                                                        <input value="4" class="star star-4" id="star-4" type="radio" name="star" /> <label class="star star-4" for="star-4"></label>
                                                    <?php  } ?>
                                                    <?php if ($calificacionComprador['calificacion'] == 3) { ?>
                                                        <input checked="checked" value="3" class="star star-3" id="star-3" type="radio" name="star" /> <label class="star star-3" for="star-3"></label>
                                                    <?php  } else { ?>
                                                        <input value="3" class="star star-3" id="star-3" type="radio" name="star" /> <label class="star star-3" for="star-3"></label>
                                                    <?php  } ?>
                                                    <?php if ($calificacionComprador['calificacion'] == 2) { ?>
                                                        <input checked="checked" value="2" class="star star-2" id="star-2" type="radio" name="star" /> <label class="star star-2" for="star-2"></label>
                                                    <?php  } else { ?>
                                                        <input value="2" class="star star-2" id="star-2" type="radio" name="star" /> <label class="star star-2" for="star-2"></label>
                                                    <?php  } ?>
                                                    <?php if ($calificacionComprador['calificacion'] == 1) { ?>
                                                        <input checked="checked" value="1" class="star star-1" id="star-1" type="radio" name="star" /> <label class="star star-1" for="star-1"></label>
                                                    <?php  } else { ?>
                                                        <input value="1" class="star star-1" id="star-1" type="radio" name="star" /> <label class="star star-1" for="star-1"></label>
                                                    <?php  } ?>
                                                    <button type="submit" name="btn_" id="btn_" class="btn btn-secondary me-2" title="Editar"><i class="fas fa-star"></i> Calificar</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <hr>
        </div>
    </div>
</div>