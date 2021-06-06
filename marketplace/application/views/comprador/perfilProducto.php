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
                        <div class="product-desc">The Corsair Gaming Series GS600 is the ideal price/performance choice for mid-spec gaming PC</div>
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
                        <div class="btn-group cart">
                            <button type="submit" class="btn btn-success" id="<?php echo $producto['id_productos'] ?>">🛒 agregar al carrito</button>
                        </div>
                        <div class="btn-group wishlist">
                            <button type="submit" class="btn btn-danger" id="<?php echo $producto['id_productos'] ?>">❤️ agregar a la lista de deseos</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" style=" color: black;">
                <div class="col-md-12 product-info">
                    <ul id="myTab" class="nav nav-tabs">

                        <li class="nav-item me-2">
                            <a class="nav-link active" href="#service-one" data-toggle="tab">DESCRIPTION</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#service-two" data-toggle="tab">PRODUCT INFO</a>
                        </li>
                        <!-- <li class="nav-item me-2">
                            <a class="nav-link" href="#service-three" data-toggle="tab">REVIEWS</a>
                        </li> -->

                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="service-one">

                            <section class="container product-info">
                                The Corsair Gaming Series GS600 power supply is the ideal price-performance solution for building or upgrading a Gaming PC. A single +12V rail provides up to 48A of reliable, continuous power for multi-core gaming PCs with multiple graphics cards. The ultra-quiet, dual ball-bearing fan automatically adjusts its speed according to temperature, so it will never intrude on your music and games. Blue LEDs bathe the transparent fan blades in a cool glow. Not feeling blue? You can turn off the lighting with the press of a button.

                                <h3>Corsair Gaming Series GS600 Features:</h3>
                                <li>It supports the latest ATX12V v2.3 standard and is backward compatible with ATX12V 2.2 and ATX12V 2.01 systems</li>
                                <li>An ultra-quiet 140mm double ball-bearing fan delivers great airflow at an very low noise level by varying fan speed in response to temperature</li>
                                <li>80Plus certified to deliver 80% efficiency or higher at normal load conditions (20% to 100% load)</li>
                                <li>0.99 Active Power Factor Correction provides clean and reliable power</li>
                                <li>Universal AC input from 90~264V — no more hassle of flipping that tiny red switch to select the voltage input!</li>
                                <li>Extra long fully-sleeved cables support full tower chassis</li>
                                <li>A three year warranty and lifetime access to Corsair’s legendary technical support and customer service</li>
                                <li>Over Current/Voltage/Power Protection, Under Voltage Protection and Short Circuit Protection provide complete component safety</li>
                                <li>Dimensions: 150mm(W) x 86mm(H) x 160mm(L)</li>
                                <li>MTBF: 100,000 hours</li>
                                <li>Safety Approvals: UL, CUL, CE, CB, FCC Class B, TÜV, CCC, C-tick</li>
                            </section>

                        </div>
                        <!-- <div class="tab-pane fade" id="service-two">

                            <section class="container">

                            </section>

                        </div>
                        <div class="tab-pane fade" id="service-three">

                        </div> -->
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>