<div class='container-fluid'>

	<div class='row'>
		<div class='col-xs-12'>
			<h3><?=$titulo?></h3>
		</div>
	</div>
	<?php $this->load->helper('form') ?>
	<?php if (!empty($falla)) { ?>
	<div class="row">
		<div class='col-xs-12'>
			<div class='alert alert-dismissable <?= $exito ? 'alert-success' : 'alert-warning' ?>'>
				<button class='close' data-dismiss='alert'>x</button>
				<p><?=$mensaje_error?></p>
				<?=validation_errors()?>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class='row'>
		<div class="col-xs-12">
			<?=$this->load->view('admin/pedidos/tabla-detalles')?>
		</div>
	</div>

</div>