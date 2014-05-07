<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medidas extends CI_Controller {
	
	// Filtros válidos para este controller
	public $filtros = array(
		// Clave => array('nombre para mostrar', 'valor del filtro')
		'todos' => array('Todos','1=1')
	);

	public function __construct() {
		parent::__construct();
		admin_logueado($this);
	}

	public function index($offset = 1) {
		pagina($this, 'medidas', $offset);
		$data = obtener_flash($this);

		$condiciones = filtro_merge($this, 'medidas', array('order' => 'nombre asc'));
		$data['medidas'] = do_pagination($this,
			'admin/medidas/pagina/',
			Medida::count(),
			$offset, 
			'Medida',
			$condiciones
		);

		$data['filtro'] = filtro($this, 'medidas');
		$data['filtros'] = $this->filtros;

		$data['titulo'] = 'Administrar medidas';
		load_admin_template($this,'admin/medidas/index', $data);
	}

	public function nuevo() {
		$post = $this->input->post();
		$data['destino_formulario'] = base_url().'admin/medidas/nuevo';
		$data['titulo'] = 'Nueva medida';
		if ($post == null) {
			load_admin_template($this,'admin/medidas/nuevo', $data);
		} else {
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');

			$ret = false;
			$medida = new Medida();
			$medida->nombre = strtolower(trim($post['nombre']));
			$ret = ($this->form_validation->run() and $medida->save());

			if ($ret) {
				/* Exito al añadir al medida */
				flash_exito($this, TRUE, "Medida \"".$medida->nombre."\" guardada.");
				redirect('admin/medidas/index');
			} else {
				$data['exito'] = FALSE;
				$data['falla'] = true;
				if ($ret['valor'] == 2) $data['mensaje_error'] = $ret['mensaje_error'];
				else $data['mensaje_error'] = '';
				load_admin_template($this,'admin/medidas/nuevo', $data);
			}
		}
	}

	public function modificar($editar_id) {
		$post = $this->input->post();
		$data['destino_formulario'] = base_url().'admin/medidas/modificar/'.$editar_id;

		$editar_medida = Medida::find_by_id($editar_id);
		if ($editar_medida == null) {
			$data['titulo'] = 'Modificar medida';
			$data['exito'] = FALSE;
			$data['falla'] = true;
			$data['mensaje_error'] = 'La medida especificada no existe.';
			load_admin_template($this,'admin/medidas/nuevo', $data);
			return;
		}
		$data['titulo'] = 'Modificar medida "'.$editar_medida->nombre.'"';
		$data['editar_medida'] = $editar_medida;

		if ($post == null) {	
			load_admin_template($this,'admin/medidas/nuevo', $data);
		} else {
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			
			$editar_medida->nombre = strtolower(trim($post['nombre']));
			$ret = ($this->form_validation->run() and $editar_medida->save());

			if ($ret) {
				/* Exito al modificar medida */

				flash_exito($this, TRUE, "Medida \"".$editar_medida->nombre."\" modificada.");
				redirigir_pagina($this, 'medidas', 'admin/medidas');
			} else {
				$data['exito'] = FALSE;
				$data['falla'] = true;
				if ($ret['valor'] == 2) $data['mensaje_error'] = $ret['mensaje_error'];
				else $data['mensaje_error'] = '';
				load_admin_template($this,'admin/medidas/nuevo', $data);
			}
		}	
	}

	public function eliminar($id) {
		try {
			$u = Medida::find_by_id($id);
			if ($u != null) {
				// Borrando...
				$u->delete();
				flash_exito($this, TRUE, "Medida \"$u->nombre\" eliminada.");
			} else {
				// Medida no existe
				flash_exito($this, FALSE, "La medida especificada no existe.");
			}
		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de eliminar la medida con id = $id. ".$e->getMessage());
		}
		redirigir_pagina($this, 'medidas', 'admin/medidas');
	}

	public function comando() {
		/* 
		| Actuamos sobre los seleccionados dependiendo del comando 
		| recibido en el formulario.
		*/
		$seleccionados = $this->input->post('seleccionados');
		$comando = $this->input->post('comando');
		try {

			switch ($comando) {
				/* TODO: Refactorizar comando */
				case 'eliminar-todos':
					$whre = array('id' => $seleccionados);
					$cant = sizeof(Medida::all(array('conditions' => $whre)));
					Medida::table()->delete($whre);
					flash_exito($this, TRUE, "$cant medidas eliminadas.");
					break;

			}
			redirigir_pagina($this, 'medidas', 'admin/medidas');

		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de cambiar el estado de múltiples medidas {".print_r($seleccionados)."}.".$e->getMessage());
		}
	}

	public function filtro($filtro) {
		filtro_controller($this, 'medidas', $filtro);
		redirigir_pagina($this, 'medidas', 'admin/medidas');
	}
}
?>