<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function admin_logueado($context) {
	$roles = array(
		ROLES_ADMINISTRADOR
	);
	if (!esta_logueado($context, $roles)) {
		redirect('login');
	}
}

function esta_logueado($context, $rol_ids) {
	$uid = $context->session->userdata('user_id');
	$utoken = $context->session->userdata('user_token');

	if ($uid !== false and $utoken !== false) {

		$usuario = Usuario::find_by_id($uid);
		if ($usuario === false) {
			return false;
		}

		$tkn = Token::find_by_string($utoken);
		if ($tkn === null) return false;

		if (in_array($tkn, $usuario->tokens)) {
			return true;
		} else {
			return false;
		}

	} else {
		return false;
	}
}

function get_user_id($context) {
	/* 
	|
	| Devuelve el ID del usuario actual.
	| Si no se ha iniciado sesión, devuelve NULL.
	| @param context Controller que actúa como
	| contexto.
	*/
	$id = $context->session->userdata('user_id');
	if ($id !== false) return $id;
	else return null;
}

function generate_token() {
   $string = $_SERVER['HTTP_USER_AGENT'];
   $string .= '-cc-';
   $string .= $_SERVER['REMOTE_ADDR'];
   $string .= '-cc-';
   // $string .= $_SERVER['HTTP_X_FORWARDED_FOR'];
   // $string .= '-cc-';
   $string .= date("YmdHis");
   
   $fingerprint = sha1($string);
   return $fingerprint;
}

?>