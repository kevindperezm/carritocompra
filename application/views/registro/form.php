<div class='container-fluid'>
	<?php $this->load->helper('form'); $attrs = array('id' => 'usuario-form')?>
	<?= form_open($destino_formulario, $attrs) ?>
		<div class='row'>
			
			<?php
			$E = (isset($editar_usuario) and $this->input->post() == null);
			?>

			<div class='col-md-6'>
				<?= form_fieldset('Inicio de sesión') ?>

				<label for='inputUsuario'>Usuario</label>
				<input type='text' name='usuario' id='inputUsuario' class='form-control' value='<?= $E ? $editar_usuario->nombre_usuario : set_value('usuario') ?>'>
				<label for='inputContrasena'>Contraseña</label>
				<?php if ($E) { ?>
				<br><small><b>Nota:</b> Si no desea cambiar la contraseña de este usuario, deje este campo en blanco.</small>
				<?php } ?>
				<input type='password' name='contrasena' id='inputContrasena' class='form-control'>
				<label for='inputConfirmarContrasena'>Confirmar contraseña</label>
				<?php if ($E) { ?>
				<br><small><b>Nota:</b> Si no desea cambiar la contraseña de este usuario, deje este campo en blanco.</small>
				<?php } ?>
				<input type='password' name='confirmar-contrasena' id='inputConfirmarContrasena' class='form-control'>

				<?php if (isset($usar_roles) and $usar_roles) { ?>
				<label for='inputRol'>Rol de usuario</label>
				<select id='inputRol' class='form-control' name='rol'>
					<?php foreach ($GLOBALS['ROLES_USUARIO'] as $key => $value) { ?>
						<option value='<?=$key?>' 
						<?php 
						if ($E) {
							if ($key == $editar_usuario->rol) echo 'selected="selected"';
						} else {
							set_select('rol',$key);
						}
						?>
						><?=$value?></option>
					<?php } ?>
				</select>
				<?php } ?>				
				<?= form_fieldset_close() ?>
			</div>

			<div class='col-md-6'>
				<?= form_fieldset('Datos del usuario') ?>

				<label for='inputNombres'>Nombre(s)</label>
				<input type='text' name='nombres' id='inputNombres' class='form-control' value='<?= $E ? $editar_usuario->nombres :  set_value('nombres') ?>'>
				<label for='inputApellidoPaterno'>Apellido paterno</label>
				<input type='text' name='apellido_paterno' id='inputApellidoPaterno' class='form-control' value='<?= $E ? $editar_usuario->apellido_paterno :  set_value('apellido_paterno') ?>'>
				<label for='inputApellidoMaterno'>Apellido materno</label>
				<input type='text' name='apellido_materno' id='inputApellidoMaterno' class='form-control' value='<?= $E ? $editar_usuario->apellido_materno : set_value('apellido_materno') ?>'>
				<label for='inputDepartamento'>Departamento</label>
				<input type='text' name='departamento' id='inputDepartamento' class='form-control' value='<?= $E ? $editar_usuario->departamento :  set_value('departamento') ?>'>
				<label for='inputCargo'>Cargo</label>
				<input type='text' name='cargo' id='inputCargo' class='form-control' value='<?= $E ? $editar_usuario->cargo : set_value('cargo') ?>'>

				<?= form_fieldset_close() ?>
			</div>
		</div>
	</form> 
</div>