<!DOCTYPE html>
<html lang='es'>
<head>
	<title><?= $titulo.' - '.NOMBRE_TIENDA ?></title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?=base_url()?>public/img/favicon.png">
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/gran-contenedor.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/estilos.css">
	<script src="<?=base_url()?>public/js/jquery-1.11.0.min.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>public/js/confirmar.js"></script>
</head>
<body>
	<div class='wrap'>
		<header class='header container-fluid'>
			<?php 
			# TODO: Insertar topbars para nuevos roles aquí.
			switch ($this->session->userdata('user_rol')) {
				case ROLES_ADMINISTRADOR:
					echo $this->load->view('topbars/admin-topbar');
					break;
				
				case ROLES_CLIENTE_COMUN:
					echo $this->load->view('topbars/cliente-topbar');
					break;
			}
			?> 
		</header>
		<div class='main container'>
			