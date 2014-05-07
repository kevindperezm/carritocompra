<?php $this->load->helper('form'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesión - <?=NOMBRE_TIENDA?></title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/gran-contenedor.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/estilos.css">
	<script src="<?=base_url()?>public/js/jquery-1.11.0.min.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
	<style>
		body {
			background: #EEEEEE;
			padding: 0;
		}
		.login-wrapper {
			width: 25em;
			max-width: 100%;
			margin: 0 auto;
			margin-top: 4em;
		}
		.input-group * {
			font-size: 120%;
			height: 3em;
		}
		.input-group-addon {
			width: 8em;
		}
		.logo {
			color: #AAA;
			margin-top: 3em;
			text-align: center;	
		}
	</style>
</head>
<body>

	<div class='container-fluid'>
		<div class='logo'>
			<h2><?=NOMBRE_TIENDA?></h2>
		</div>
		<div class='login-wrapper'>
			<h2>Iniciar sesión</h2>
			<?php if (!empty($error)) { ?>
			<div class='alert alert-danger' style='margin-bottom: 0.5em'>
				<?= !empty($mensaje_error) ? "<p>$mensaje_error</p>" : null?>
				<?=validation_errors()?>
			</div>
			<?php } ?>
			<?= form_open('login') ?>
					<div class='input-group'>
						<span class='input-group-addon'>Usuario</span>
						<input type='text' name='usuario' id='inputUsuario' class='form-control' value='<?= set_value('usuario') ?>'>
					</div>
					<div class='input-group'>
						<span class='input-group-addon'>Contraseña</span>
						<input type='password' name='contrasena' id='inputContrasena' class='form-control' value='<?= set_value('contrasena') ?>'>
					</div>

					<button type='submit' name='submit' class='btn btn-primary btn-lg btn-block' style='width: 100%'>Iniciar sesión</button>
					<!-- <p class='text-center'>O</p> -->
			</form>
			<div style='padding-top:0.5em'>
				<!-- <p>Si aún no lo ha hecho, puede registrarse.</p> -->
				<a href='<?=base_url()?>registro'><button class='btn btn-default btn-lg' style='width: 100%'>Regístrarse</button></a>
			</div>
			<div class='row' style="padding-top: 2.5em">
				<div class='col-xs-12 text-center' style='color: #AAA'>
					&copy; Mundo Virtual 2014
				</div>
			</div>
		</div>
	</div>
</body>
</html>

