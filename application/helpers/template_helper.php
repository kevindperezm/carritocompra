<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function load_template($controller, $view, $data = null, $return = false) {
	// $data['data'] = $data;
	$retData = $controller->load->view('template/header', $data, $return);
	$retData .= $controller->load->view($view, $data, $return);
	$retData .= $controller->load->view('template/footer', $data, $return);
	return $retData;
}

function load_admin_template($controller, $view, $data = null) {
	$controller->load->view('template/header-admin', $data);
	$controller->load->view($view, $data);
	$controller->load->view('template/footer', $data);
}

?>