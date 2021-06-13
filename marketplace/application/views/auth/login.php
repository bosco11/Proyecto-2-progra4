<html>

<head>
	<meta charset="utf-8">
	<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Marketplace</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="<?php echo site_url('resources/img/tienda.png'); ?>" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/css/login.css'); ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/css/login.css'); ?>">
</head>

<body>

	<?php
	if (isset($logout_message)) {

		echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>"
			. $logout_message .
			"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
	}

	if (isset($message_display)) {

		echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>"
			. $message_display .
			"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
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


	<div class="container-sm">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="imgcontainer">
					<!-- <img src="/resources/img/usuario.png" alt="Avatar" class="avatar" style="background-color: transparent" /> -->
					<?php
					echo "<img src='" . site_url('/resources/img/user.png')
						. "' alt='Avatar' class='avatar' style='background-color: transparent' />";
					?>
				</div>
				<div class="card-header">
					<td></td>
					<h3>Inicio de sesion</h3>
				</div>
				<div class="card-body">

					<?php echo form_open('auth/login');	?>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="txt_username" id="txt_username" aria-label="USUARIO" aria-describedby="addon-wrapping" placeholder="USUARIO" title="Usuario" class="cajatexto" /><br />
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="txt_password" id="txt_password" aria-label="**********" aria-describedby="addon-wrapping" placeholder="**********" title="Contraseña" class="cajatexto" /><br />
					</div>

					<button type="submit" class="btn btn-primary" name="btn_login" id="btn_login">Ingresar</button>
					<?php echo form_close(); ?>
					<div id="actions">
						<a href="<?php echo site_url('comprador/compradorHome'); ?>" id="btn_adduser" name='btn_adduser' title="Registrarse">Volver al inicio</a>
					</div>
				</div>


			</div>
		</div>
	</div>
	</div>
</body>

</html>