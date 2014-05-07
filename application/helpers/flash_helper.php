<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function flash_exito($context, $success, $message) {
	$context->session->set_flashdata('mensaje_flash', TRUE);
	$context->session->set_flashdata('exito', $success);
	$context->session->set_flashdata('mensaje', $message);
}

function flash_accion_error($context, $error_mssg) {
	log_message('error', $error_mssg);
	flash_exito($context, FALSE, "Ocurrió un error al ejecutar la acción solicitada. Por favor reintente más tarde.");
}

function obtener_flash($context) {
	$data = array();
	$mensaje_flash = $context->session->flashdata('mensaje_flash');
	if ($mensaje_flash) {
		$data['flash'] = TRUE;
		$data['exito'] = $context->session->flashdata('exito');
		$data['mensaje'] = $context->session->flashdata('mensaje');
	}
	return $data;
}
	

?>