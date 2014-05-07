<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias extends CI_Controller {
	
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
		pagina($this, 'categorias', $offset);
		$data = obtener_flash($this);

		$condiciones = filtro_merge($this, 'categorias', array('order' => 'nombre asc'));
		$data['categorias'] = do_pagination($this,
			'admin/categorias/pagina/',
			Categoria::count(),
			$offset, 
			'Categoria',
			$condiciones
		);

		$data['filtro'] = filtro($this, 'categorias');
		$data['filtros'] = $this->filtros;

		$data['titulo'] = 'Administrar categorias';
		load_admin_template($this,'admin/categorias/index', $data);
	}

	public function nuevo() {
		$post = $this->input->post();
		$data['destino_formulario'] = base_url().'admin/categorias/nuevo';
		$data['titulo'] = 'Nueva categoria';
		if ($post == null) {
			load_admin_template($this,'admin/categorias/nuevo', $data);
		} else {
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');

			$ret = false;
			$categoria = new Categoria();
			$categoria->nombre = trim($post['nombre']);
			$categoria->url_nombre = url_title(strtolower($categoria->nombre));
			$ret = ($this->form_validation->run() and $categoria->save());

			if ($ret) {
				/* Exito al añadir al categoria */
				flash_exito($this, TRUE, "Categoria \"".$categoria->nombre."\" guardada.");
				redirect('admin/categorias/index');
			} else {
				$data['exito'] = FALSE;
				$data['falla'] = true;
				if ($ret['valor'] == 2) $data['mensaje_error'] = $ret['mensaje_error'];
				else $data['mensaje_error'] = '';
				load_admin_template($this,'admin/categorias/nuevo', $data);
			}
		}
	}

	public function modificar($editar_id) {
		$post = $this->input->post();
		$data['destino_formulario'] = base_url().'admin/categorias/modificar/'.$editar_id;

		$editar_categoria = Categoria::find_by_id($editar_id);
		if ($editar_categoria == null) {
			$data['titulo'] = 'Modificar categoria';
			$data['exito'] = FALSE;
			$data['falla'] = true;
			$data['mensaje_error'] = 'La categoria especificada no existe.';
			load_admin_template($this,'admin/categorias/nuevo', $data);
			return;
		}
		$data['titulo'] = 'Modificar categoria "'.$editar_categoria->nombre.'"';
		$data['editar_categoria'] = $editar_categoria;

		if ($post == null) {	
			load_admin_template($this,'admin/categorias/nuevo', $data);
		} else {
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			
			$editar_categoria->nombre = trim($post['nombre']);
			$editar_categoria->url_nombre = url_title(strtolower($editar_categoria->nombre));
			$ret = ($this->form_validation->run() and $editar_categoria->save());

			if ($ret) {
				/* Exito al modificar categoria */

				flash_exito($this, TRUE, "Categoria \"".$editar_categoria->nombre."\" modificada.");
				redirigir_pagina($this, 'categorias', 'admin/categorias');
			} else {
				$data['exito'] = FALSE;
				$data['falla'] = true;
				if ($ret['valor'] == 2) $data['mensaje_error'] = $ret['mensaje_error'];
				else $data['mensaje_error'] = '';
				load_admin_template($this,'admin/categorias/nuevo', $data);
			}
		}	
	}

	public function eliminar($id) {
		try {
			$u = Categoria::find_by_id($id);
			if ($u != null) {
				// Borrando...
				$u->delete();
				flash_exito($this, TRUE, "Categoria \"$u->nombre\" eliminada.");
			} else {
				// Categoria no existe
				flash_exito($this, FALSE, "La categoria especificada no existe.");
			}
		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de eliminar la categoria con id = $id. ".$e->getMessage());
		}
		redirigir_pagina($this, 'categorias', 'admin/categorias');
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
					$cant = sizeof(Categoria::all(array('conditions' => $whre)));
					Categoria::table()->delete($whre);
					flash_exito($this, TRUE, "$cant categorias eliminadas.");
					break;

			}
			redirigir_pagina($this, 'categorias', 'admin/categorias');

		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de cambiar el estado de múltiples categorias {".print_r($seleccionados)."}.".$e->getMessage());
		}
	}

	public function filtro($filtro) {
		filtro_controller($this, 'categorias', $filtro);
		redirigir_pagina($this, 'categorias', 'admin/categorias');
	}
}
?>