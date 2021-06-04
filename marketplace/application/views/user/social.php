<?php
if (isset($logout_message)) {
    echo "<div class='login_msg_box success'>" . $logout_message . "</div>";
}

if (isset($message_display)) {
    echo "<div class='login_msg_box success' >" . $message_display . "</div>";
}

if (isset($error_message)) {
    echo "<div class='login_msg_box warning'>" . $error_message . "</div>";
}

if (validation_errors() !== "") {
    echo "<div class='login_msg_box warning'>" . validation_errors() . "</div>";
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
                    <input type="text" name="txt_propietario" id="txt_propietario" placeholder="Nombre del propietario" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Numero tarjeta</label>
                    <input type="number" name="txt_numero" id="txt_numero" placeholder="Numero tarjeta" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">CVV</label><br>
                    <input type="number" name="txt_codigo" id="txt_codigo" placeholder="Codigo de seguridad" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Fecha vencimiento</label>
                    <input type="date" name="vencimiento" id="vencimiento" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Saldo tarjeta</label>
                    <input type="number" name="txt_saldo" id="txt_saldo" placeholder="Saldo tarjeta" class="cajatexto2" required>

                </div>

                <button class="btn btn-primary" type="submit">Agregar metodo pago</button>
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
								<td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar" >Eliminar</button> </td>
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
                    <input type="text" name="txt_pais" id="txt_pais" placeholder="Pais" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Provincia</label>
                    <input type="number" name="txt_provincia" id="txt_provincia" placeholder="Provincia" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Numero Casillero</label><br>
                    <input type="text" name="txt_casillero" id="txt_casillero" placeholder="Numero de casillero" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Codigo postal</label>
                    <input type="number" name="txt_postal" id="txt_postal" placeholder="Codigo postal" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Observaciones</label>
                    <input type="number" name="txt_observaciones" id="txt_observaciones" placeholder="observaciones" class="cajatexto2" required>

                </div>

                <button class="btn btn-primary" type="submit">Agregar dirección</button>
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
							<!-- <?php echo form_open('tienda/mantPro/' . $pro['id_productos']); ?> -->
							<tr align="center">
                            <td><?php echo $pro['pais_direccion'] ?></td>
								<td><?php echo $pro['provincia'] ?></td>
								<td><?php echo $pro['numero_casillero'] ?></td>
								<td><?php echo $pro['codigo_postal'] ?></td>
								<td><?php echo $pro['observaciones'] ?></td>	
								<td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar" >Eliminar</button> </td>
							</tr>
							<!-- <?php echo form_close(); ?> -->
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
                    <input type="text" name="txt_red" id="txt_red" placeholder="Red social" class="cajatexto2" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer023">Nombre del usuario</label>
                    <input type="number" name="txt_usuario" id="txt_usuario" placeholder="Nombre del usuario" class="cajatexto2" required>

                </div>

                <button class="btn btn-primary" type="submit">Agregar red social</button>
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
							<!-- <?php echo form_open('tienda/mantPro/' . $pro['id_productos']); ?> -->
							<tr align="center">
								<td><?php echo $pro['red_social'] ?></td>
								<td><?php echo $pro['nombre_usuario'] ?></td>
								
								<td> <button type="submit" name="btn_editar" id="btn_editar" class="btn btn-secondary btn-sm me-2" title="Editar">Editar</button> <button type="submit" name="btn_elim" id="btn_elim" class="btn btn-danger btn-sm" title="Eliminar" >Eliminar</button> </td>
							</tr>
							<!-- <?php echo form_close(); ?> -->
						<?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>