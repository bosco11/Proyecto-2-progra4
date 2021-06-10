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
        <div style="float: left;">
            <!-- <center> -->
                <div>
                    <img id="item-display" src='<?php echo site_url('/resources/photos/' . $user['imagen']) ?>' class="d-block w-100" height="150px" width="150px" alt="">
                </div>
            <!-- </center> -->
        </div>
        <br>15
        <div class="col-md-7">

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

                <section class="container product-info">




            </div>
            <div class="tab-pane container" id="service-two" style="font-size: 18px;">

                <section class="container shop-info">

                </section>

            </div>
            <!-- <div class="tab-pane container" id="service-three">
                <section class="container reviews-info">

                </section>
            </div> -->
        </div>

    </div>
</div>