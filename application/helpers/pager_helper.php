<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function do_pagination($context, $ruta_sitio, $total, $page, $classname, $conditions = array(), $per_page = 25, $uri_segment = 4) {
	$context->load->library('pagination');

	$config['base_url'] = base_url().$ruta_sitio;
	$config['use_page_numbers'] = TRUE;
	$config['uri_segment'] = $uri_segment;
	$config['per_page'] = $per_page;
	$config['total_rows'] = $total;
	if (sizeof($conditions) > 0) {
		$config['total_rows'] = sizeof(call_user_func_array($classname.'::all', array($conditions)));
	}

	$open_tag = "<li>";
	$close_tag = "</li>";

	$config['first_link'] = "<<";
	$config['last_link'] = ">>";
	$config['prev_link'] = "<";
	$config['next_link'] = ">";

	$config['first_tag_open'] = $open_tag;
	$config['first_tag_close'] = $close_tag;
	$config['last_tag_open'] = $open_tag;
	$config['last_tag_close'] = $close_tag;
	$config['prev_tag_open'] = $open_tag;
	$config['prev_tag_close'] = $close_tag;
	$config['next_tag_open'] = $open_tag;
	$config['next_tag_close'] = $close_tag;
	$config['num_tag_open'] = $open_tag;
	$config['num_tag_close'] = $close_tag;
	$config['cur_tag_open'] = "<li class='active'><a href=''>";
	$config['cur_tag_close'] = "</a></li>";

	$context->pagination->initialize($config);

	$cns = array(
		'offset' => ($page - 1) * $per_page,
		'limit' => $per_page
	);
	$cns = array_merge($cns, $conditions);
	$elements = call_user_func_array($classname.'::all', array($cns));

	return $elements;
}

?>