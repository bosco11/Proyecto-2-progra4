<nav class="navbar fixed-top navbar-expand-lg navbar-dark white scrolling-navbar" style="background-color: black;">
	<div class="container">

		<!-- Brand -->
		<a class="navbar-brand waves-effect" href="#">
			<strong class="blue-text">MarketPlace</strong>
		</a>

		<!-- Collapse -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Links -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">

			<!-- Left -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link waves-effect" href="#">Inicio
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link waves-effect" href="#">Acerca de
					</a>
				</li>
			</ul>

			<!-- Right -->
			<ul class="navbar-nav nav-flex-icons ml_auto">
				<?php if ($seccion == TRUE) { ?>
					<li class="nav-item">
						<div class="dropdown">
							<button type="button" class="btn btn-info" data-toggle="dropdown">
								<i class="fa fa-shopping-cart" aria-hidden="true">
								</i>
								Carrito
								<?php if (!empty($carrito)) { ?>
									<?php $cont = 0;
									$precio = 0; ?>
									<?php foreach ($carrito as $car) {
										foreach ($productos as $p) {
											if ($car['id_productos'] == $p['id_productos']) {
												$cont += 1;
												$precio += $p['precio']*$car['cantidad'];
											} ?>
										<?php } ?>
									<?php } ?>
									<span class="badge badge-pill badge-danger"><?php echo $cont ?></span>
								<?php } else {
									$cont = 0;
									$precio = 0;
								} ?>
							</button>
							<div class="dropdown-menu">
								<div class="row total-header-section">
									<div class="col-lg-6 col-sm-6 col-6">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger"><?php echo $cont ?></span>
									</div>
									<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
										<p>Total: <span class="text-info">$<?php echo $precio ?></span></p>
									</div>
								</div>
								<?php if (!empty($carrito)) { ?>
									<?php foreach ($carrito as $car) { ?>
										<div class="row cart-detail">
											<?php foreach ($productos as $p) { ?>
												<?php if ($car['id_productos'] == $p['id_productos']) { ?>
													<?php $band = true;
													foreach ($galerias as $g) { ?>
														<?php if ($p['id_productos'] == $g['id_productos'] && $band) { ?>
															<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
																<img src='<?php echo site_url('/resources/files/' . $g['imagen_producto']) ?>'>
															</div>
														<?php $band = false;
														} ?>
													<?php } ?>
													<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
														<p><?php echo $p['descripcion'] ?>.</p>
														<span class="price text-info">
															$<?php echo $p['precio'] ?></span> <span class="count">
															<?php echo $car['cantidad'] ?></span>
													</div>
												<?php } ?>
											<?php } ?>
										</div>
									<?php } ?>
								<?php } ?>
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
										<button class="btn btn-primary btn-block">Checkout</button>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown notifications-nav ">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink151" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span class="badge badge-pill bg-danger">1</span>
							<span><i class="fas fa-bell" style="font-size: 27px; margin-top: 5px;"></i></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink151">
							<a class="dropdown-item" href="#!">
								<i class="far fa-money-bill-alt mr-2" aria-hidden="true"></i>
								<span>New order received</span>
								<span class="float-right"><i class="far fa-clock" aria-hidden="true"></i> 13 min</span>
							</a>
							<a class="dropdown-item" href="#!">
								<i class="far fa-money-bill-alt mr-2" aria-hidden="true"></i>
								<span>New order received</span>
								<span class="float-right"><i class="far fa-clock" aria-hidden="true"></i> 33 min</span>
							</a>
							<a class="dropdown-item" href="#!">
								<i class="fas fa-chart-line mr-2" aria-hidden="true"></i>
								<span>Your campaign is about end</span>
								<span class="float-right"><i class="far fa-clock" aria-hidden="true"></i> 53 min</span>
							</a>
						</div>

					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src='<?php echo site_url('/resources/photos/' . $this->session->userdata['logged_in']['imagen']) ?>' class="rounded-circle" style="height: 34px;" alt="avatar image">
						</a>
						<div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink-55">
							<a class="dropdown-item" href="<?php echo site_url('user/edit/' . $this->session->userdata['logged_in']['users_id']); ?>">Editar perfil</a>
							<a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">Salir</a>
						</div>
					</li>
				<?php } else { ?>
					<?php echo form_open('auth/logout'); ?>
					<button class="btn btn-outline-primary  me-2" type="submit">Ingresar</button>
					<?php echo form_close(); ?>
					<?php echo form_open('user/add'); ?>
					<button class="btn btn-outline-success  me-2" type="submit">Registrarme</button>
					<?php echo form_close(); ?>
				<?php } ?>
			</ul>

		</div>

	</div>
