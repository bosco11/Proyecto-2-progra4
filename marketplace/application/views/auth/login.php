<html>

<head>
	<meta charset="utf-8">
	<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chatwitter</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="<?php echo site_url('resources/img/favicon.png'); ?>" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/css/login.css'); ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/css/login.css'); ?>">
</head>

<body>

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
	<div id="main">
		<div id="login">
			<div id="form_container">
				<?php echo form_open('auth/login');	?>
				<input type="text" name="txt_username" id="txt_username" placeholder="USUARIO" title="Usuario" class="cajatexto" /><br />
				<input type="password" name="txt_password" id="txt_password" placeholder="**********" title="Contraseña" class="cajatexto" /><br />
				<button type="submit" class="btn btn-primary" name="btn_login" id="btn_login">Ingresar</button>
				<?php echo form_close(); ?>
				<div id="actions">
					<a href="<?php echo site_url('user/add'); ?>" class="link-primary" id="btn_adduser" name='btn_adduser' title="Registrarse">Registrarse</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>