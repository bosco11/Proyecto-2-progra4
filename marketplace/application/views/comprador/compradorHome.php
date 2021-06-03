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
				<form class="d-flex">

					<select class="form-select form-select-sm me-2" aria-label=".form-select-sm example">
						<option selected>Seleccionar categoría</option>
						<option value="1">Informática</option>
						<option value="2">Hogar</option>
						<option value="3">Herramienta</option>
					</select>
					<input class="form-control form-sm me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn  btn-outline-secondary  me-2" type="submit">Buscar</button>
				</form>
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
		<?php foreach ($tiendas as $t) { ?>

			<div class='post_block'>
				<span class='post_text' id='post_<?php echo $t['id_usuarios']; ?>'>
				</span>
				<div id='content_post_<?php echo $t['id_usuarios']; ?>'>
					<div class='post_detail'>
						<?php echo $t['nombre_real']; ?>
						<br>
						<div class="row align-items">
							<?php foreach ($productos as $p) { ?>
								<?php if ($t['id_usuarios'] == $p['id_usuarios']) { ?>
									<div class="col-3">
										<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
											<div class="carousel-inner">
												<?php $cont = 1 ?>
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
															<img src='<?php echo site_url('/resources/photos/' . $g['imagen_producto']) ?>' class="d-block w-100" alt="...">
														</div>
													<?php } ?>
												<?php } ?>
											</div>
											<label for=""><?php echo $p['descripcion'] ?></label>

										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>


					</div><br />
				</div>
			</div>
		<?php } ?>
	</div>
	<!-- aqui termina el llamado a las tiendas  -->
</div>