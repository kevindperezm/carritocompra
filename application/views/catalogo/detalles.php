<link rel="stylesheet" href="<?=base_url()?>public/css/detalles-pedidos.css">
<div class='row' style='margin-bottom: 2em'>
	<div class='col-xs-12'>
		<!-- <a class='btn btn-default' href='<?=''//link_pagina($this, 'catalogo', 'catalogo')?>'><i class='glyphicon glyphicon-chevron-left'></i> Atrás</a> -->
	</div>
</div>
<?php if (isset($flash)) { ?>
<div class="row">
	<div class='col-xs-12'>
		<div class='alert alert-dismissable <?= $exito ? 'alert-success' : 'alert-warning' ?>'>
			<button class='close' data-dismiss='alert'>x</button>
			<?= $mensaje ?>
		</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<?php echo $this->load->view('parciales/detalles-producto', true); ?>
</div>
