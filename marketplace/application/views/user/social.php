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
       . $error_message.
       "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

if (validation_errors() !== "") {

    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>"
       . validation_errors().
       "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

?>

<div id="panel_app">
    <div class="box-header">
        <h2 class="box-title">Otras configuraciones del usuario</h2>
        <?php echo form_open('user/edit/' . $this->session->userdata['logged_in']['users_id']); ?>
        <button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Regresar">←</button>
        <?php echo form_close(); ?>
    </div>
    <br>
    <br>

    <div class="form-row">
        <div id="pago">
            <h2 id="user">Formas de pago</h2>
            <?php echo form_open('user/agregarmetodo'); ?>
            <div class="column" id="primero">
                <div class="col-md-4 mb-3">
                    <label for="validationServer013">Nombre del propietario</label>
                    <input type="text" name="txt_propietario" id="txt_propietario" placeholder="Nombre del propietario" class="cajatexto2" max="200"<?php if ($pagos2 != null) { ?>  value="<?php echo ($this->input->post('txt_propietario') ? $this->input->post('txt_propietario') : $pagos2['nombre_dueno']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Numero tarjeta</label>
                    <input type="number" name="txt_numero" id="txt_numero" placeholder="Numero tarjeta" class="cajatexto2" max="8" <?php if ($pagos2 != null) { ?> value="<?php echo ($this->input->post('txt_numero') ? $this->input->post('txt_numero') : $pagos2['numero_tarjeta']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">CVV</label><br>
                    <input type="number" name="txt_codigo" id="txt_codigo" placeholder="Codigo de seguridad" max="4" class="cajatexto2" <?php if ($pagos2 != null) { ?> value="<?php echo ($this->input->post('txt_codigo') ? $this->input->post('txt_codigo') : $pagos2['cvv']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Fecha vencimiento</label>
                    <input type="date" name="vencimiento" id="vencimiento" class="cajatexto2" <?php if ($pagos2 != null) { ?> value="<?php echo ($this->input->post('vencimiento') ? $this->input->post('vencimiento') : $pagos2['fecha_vencimiento']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Saldo tarjeta</label>
                    <input type="number" name="txt_saldo" id="txt_saldo" placeholder="Saldo tarjeta" class="cajatexto2" <?php if ($pagos2 != null) { ?> value="<?php echo ($this->input->post('txt_saldo') ? $this->input->post('txt_saldo') : $pagos2['saldo']); ?>" <?php } ?> required>

                </div>

                <?php if ($pagos2 == null) { ?> <button class="btn btn-primary" name="btn_save" id="btn_save" type="submit">Agregar metodo pago</button> <?php } else { ?>
                    <button class="btn btn-primary" name="btn_edit" id="btn_edit" value="<?php echo ($this->input->post('btn_edit') ? $this->input->post('btn_edit') : $pagos2['id_formas_pago']); ?>" type="submit">Actualizar metodo pago</button><?php } ?>
            </div>
            <?php echo form_close(); ?>
            <div class="column" id="segundo">
                <div id="tableview1">
                    <table class="table table-striped table-dark" id="table">
                        <thead>
                            <tr align="center">
                                <td>Propietario </td>
                                <td>Numero tarjeta</td>
                                <td>Fecha vencimiento</td>
                                <td>Saldo</td>
                                <td>Acciones</td>

                            </tr>
                        </thead>
                        <tbody id="tbTable">
                            <?php
                            foreach ($pagos as $pa) { ?>
                                <?php echo form_open('user/mantmetodo/' . $pa['id_formas_pago']); ?>
                                <tr align="center">
                                    <td><?php echo $pa['nombre_dueno'] ?></td>
                                    <td><?php echo $pa['numero_tarjeta'] ?></td>
                                    <td><?php echo $pa['fecha_vencimiento'] ?></td>
                                    <td><?php echo $pa['saldo'] ?></td>
                                    <td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar">Eliminar</button> </td>
                                </tr>
                                <?php echo form_close(); ?>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div id="direcciones">
        <h2 id="user">Direcciones de envio</h2>
        <div class="form-row">
            <?php echo form_open('user/agregarDireccion'); ?>
            <div class="column" id="primero">
                <div class="col-md-4 mb-3">
                    <label for="validationServer013">Pais</label>
                    <input type="text" name="txt_pais" id="txt_pais" placeholder="Pais" class="cajatexto2" max="200" <?php if ($direcciones2 != null) { ?> value="<?php echo ($this->input->post('txt_pais') ? $this->input->post('txt_pais') : $direcciones2['pais_direccion']); ?>" <?php } ?> required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Provincia</label>
                    <input type="text" name="txt_provincia" id="txt_provincia" placeholder="Provincia" class="cajatexto2" max="200" <?php if ($direcciones2 != null) { ?> value="<?php echo ($this->input->post('txt_provincia') ? $this->input->post('txt_provincia') : $direcciones2['provincia']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Numero Casillero</label><br>
                    <input type="text" name="txt_casillero" id="txt_casillero" placeholder="Numero de casillero" class="cajatexto2" max="200" <?php if ($direcciones2 != null) { ?> value="<?php echo ($this->input->post('txt_casillero') ? $this->input->post('txt_casillero') : $direcciones2['numero_casillero']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Codigo postal</label>
                    <input type="text" name="txt_postal" id="txt_postal" placeholder="Codigo postal" class="cajatexto2" max="100" <?php if ($direcciones2 != null) { ?> value="<?php echo ($this->input->post('txt_postal') ? $this->input->post('txt_postal') : $direcciones2['codigo_postal']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Observaciones</label>
                    <input type="text" name="txt_observaciones" id="txt_observaciones" placeholder="observaciones" class="cajatexto2" max="300" <?php if ($direcciones2 != null) { ?> value="<?php echo ($this->input->post('txt_observaciones') ? $this->input->post('txt_observaciones') : $direcciones2['observaciones']); ?>" <?php } ?>required>

                </div>
                <?php if ($direcciones2 == null) { ?> <button class="btn btn-primary" name="btn_save" id="btn_save" type="submit">Agregar dirección</button> <?php } else { ?>
                    <button class="btn btn-primary" name="btn_edit" id="btn_edit" type="submit" value="<?php echo ($this->input->post('btn_edit') ? $this->input->post('btn_edit') : $direcciones2['id_direcciones']); ?>">Actualizar dirección</button><?php } ?>

            </div>
            <?php echo form_close(); ?>
            <div class="column" id="segundo">
                <div id="tableview2">
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
                </div>
            </div>

        </div>
    </div>
    <br>
    <br>
    <div id="Redes">
        <h2 id="user">Redes sociales</h2>
        <div class="form-row">
            <?php echo form_open('user/agregarRed'); ?>
            <div class="column" id="primero">
                <div class="col-md-4 mb-3">
                    <label for="validationServer013">Nombre red social</label>
                    <input type="text" name="txt_red" id="txt_red" placeholder="Red social" class="cajatexto2" max="64" <?php if ($social2 != null) { ?> value="<?php echo ($this->input->post('txt_red') ? $this->input->post('txt_red') : $social2['red_social']); ?>" <?php } ?> required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Nombre del usuario</label>
                    <input type="text" name="txt_usuario" id="txt_usuario" placeholder="Nombre del usuario" class="cajatexto2" max="150" <?php if ($social2 != null) { ?> value="<?php echo ($this->input->post('txt_usuario') ? $this->input->post('txt_usuario') : $social2['nombre_usuario']); ?>" <?php } ?> required>

                </div>

                <!-- <button class="btn btn-primary" type="submit">Agregar red social</button> -->
                <?php if ($social2 == null) { ?> <button class="btn btn-primary" name="btn_save" id="btn_save" type="submit">Agregar red social</button> <?php } else { ?>
                    <button class="btn btn-primary" name="btn_edit" id="btn_edit" type="submit" value="<?php echo ($this->input->post('btn_edit') ? $this->input->post('btn_edit') : $social2['id_redes_sociales']); ?>">Actualizar red social</button><?php } ?>
            </div>
            <?php echo form_close(); ?>
            <div class="column" id="segundo">
                <div id="tableview3">
                    <table class="table table-striped table-dark" id="table">
                        <thead>
                            <tr align="center">
                                <td>Red </td>
                                <td>Nombre usuario</td>
                                <td>Acciones</td>

                            </tr>
                        </thead>
                        <tbody id="tbTable">
                            <?php foreach ($social as $pro) { ?>
                                <?php echo form_open('user/mantRed/' . $pro['id_redes_sociales']); ?>
                                <tr align="center">
                                    <td><?php echo $pro['red_social'] ?></td>
                                    <td><?php echo $pro['nombre_usuario'] ?></td>

                                    <td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar">Eliminar</button> </td>
                                </tr>
                                <?php echo form_close(); ?>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>