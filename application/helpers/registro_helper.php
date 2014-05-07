<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function registrar_usuario($ref ,$data, $usar_roles = FALSE, $editar_id = null) {
	$ref->load->helper('form');
	$ref->load->library('form_validation');

	$ref->form_validation->set_rules('usuario', 'Usuario', 'required');
	if ($editar_id == null) {
		$ref->form_validation->set_rules('contrasena', 'Contraseña', 'required');
		$ref->form_validation->set_rules('confirmar-contrasena', 'Confirmar contraseña', 'required|matches[contrasena]');
	}
	$ref->form_validation->set_rules('nombres', 'Nombre(s)', 'required');
	$ref->form_validation->set_rules('apellido_paterno', 'Apellido paterno', 'required');
	$ref->form_validation->set_rules('apellido_materno', 'Apellido materno', 'required');
	$ref->form_validation->set_rules('departamento', 'Departamento', 'required');
	$ref->form_validation->set_rules('cargo', 'Cargo', 'required');
	if ($usar_roles) $ref->form_validation->set_rules('rol', 'Rol', 'required');

	// Rellenando nuevo usuario
	if ($editar_id == null) {
		$usuario = new Usuario();
	} else {
		$usuario = Usuario::find($editar_id);
	}
	$usuario->nombre_usuario = $data['usuario'];
	if ($editar_id != null and !empty($data['contrasena'])) {
		$usuario->contrasena = sha1($data['contrasena']);
	}
	$usuario->nombres = $data['nombres'];
	$usuario->apellido_paterno = $data['apellido_paterno'];
	$usuario->apellido_materno = $data['apellido_materno'];
	$usuario->departamento = $data['departamento'];
	$usuario->cargo = $data['cargo'];
	if ($usar_roles) $usuario->rol = $data['rol'];
	else $usuario->rol = ROLES_CLIENTE_COMUN;

	$valid_form = $ref->form_validation->run();
	if ($valid_form) $valid_user = $usuario->save();
	else $valid_user = FALSE;

	if (!$valid_form) $return['valor'] = 1;
	else if (!$valid_user) {
		$return['valor'] = 2;
		$return['mensaje_error'] = $usuario->errors->on('nombre_usuario');
	}
	else $return['valor'] = 0;

	return $return;
}

?>