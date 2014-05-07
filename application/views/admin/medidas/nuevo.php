<div class='container-fluid'>
	<div class='row'>
		<div class='col-xs-12' style='margin-bottom: 1em'>
			<a href='<?=base_url()?>admin/medidas' class='btn btn-default' style='margin-right: 0.5em'><i class='glyphicon glyphicon-chevron-left'></i> Atrás</a> 
			<h3 style='display:inline-block'><?= $titulo ?></h3>
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
	<!-- <div class='row'>
		<div class='col-xs-12'>
		</div>
	</div> -->
	<div class='row'>
		<div class='col-xs-12'>
			<div class="well">
				<?php $E = isset($editar_medida)?>
				<?php $attrs = array('id' => 'medida-form') ?>
				<?=form_open($destino_formulario, $attrs)?>
					<fieldset>
						<legend>Detalles de medida</legend>
						<div class='input-group'>
							<span class='input-group-addon'>Nombre</span>
							<input type='text' name='nombre' class='form-control' value='<?=$E ? $editar_medida->nombre : set_value('nombre')?>'>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-12'>
			<input type='submit' form='medida-form' class='btn btn-primary' value='Guardar'>
		</div>
	</div>
</div>	