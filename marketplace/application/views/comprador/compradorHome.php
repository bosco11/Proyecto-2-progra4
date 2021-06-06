<div id="panel_app">
	<!-- <div id="user_box">
		<a href="<?php echo site_url('user/edit/' . $this->session->userdata['logged_in']['users_id']); ?>" title="Editar Perfil">
			<?php
			echo "<img src='" . site_url('/resources/photos/' . $this->session->userdata['logged_in']['imagen'])
				. "' alt='photo_profile' width=50 height=50 id='photo_profile' />" .
				"<span>HOLA! " . $this->session->userdata['logged_in']['nombre_real'] . ". ✎</span>";
			?>
		</a>
		<div class="box-header">
			<h2 class="box-title">Comprador</h2>
			<div id="logout">

				<?php echo form_open('auth/logout'); ?>
				<button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Salir">🗙</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div> -->


	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo site_url('comprador/index'); ?>"></h5>MarketPlace</h5></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="<?php echo site_url('comprador/index'); ?>">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="<?php echo site_url('comprador/index'); ?>">Acerca de</a>
					</li>
				</ul>
				<!-- <form class="d-flex"> -->
				<?php echo form_open('comprador/search'); ?>
				<select name="cmb_categoria" id="cmb_categoria" class="form-select form-select-sm me-2" aria-label=".form-select-sm example">
					<option value="">Sin seleccionar</option>
					<?php if (!empty($categorias)) { ?>
						<?php foreach ($categorias as $cate) { ?>
							<option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
						<?php } ?>
					<?php } ?>
				</select>
				<input id="txt_producto" name="txt_producto" class="form-control form-sm me-2" placeholder="Producto" aria-label="Search">
				<input id="txt_tienda" name="txt_tienda" class="form-control form-sm me-2" placeholder="Tienda" aria-label="Search">
				<button id="btn_search" name="btn_search" value="btn_search" class="btn  btn-outline-secondary  me-2" type="submit">Buscar</button>
				<?php echo form_close(); ?>
				<!-- </form> -->
				<?php echo form_open('auth/logout'); ?>
				<button class="btn btn-outline-primary  me-2" type="submit">Ingresar</button>
				<?php echo form_close(); ?>
				<?php echo form_open('user/add'); ?>
				<button class="btn btn-outline-success  me-2" type="submit">Registrarme</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</nav>

	<!-- traer tiendas de base de datos -->
	<div id="main_panel">
		<?php if (!empty($tiendas)) { ?>
			<?php foreach ($tiendas as $t) { ?>
				<div class='post_block'>
					<span class='post_text' id='post_<?php echo $t['id_usuarios']; ?>'>
					</span>
					<div id='content_post_<?php echo $t['id_usuarios']; ?>'>
						<div class='post_detail'>
							<?php echo $t['nombre_real']; ?>
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
														<a href="" class="grey-text">
															<h5><?php echo $p['descripcion'] ?></h5>
														</a>
														<button class="btn btn-primary">🛒</button>
														<button class="btn btn-primary">❤️</button>

														<h4 class="font-weight-bold black-text" style="color: black;">
															<strong>₡ <?php echo $p['precio']?></strong>
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