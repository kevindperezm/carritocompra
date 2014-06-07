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
		<header class='header'>
			<?php $this->load->view('topbars/cliente-topbar'); ?>
		</header>
		<main class='main container'>
			