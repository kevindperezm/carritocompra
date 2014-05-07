<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		admin_logueado($this);
	}

	public function index() {
		$data['titulo'] = 'Administrador';
		load_admin_template($this, 'admin/index', $data);
	}

}
?>