<html>

<head>
	<meta charset="utf-8">
	<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chatwitter</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
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
				<input type="submit" value="OK" name="btn_login" id="btn_login" /><br />
				<?php echo form_close(); ?>
				
			</div>
		</div>
	</div>
</body>

</html>