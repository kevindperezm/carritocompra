<div class='container-fluid'>
	<div class='row'>
		<div class='col-xs-12' style='margin-bottom: 1em'>
			<a href='<?=base_url()?>admin/usuarios' class='btn btn-default' style='margin-right: 0.5em'><i class='glyphicon glyphicon-chevron-left'></i> Atrás</a> 
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
				<?php
				$data['destino_formulario'] = $destino_formulario;
				$data['usar_roles'] = $usar_roles;
				if (isset($editar_usuario)) $data['editar_usuario'] = $editar_usuario;
				$this->load->view('registro/form', $data);
				?>
			</div>
			<div class='row'>
				<div class='col-xs-12'>
					<input form='usuario-form' type='submit' name='submit' class='btn btn-primary btn-lg' value="Guardar">
				</div>
			</div>
		</div>
	</div>
</div>	