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
			<a class="navbar-brand" href="<?php echo site_url('comprador/index'); ?>">MarketPlace</a>
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
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-secondary me-2" type="submit">Buscar</button>
				</form>
				<?php echo form_open('auth/logout'); ?>
				<button class="btn btn-outline-primary btn-sm me-2" type="submit">Ingresar</button>
				<?php echo form_close(); ?>
				<?php echo form_open('user/add'); ?>
				<button class="btn btn-outline-success btn-sm me-2" type="submit">Registrarme</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</nav>

	<!-- traer tiendas de base de datos -->
	<!-- <div id="main_panel">
      <?php foreach ($tweets as $t) { ?>

        <div class='post_block'>
          <span class='post_text' id='post_<?php echo $t['tweets_id']; ?>'>
            <div class='published_date'>
              <span>Publicado el <?php echo $t['date']; ?> por <strong> <?php echo $t['realname'] . " [" . $t['username'] . "]"; ?></strong></span>
            </div>
          </span>
          <div id='content_post_<?php echo $t['tweets_id']; ?>'>
            <img src="<?php echo site_url('/resources/photos/' . $t['photo']); ?>" alt="foto" class="imgpost" width=50 />
            <div class='post_detail'>
              <?php echo $t['post']; ?>
              <br>
              <?php
				$like = "/resources/files/like.png";
				$dislike = "/resources/files/dislike.png";
				if (!empty($reaccion)) {
					foreach ($reaccion as $re) {
						if ($t['tweets_id'] == $re['tweets_tweets_id']) {
							if ($re['reaccion'] == "1") {
								$like = "/resources/files/like1.png";
								$dislike = "/resources/files/dislike.png";
							} else if ($re['reaccion'] == "0") {
								$like = "/resources/files/like.png";
								$dislike = "/resources/files/dislike1.png";
							}
						}
					}
				}
				?>
              <?php echo form_open('twitter/likeDislike/' . $t['tweets_id'], 'onsubmit="send()"') ?>
              <button type="submit" value="1" name="like" class="imglike"><img width="25" height="25" id="like" src="<?php echo site_url($like); ?>"></button>
              <button type="submit" value="0" name="dislike" class="imgdislike"><img width="25" height="25" id="dislike" src="<?php echo site_url($dislike); ?>"></button>
              <?php echo form_close(); ?>


              <div id="actions">
                <a href="<?php echo site_url('twitter/historial/' . $t['tweets_id']); ?>" id="btn_his" name="btn_his" title="Historial">Historico de reaciones</a>
              </div>
            </div><br />
          </div>



          <?php
			$nombreDelArchivo = $t['img'];
			$extension = pathinfo($nombreDelArchivo, PATHINFO_EXTENSION);

			if ($extension == "png" || $extension == "jpeg" || $extension == "jpg" || $extension == "gif") {
			?>
            <img src="<?php echo site_url('/resources/files/' . $t['img']); ?>" width="100" height="100">
          <?php
			}
			?>
          <?php
			if ($extension == "docx" || $extension == "pdf" || $extension == "txt") {
			?>
            <a href="<?php echo site_url('/resources/files/' . $t['img']); ?>" title="archivo"><?php echo $t['img']; ?></a>
          <?php
			}
			?>

          <?php if ($this->session->userdata['logged_in']['users_id'] == $t['users_id']) { ?>
            <div id="actions">
              <a href="<?php echo site_url('twitter/edit/' . $t['tweets_id']); ?>" id="btn_editar" name="btn_editar" title="Editar">✎</a>
              <a href="<?php echo site_url('twitter/delete/' . $t['tweets_id']); ?>" id="btn_eliminar" name="btn_eliminar" title="Eliminar" onclick="send()">🗙</a>
            </div>
          <?php } ?>
        </div>

      <?php } ?>
    </div> -->

	<!-- aqui termina el llamado a las tiendas  -->

	<div class="container">
		<div class="col-9">
			<h2>Tienda</h2>
		</div>
		<div class="row align-items-start">
			<div class="col-3">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src='<?php echo site_url('/resources/photos/1.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/2.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/3.jpg') ?>' class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<div class="col-3">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src='<?php echo site_url('/resources/photos/1.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/2.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/3.jpg') ?>' class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<div class="col-3">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src='<?php echo site_url('/resources/photos/1.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/2.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/3.jpg') ?>' class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<div class="col-3">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src='<?php echo site_url('/resources/photos/1.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/2.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/3.jpg') ?>' class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
		</div>
		<br>
		<div class="row align-items-center">
			<div class="col-3">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src='<?php echo site_url('/resources/photos/1.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/2.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/3.jpg') ?>' class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<div class="col-3">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src='<?php echo site_url('/resources/photos/1.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/2.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/3.jpg') ?>' class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<div class="col-3">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src='<?php echo site_url('/resources/photos/1.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/2.jpg') ?>' class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src='<?php echo site_url('/resources/photos/3.jpg') ?>' class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
		</div>
		<div class="row align-items-end">
			<div class="col">
				One of three columns
			</div>
			<div class="col">
				One of three columns
			</div>
			<div class="col">
				One of three columns
			</div>
		</div>
	</div>
</div>