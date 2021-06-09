<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>
    <div id="panel_app">
        <div class="box-header">
            <h2 class="box-title">Lista de suscriptores</h2>
            <?php echo form_open('tienda/tiendaHome') ?>
                <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
            <?php echo form_close() ?>
        </div>
        <div id="main_panel">
            <div class="row align-items">
                <?php foreach ($suscriptores as $suscriptor) { ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card">
                            <div class="view overlay">
                                <img src='<?php echo site_url('/resources/photos/' . $suscriptor['imagen']) ?>' height="200" class="d-block w-100" alt="...">
                            </div>
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>

                            <div class="card-body text-center">
                                <h4 class="font-weight-bold black-text" style="color: black;"><?php echo $suscriptor['nombre_real'] ?></h4>
                                <?php echo form_open('user/edit/' . $suscriptor['id_usuarios']) ?>
                                    <button type="submit" class="btn btn-primary">Ver perfil</button>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
} else {
    header("location: " . base_url());
}
?>