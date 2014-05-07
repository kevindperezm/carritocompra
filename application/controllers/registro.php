<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function index()	{
		$data['no_sidebar'] = 1;
		$data['titulo'] = 'Registrarse';
		$post = $this->input->post();
		if (isset($post['submit'])) {
			$this->completar_registro();
		} else {
			load_template($this, 'registro/index', $data);
		}
	}

	private function completar_registro() {
		$this->load->helper('registro');
		$ret = registrar_usuario($this, $this->input->post());

		$data['no_sidebar'] = 1;
		if ($ret['valor'] == 0) {
			$data['titulo'] = 'Gracias por registrarse';
			load_template($this, 'registro/exito', $data);
		} else {
			$data['titulo'] = 'Registrarse';
			$data['falla'] = true;
			if ($ret['valor'] == 2) $data['mensaje_error'] = $ret['mensaje_error'];
			else $data['mensaje_error'] = '';
			load_template($this, 'registro/index', $data);
		}
	}

}
/* End of file registro.php */
/* Location: ./application/controllers/registro.php */