</nav>
<br><br><br><br>
<!-- Navbar -->
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5" style="background-color: black;">

	<!-- Navbar brand -->
	<span class="navbar-brand">Filtros:</span>

	<!-- Collapse button -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Collapsible content -->
	<div class="collapse navbar-collapse" id="basicExampleNav">

		<!-- Links -->
		<ul class="navbar-nav mr-auto">
			<?php echo form_open('comprador/search', "class=\"d-flex\""); ?>
			<li class="nav-item me-2">
				<select name="cmb_categoria" id="cmb_categoria" class="form-select form-select-sm me-2" aria-label=".form-select-sm example">
					<option value="">Sin seleccionar</option>
					<?php if (!empty($categorias)) { ?>
						<?php foreach ($categorias as $cate) { ?>
							<option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</li>

			<li class="nav-item me-2">
				<input id=" txt_producto" name="txt_producto" class="form-control form-sm me-2" placeholder="Producto" aria-label="Search">

			</li>
			<li class="nav-item me-2">
				<input id=" txt_tienda" name="txt_tienda" class="form-control form-sm me-2" placeholder="Tienda" aria-label="Search">
			</li>
			<li class="nav-item me-2">
				<button id=" btn_search" name="btn_search" value="btn_search" class="btn  btn-outline-secondary  me-2" type="submit">Buscar</button>
			</li>

			<?php echo form_close(); ?>

		</ul>
		<!-- Links -->

		<!-- <form class="form-inline">
				<div class="md-form my-0">
					<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				</div>
			</form> -->
	</div>
	<!-- Collapsible content -->

</nav>
<!--/.Navbar-->



<!-- traer tiendas de base de datos -->
<div id="main_panel">
	<?php if (!empty($tiendas)) { ?>
		<?php foreach ($tiendas as $t) { ?>
			<div class='post_block'>
				<span class='post_text' id='post_<?php echo $t['id_usuarios']; ?>'>
				</span>
				<div id='content_post_<?php echo $t['id_usuarios']; ?>'>
					<div class='post_detail'>
						<a class="nav-link waves-effect" href="<?php echo site_url('tienda/perfiltienda/' . $t['id_usuarios']); ?>"><?php echo $t['nombre_real']; ?></a>
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
														<label for=""><?php echo $p['descripcion'] ?></label>

													</div>
													<a>
														<div class="mask rgba-white-slight"></div>
													</a>
												</div>
												<!--Card image-->

												<!--Card content-->
												<div class="card-body text-center">
													<!--Category & Title-->
													<a href="<?php echo site_url('comprador/perfilProducto/' . $p['id_productos']); ?>" class="grey-text">
														<h5><?php echo $p['descripcion'] ?></h5>
													</a>
													<?php if ($seccion == TRUE) { ?>
														<?php echo form_open('comprador/addCarritoDeseo/' . $p['id_productos']); ?>
														<button id=" btn_carrito" name="btn_carrito" value="btn_carrito" type="submit" class="btn btn-primary" style="display: inline-block;">🛒</button>
														<button id=" btn_deseo" name="btn_deseo" type="submit" class="btn btn-primary" style="display: inline-block;">❤️</button>
														<?php echo form_close(); ?>
													<?php } ?>
													<h4 class="font-weight-bold black-text" style="color: black;">
														<strong>₡ <?php echo $p['precio'] ?></strong>
													</h4>

												</div>
												<!--Card content-->

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
<!-- aqui termina el llamado a las tiendas  -->
</div>