<?php if ($val) {
	$precio = 0;
	$cobro_envio = 0;
	$botonDisable = '';
	$funcionBoton = '';
	$boni = '';
?>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark white scrolling-navbar" id="nav-comprador" style="background-color: black;">
		<div class="container">

			<!-- Brand -->
			<a class="navbar-brand waves-effect" href="#">
				<strong class="blue-text"><img src="<?php echo site_url('resources/img/tienda.png'); ?>" alt="Marktplace" width="50" height="50"></strong>
			</a>

			<!-- Collapse -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>



			<!-- Links -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">

				<!-- Left -->
				<ul class="navbar-nav mr-auto" id="ul1">
					<li class="nav-item active">
						<a class="nav-link waves-effect" href="#">Inicio
							<span class="sr-only">(current)</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link waves-effect" href="<?php echo site_url('tienda/getTiendasProductos'); ?>">Reporte Ofertas
						</a>
					</li>
					<?php if ($seccion == TRUE) { ?>
						<li class="nav-item">
							<a class="nav-link waves-effect" data-bs-toggle="modal" data-bs-target="#compras" href="#">Historial compras
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect" href="<?php echo site_url('comprador/ruleta'); ?>">Ruleta de la suerte
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/compras/' . $this->session->userdata['logged_in']['users_id']); ?>">Reporte Compras
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/suscripciones/' . $this->session->userdata['logged_in']['users_id']); ?>">Reporte suscripciones
							</a>
						</li>
					<?php } ?>
				</ul>

				<!-- Right -->
				<ul class="navbar-nav nav-flex-icons ml_auto">
					<?php if ($seccion == TRUE) { ?>
						<li class="nav-item">
							<!--  trae las lista de deseos del usuario que esta logueado-->
							<div class="dropdown">
								<button type="button" class="btn btn-danger" data-toggle="dropdown">
									<i class="fa fa-heart" aria-hidden="true">
									</i>
									Lista de Deseos
									<?php if (!empty($Deseo)) { ?>
										<?php $cont = 0;
										$precio = 0; ?>
										<?php foreach ($Deseo as $des) {
											foreach ($pro as $p) {
												if ($des['id_productos'] == $p['id_productos']) {
													$cont += 1;
												} ?>
											<?php } ?>
										<?php } ?>
										<span class="badge badge-pill badge-info"><?php echo $cont ?></span>
									<?php } else {
										$cont = 0;
										$precio = 0;
									} ?>
								</button>
								<div class="dropdown-menu ">
									<div class="row total-header-section">
										<div class="col-lg-6 col-sm-6 col-6">
											<i class="fa fa-heart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger"><?php echo $cont ?></span>
										</div>
									</div>
									<div style="overflow: scroll;width: 325px; height: 300px;">
										<?php if (!empty($Deseo)) { ?>
											<?php foreach ($Deseo as $des) { ?>
												<div class="row cart-detail">
													<?php foreach ($pro as $p) { ?>
														<?php if ($des['id_productos'] == $p['id_productos']) { ?>
															<?php $band = true;
															foreach ($galerias as $g) { ?>
																<?php if ($p['id_productos'] == $g['id_productos'] && $band) { ?>
																	<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
																		<img width="50px" height="50px" src='<?php echo site_url('/resources/files/' . $g['imagen_producto']) ?>'>
																	</div>
																<?php $band = false;
																} ?>
															<?php } ?>
															<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
																<p><?php echo $p['descripcion'] ?>.</p>
																<span class="price text-info" style="display: inline-block;">
																	$<?php echo $p['precio'] ?></span> <span class="count">
																	<?php echo form_open('comprador/process/' . $p['id_productos']); ?>
																	<button type="submit" id=" btn_eliminar_deseo" name="btn_eliminar_deseo" value="btn_eliminar_deseo" class="btn btn-danger pull-right btn-sm" style="display: inline-block;"><i class="fas fa-trash-alt"></i></button>
																	<?php echo form_close(); ?>
																	<?php echo form_open('comprador/perfilProducto/' . $p['id_productos']); ?><button type="submit" name="btn_perfil" id="btn_perfil" class="btn btn-secondary pull-right btn-sm me-2" title="Perfil"><i class="fas fa-user"></i></button> <?php echo form_close(); ?>
																</span>
															</div>
															<hr>
														<?php } ?>
													<?php } ?>
												</div>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<!--  trae las lista de carrito del usuario que esta logueado-->
							<div class="dropdown">
								<button type="button" class="btn btn-info" data-toggle="dropdown">
									<i class="fa fa-shopping-cart" aria-hidden="true">
									</i>
									Carrito
									<?php if (!empty($carrito)) { ?>
										<?php $cont = 0; ?>
										<?php foreach ($carrito as $car) {
											foreach ($pro as $p) {
												if ($car['id_productos'] == $p['id_productos']) {
													if ($p['cantidad'] > 0) {
														$cont += 1;
														$precio += $p['precio'] * $car['cantidad'];
													}
												} ?>
											<?php } ?>
										<?php } ?>
										<?php if ($cont > 0) { ?>
											<span class="badge badge-pill badge-danger"><?php echo $cont ?></span>
									<?php }
									} else {
										$cont = 0;
										$precio = 0;
									} ?>
								</button>
								<div class="dropdown-menu " style="margin-right: 1000%">
									<?php $botonDisable = 'disabled'; ?>
									<div class="row total-header-section">
										<div class="col-lg-6 col-sm-6 col-6">
											<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger"><?php echo $cont ?></span>
										</div>
										<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
											<p>Total: <span class="text-info">$<?php echo $precio ?></span></p>
										</div>
									</div>
									<div style="overflow: scroll;width: 325px; height: 300px;">
										<?php if (!empty($carrito)) {
											$botonDisable = '';
											$funcionBoton = 'data-bs-target="#staticBackdrop"'; ?>
											<?php foreach ($carrito as $car) { ?>
												<div class="row cart-detail">
													<?php foreach ($pro as $p) { ?>
														<?php if ($car['id_productos'] == $p['id_productos']) { ?>
															<?php if ($p['cantidad'] > 0) { ?>
																<?php $band = true;
																$cobro_envio = $cobro_envio + $p['costo_envio'];
																foreach ($galerias as $g) { ?>
																	<?php if ($p['id_productos'] == $g['id_productos'] && $band) { ?>
																		<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
																			<img width="50px" height="50px" src='<?php echo site_url('/resources/files/' . $g['imagen_producto']) ?>'>
																		</div>
																	<?php $band = false;
																	} ?>
																<?php } ?>
																<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
																	<p><?php echo $p['descripcion'] ?>.</p>
																	<span class="price text-info" style="display: inline-block;">
																		$<?php echo $p['precio'] ?></span> <span class="count">
																		<?php echo form_open('comprador/process/' . $p['id_productos']); ?>
																		<button type="submit" id="btn_menos" name="btn_menos" value="btn_menos" class="btn btn-primary btn-sm" style="display: inline-block;"><i class="fa fa-minus"></i></button>
																		<input type="text" class="form-control  text-center" value='<?php echo $car['cantidad'] ?>' disabled style="display: inline-block;width:40px ;height:30px; font-size: 10px;">
																		<button type="submit" id="btn_mas" name="btn_mas" value="btn_mas" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
																		<button type="submit" id=" btn_eliminar_carrito" name="btn_eliminar_carrito" value="btn_eliminar_carrito" class="btn btn-danger pull-right btn-sm" style="display: inline-block;"><i class="fas fa-trash-alt"></i></button>
																		<?php echo form_close(); ?>
																	</span>

																</div>
																<hr>
															<?php } ?>
														<?php } ?>
													<?php } ?>
												</div>
											<?php } ?>
										<?php
										} ?>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12 text-center checkout" data-bs-toggle="modal" <?php echo $funcionBoton ?>>
											<button class="btn btn-primary btn-block" <?php echo $botonDisable ?>>Realizar pago</button>
										</div>
									</div>

								</div>
							</div>
						</li>

						<li class="nav-item dropdown notifications-nav">
							<!--  trae las lista de notificaciones del usuario que esta logueado, de los cambios de los productos de la lista de deseos-->
							<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink151" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<span class="badge badge-pill bg-danger"><?php echo count($notificaciones) ?></span>
								<span><i class="fas fa-bell" style="font-size: 27px; margin-top: 5px;"></i></span>
							</a>
							<div style="overflow: auto; max-height: 400px;  padding-left: 5px;" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink151">
								<?php foreach ($notificaciones as $notificacion) { ?>
									<a class="dropdown-item" href="<?php echo site_url('/tienda/ocultarNotificacion/' . $notificacion['id_notificaciones'] . "/" . $notificacion['id_productos']) ?>">
										<i class="far fa-bell mr-2" aria-hidden="true"></i>
										<span> <?php echo $notificacion['descripcion'] ?> </span>
									</a>
									<hr>
								<?php } ?>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src='<?php echo site_url('/resources/photos/' . $this->session->userdata['logged_in']['imagen']) ?>' class="rounded-circle" style="height: 34px;" alt="avatar image">
							</a>
							<div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink-55">
								<a class="dropdown-item" href="<?php echo site_url('user/perfilUsuario/' . $this->session->userdata['logged_in']['users_id']); ?>"> <i class="fas fa-user"></i> Ver perfil</a>
								<a class="dropdown-item" href="<?php echo site_url('user/edit/' . $this->session->userdata['logged_in']['users_id']); ?>"><i class="fas fa-edit"></i> Editar perfil</a>
								<a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item"> <i class="fas fa-arrow-left"></i> Salir</a>
							</div>
						</li>
					<?php } else { ?>
						<?php echo form_open('auth/logout'); ?>
						<button class="btn btn-outline-primary  me-2" type="submit"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
						<?php echo form_close(); ?>
						<?php echo form_open('user/add'); ?>
						<button class="btn btn-outline-success  me-2" type="submit"><i class="fas fa-user-plus"></i> Registrarme</button>
						<?php echo form_close(); ?>
					<?php } ?>
				</ul>
			</div>

		</div>
	</nav>
	<br><br><br><br>
	<!-- Navbar -->

	<!-- Modal para ejercer la compra -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">

			<?php echo form_open('comprador/comprarProductos/') ?>
			<div class="modal-content" style="background-color: #15202B;">

				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Realizar Pago</h5>
				</div>

				<div class="modal-body" style="text-align: center;">
					<div style="text-align: center;">
						<h6 style="display: inline-block;">CVV:</h6>
						<input type="password" name="cvv" id="cvv" class="form-control" placeholder="CVV" aria-label="CVV" maxlength="3" required style="width: 13%; font-size: 13px; display: inline-block;">
					</div>
					<br>
					<h6>Método de pago:</h6>
					<select name="cmb_metodo" id="cmb_metodo" value="cmb_metodo" class="form-select form-select-sm " aria-label=".form-select-sm example">
						<option value="0">Sin seleccionar</option>
						<?php if (!empty($pagos)) { ?>
							<!--  trae las lista de las formas de pago-->
							<?php foreach ($pagos as $pag) { ?>
								<option value="<?php echo $pag['id_formas_pago'] ?>">Numero Tarjeta:<?php echo $pag['numero_tarjeta'] ?> - Saldo:<?php echo $pag['saldo'] ?></option>
							<?php } ?>
						<?php } ?>
					</select>
					<br>
					<h6>Dirección de envio:</h6>
					<select name="cmb_direccion" id="cmb_direccion" value="cmb_direccion" class="form-select form-select-sm " aria-label=".form-select-sm example">
						<option value="0">Sin seleccionar</option>
						<?php if (!empty($direcciones)) { ?>
							<!--  trae las lista dedirecciones del usuario logueado-->
							<?php foreach ($direcciones as $dir) { ?>
								<option value="<?php echo $dir['id_direcciones'] ?>">Pais:<?php echo $dir['pais_direccion'] ?> - Dirección:<?php echo $dir['observaciones'] ?></option>
							<?php } ?>
						<?php } ?>
					</select>
					<br>
					<h6>Premios adquiridos:</h6>
					<select name="cmb_boni" id="cmb_boni" onchange="ShowSelected();" class="form-select form-select-sm" aria-label=".form-select-sm example">
						<option value="0">Sin seleccionar</option>
						<?php if (!empty($premios)) { ?>
							<!--  trae las lista de premios del usuario logueado-->
							<?php foreach ($premios as $premio) { ?>
								<option value="<?php echo $premio['id_premios'] ?>"><?php echo $premio['descripcion'] ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>

				<hr>
				<div class="row total-section">
					<div class="col-lg-5 col-sm-5 col-5 total-section text-left">
						<h6>
							<p>Subtotal: <span class="text-info" id="precio">$<?php echo $precio ?></span></p>
						</h6>
						<h6>
							<p>Costo de envio: <span class="text-info" id="envio">$<?php echo $cobro_envio ?></span></p>
						</h6>
						<h6>
							<p>Bonificación: <span class="text-info" id="boni"></span></p>
						</h6>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-lg-6 col-sm-6 col-6 total-section text-left" style="display: inline-block; margin-top: 15px;">
						<h4>
							<p>Total: <span class="text-info" id="total">$<?php echo $precio + $cobro_envio ?></span></p>
							<input type="hidden" id="total1" name="total1" value="<?php echo $precio + $cobro_envio ?>">
						</h4>
					</div>
					<button style="display: inline-block;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

					<button style="display: inline-block;" disabled type="submit" class="btn btn-primary" id="pagar">Pagar</button>

				</div>

			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
	<!-- Termina Modal -->

	<!-- Modal del historial de las compras del usuario logueado-->
	<div class="modal fade" data-bs-backdrop="static" id="compras" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">

			<div class="modal-content" style="background-color: #15202B;">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Historial de compras</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" style="text-align: center;">
					<div id="tableview2">
						<table class="table table-striped table-dark" id="tables">
							<thead>
								<tr align="center">
									<td>Fecha de compra </td>
									<td>Precio</td>
									<td>Acción</td>
								</tr>
							</thead>
							<tbody id="tbTable">
								<?php if (!empty($compras)) { ?>
									<?php foreach ($compras as $com) { ?>
										<tr align="center">
											<td><?php echo $com['fecha'] ?></td>
											<td><?php echo $com['precio_total'] ?></td>
											<?php echo form_open('comprador/facturaCompra/' . $com['id_compras']) ?>
											<td><button class="btn btn-primary" id="factura">Ver factura</button></td>
											<?php echo form_close(); ?>
										</tr>
									<?php }
								} else { ?>
									<h2>No hay compras por mostrar</h2>
								<?php } ?>
							</tbody>
						</table>

					</div>
					<div class="modal-footer">
						<button style="display: inline-block;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- Termina Modal -->

	<?php
	if ($message_display != null) {


		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'style='font-size: 18px;'>"
			. $message_display .
			"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
	}
	?>
	<div id="main_panel">
		<div id="mas_vendidos">
			<div class='post_block'>
				<div class='post_detail' style="text-align: center;">
					<a class="nav-link waves-effect">
						<h5>Productos más vendidos</h5>
					</a>
					<hr>
					<br>
					<div class="row align-items ">
						<?php $TOP = 0;
						if (!empty($productosMasVendidos)) { ?>
							<!--  trae las lista de los productos mas vendidos-->
							<?php foreach ($productosMasVendidos as $pmv) { ?>
								<?php foreach ($pro as $p) { ?>
									<?php if ($pmv['id_productos'] == $p['id_productos']) {
										$TOP = $TOP + 1 ?>
										<div class="col-4">
											<div class="card">
												<div class="view overlay">
													<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
														<div class="carousel-inner">
															<?php $cont = 1 ?>
															<?php if (!empty($galerias)) { ?>
																<?php foreach ($galerias as $g) { ?>
																	<?php if ($g['id_productos'] == $p['id_productos']) {
																		if ($cont == 1) {
																			$band = 'active';
																		} else {
																			$band = '';
																		}
																		$cont = $cont + 1;
																	?>
																		<div class="carousel-item <?php echo $band ?>">
																			<img src='<?php echo site_url('/resources/files/' . $g['imagen_producto']) ?>' height="200" class="d-block w-100" alt="...">
																		</div>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														</div>
													</div>
													<a>
														<div class="mask rgba-white-slight"></div>
													</a>
												</div>
												<div class="card-body text-center">
													<a href="<?php echo site_url('comprador/perfilProducto/' . $p['id_productos']); ?>" class="grey-text">
														<h5><?php echo $p['descripcion'] ?></h5>
													</a>
													<?php if ($p['cantidad'] > 0) { ?>
														<div class="product-stock">Disponible</div>
													<?php } else { ?>
														<div class="product-stock2">No disponible</div>
													<?php } ?>
													<?php if ($seccion == TRUE) { ?>
														<?php echo form_open('comprador/addCarritoDeseo/' . $p['id_productos']); ?>
														<button id=" btn_carrito" name="btn_carrito" value="btn_carrito" type="submit" class="btn btn-primary" style="display: inline-block;"><i class="fas fa-cart-plus"></i></button>
														<button id=" btn_deseo" name="btn_deseo" value="btn_deseo" type="submit" class="btn btn-primary" style="display: inline-block;"><i class="fas fa-heart"></i></button>
														<?php echo form_close(); ?>
													<?php } ?>
													<h4 class="font-weight-bold black-text" style="color: black;">
														<strong>$ <?php echo $p['precio'] ?></strong>
													</h4>
												</div>
											</div>
											<div>
												<h2>TOP <?php echo $TOP ?></h2>
											</div>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } else { ?>
							<label for="">No hay productos mas vendidos</label>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Navbar-->
	<div id="main_panel">
		<!--  Aqui estan los filtros donde el usaurio puede filtrar por producto , por tienda y por categoria-->
		<nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5" style="background-color: black;">

			<span class="navbar-brand">Filtros:</span>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="basicExampleNav">
				<ul class="navbar-nav mr-auto" style="padding-top: 25px;">
					<?php echo form_open('comprador/search', "class=\"d-flex\""); ?>
					<li class="nav-item me-2">
						<select name="cmb_categoria" id="cmb_categoria" class="form-select me-2" aria-label=".form-select-sm example">
							<option value="">Sin seleccionar</option>
							<?php if (!empty($categorias)) { ?>
								<?php foreach ($categorias as $cate) { ?>
									<option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</li>

					<li class="nav-item me-2">
						<input id=" txt_producto" name="txt_producto" class="form-control me-2" placeholder="Producto" aria-label="Search">

					</li>
					<li class="nav-item me-2">
						<input id=" txt_tienda" name="txt_tienda" class="form-control me-2" placeholder="Tienda" aria-label="Search">
					</li>
					<li class="nav-item me-2" style="position: relative; bottom: 10px;">
						<button id=" btn_search" name="btn_search" value="btn_search" class="btn btn-secondary me-2" type="submit"><i class="fas fa-search"></i> Buscar</button>
					</li>

					<?php echo form_close(); ?>

				</ul>
			</div>
		</nav>
		<!--/.Navbar-->



		<!-- traer tiendas de base de datos -->
		<?php if (!empty($tiendas)) { ?>
			<?php foreach ($tiendas as $t) { ?>
				<div class='post_block'>
					<span class='post_text' id='post_<?php echo $t['id_usuarios']; ?>'>
					</span>
					<div id='content_post_<?php echo $t['id_usuarios']; ?>'>
						<div class='post_detail' style="text-align: center;">
							<a class="nav-link waves-effect" href="<?php echo site_url('tienda/perfiltienda/' . $t['id_usuarios']); ?>">
								<h5><?php echo $t['nombre_real']; ?></h5>
							</a>
							<hr>
							<br>
							<div class="row align-items">
								<?php if (!empty($productos)) { ?>
									<?php foreach ($productos as $p) { ?>
										<?php if ($t['id_usuarios'] == $p['id_usuarios']) { ?>
											<div class="col-lg-3 col-md-6 mb-4">
												<div class="card">
													<!--Card image-->
													<div class="view overlay">
														<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
															<div class="carousel-inner">
																<?php $cont = 1 ?>
																<?php if (!empty($galerias)) { ?>
																	<?php foreach ($galerias as $g) { ?>
																		<?php if ($g['id_productos'] == $p['id_productos']) {
																			if ($cont == 1) {
																				$band = 'active';
																			} else {
																				$band = '';
																			}
																			$cont = $cont + 1;
																		?>
																			<div class="carousel-item <?php echo $band ?>">
																				<img src='<?php echo site_url('/resources/files/' . $g['imagen_producto']) ?>' height="200" class="d-block w-100" alt="...">
																			</div>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															</div>

														</div>
														<a>
															<div class="mask rgba-white-slight"></div>
														</a>
													</div>
													<div class="card-body text-center">
														<a href="<?php echo site_url('comprador/perfilProducto/' . $p['id_productos']); ?>" class="grey-text">
															<h5><?php echo $p['descripcion'] ?></h5>
														</a>
														<?php if ($p['cantidad'] > 0) { ?>
															<div class="product-stock">Disponible</div>
														<?php } else { ?>
															<div class="product-stock2">No disponible</div>
														<?php } ?>
														<?php if ($seccion == TRUE) { ?>
															<?php echo form_open('comprador/addCarritoDeseo/' . $p['id_productos']); ?>
															<button id=" btn_carrito" name="btn_carrito" value="btn_carrito" type="submit" class="btn btn-primary" style="display: inline-block;"><i class="fas fa-cart-plus"></i></button>
															<button id=" btn_deseo" name="btn_deseo" value="btn_deseo" type="submit" class="btn btn-primary" style="display: inline-block;"><i class="fas fa-heart"></i></button>
															<?php echo form_close(); ?>
														<?php } ?>
														<h4 class="font-weight-bold black-text" style="color: black;">
															<strong>$ <?php echo $p['precio'] ?></strong>
														</h4>
													</div>
												</div>
											</div>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</div>
						</div><br />
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php } else {
	header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>

<script>
	window.addEventListener('load', miFuncionLoad, false);

	function miFuncionLoad() {
		var unlock = document.getElementById("cmb_metodo");
		unlock.addEventListener("click", validar, false);

		var unlock = document.getElementById("cvv");
		unlock.addEventListener("click", validar, false);


		var unlock = document.getElementById("cmb_direccion");
		unlock.addEventListener("click", validar, false);

		var unlock = document.getElementById("cmb_boni");
		unlock.addEventListener("click", boni, false);
		// validar();

		document.getElementById("cvv").addEventListener("input", (e) => {
			let value = e.target.value;
			e.target.value = value.replace(/[^A-Z\d-]/g, "");
		});
	}

	function ShowSelected() {

		/* Para obtener el texto */
		var combo = document.getElementById("cmb_boni");
		var selected = combo.options[combo.selectedIndex].text;
		document.getElementById("boni").innerHTML = selected;




		if (selected == 'Envío') { //para hacer las rebajas de los premios
			document.getElementById("precio").innerHTML = "$" + <?php echo $precio ?>;
			document.getElementById("envio").innerHTML = "$" + 0;
			document.getElementById("total").innerHTML = "$" + <?php echo $precio ?>;
			document.getElementById("total1").value = <?php echo $precio ?>;
		} else if (selected == '%10') {
			document.getElementById("precio").innerHTML = "$" + <?php echo $precio - ($precio * 0.10) ?>;
			document.getElementById("envio").innerHTML = "$" + <?php echo $cobro_envio ?>;
			document.getElementById("total").innerHTML = "$" + <?php echo ($precio - ($precio * 0.10)) + $cobro_envio ?>;
			document.getElementById("total1").value = <?php echo ($precio - ($precio * 0.10)) + $cobro_envio ?>;
		} else {
			document.getElementById("precio").innerHTML = "$" + <?php echo $precio ?>;
			document.getElementById("envio").innerHTML = "$" + <?php echo $cobro_envio ?>;
			document.getElementById("total").innerHTML = "$" + <?php echo $precio + $cobro_envio ?>;
			document.getElementById("total1").value = <?php echo $precio + $cobro_envio ?>;
		}
		console.log(document.getElementById("total1").value);
	}


	function validar() { //para validar que no se pueda comprar sin poner el cvv, direccion y metodo de pago
		if (esVacio("cmb_metodo") || esVacio("cmb_direccion") || esCVV('cvv')) {
			document.getElementById('pagar').disabled = true; //boton disable   
		} else {
			document.getElementById('pagar').disabled = false;
		}
	}

	function esCVV(text) {
		var campo = document.getElementById(text);
		if (campo.value == "") {
			return true; //boton disable 
		} else {
			return false;
		}
	}

	function esVacio(idcampo) {
		var campo = document.getElementById(idcampo);
		console.log(document.getElementById("total1").value);
		if (campo.value == "0") {
			return true; //boton disable 
		} else {
			return false;
		}

	}
</script>