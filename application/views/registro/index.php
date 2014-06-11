<h3>Registrarse en <?=NOMBRE_TIENDA?></h3>
<?php $this->load->helper('form') ?>
<?php if (!empty($falla)) { ?>
<div class='alert alert-danger'>
	<p><?=$mensaje_error?></p>
	<?=validation_errors()?>
</div><br>
<?php } ?>

<div>
	<div class='well'>
		<?php
		$data['destino_formulario'] = 'registro';
		$this->load->view('registro/form', $data);
		?>
	</div>
	<div class='row' style="margin-bottom: 1.2em">
		<div class='col-xs-12'>
		<input form='usuario-form' type='submit' name='submit' class='btn btn-primary btn-lg' value="Guardar">
		</div>
	</div>
</div>
