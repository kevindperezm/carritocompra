<!DOCTYPE html>
<html>
<head>
	<title>Detalles del pedido #<?=$pedido->id?></title>
	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/estilos.css">
</head>
<body>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-xs-6'>
				<h1><?=NOMBRE_TIENDA?></h1>
			</div>
			<div class='col-xs-6 text-right' style='margin-top: 1.7em'>
				<h3>Detalles de pedido</h3>
			</div>
		</div>
		<hr>
		<?=$this->load->view('admin/pedidos/tabla-detalles')?>
	</div>
</body>
</html>