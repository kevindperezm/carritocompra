<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo extends CI_Controller {
	static $productosPorPagina = 25;
	public function __construct() {
		parent::__construct();

		$roles = array(
			ROLES_CLIENTE_COMUN,
			ROLES_ADMINISTRADOR
		);

		if (!esta_logueado($this, $roles)) {
			redirect('login');
		}
	}

	public function index($paramsOffset = 2, $paginationUrl = 'catalogo/pagina', $paginationSegment = 3) {
		$params = $this->uri->uri_to_assoc($paramsOffset);
		// echo "<pre style='margin-top: 5em'>";
		// var_dump($params);
		// echo "</pre>";

		$pagina = !empty($params['pagina']) ? $params['pagina'] : 1;
		pagina($this, 'catalogo', $pagina);
		pagina($this, 'buscar', 0);

		$condiciones = array(
			'conditions' => array('publicado > 0'),
			'order' => 'descripcion ASC'
		);

		$categoria = !empty($params['categoria']) ? $params['categoria'] : null;
		if ($categoria != null) {
			$categoriaObj = Categoria::find(array('conditions' => array('url_nombre = ?', $categoria)));
			// var_dump($categoriaObj);
			$condiciones = array(
				'conditions' => array('publicado > 0 and categoria_id = ?', $categoriaObj->id)
			);
		}

		$data = obtener_flash($this);
		$data['productos'] = do_pagination($this,
		   $paginationUrl,
		   0,
		   $pagina,
		   'Producto',
		   $condiciones,
		   Catalogo::$productosPorPagina,
		   $paginationSegment
		);

		$categoria == null ? $data['titulo'] = 'Catálogo de productos' : $data['titulo'] = 'Productos en la categoría "'.$categoriaObj->nombre.'"';
		$categoria == null ? $data['busquedaUrl'] = 'catalogo/buscar' : $data['busquedaUrl'] = "categoria/$categoriaObj->url_nombre/buscar";

		load_template($this, 'catalogo/catalogo', $data);
	}

	public function categoria($nombre_categoria = null) {
		$this->index(1, "categoria/$nombre_categoria/pagina", 4);
	}

	public function buscar($pagina = 1) {
		/* Recuperando parámetros especiales, como la categoría */
		$params = $this->uri->uri_to_assoc(1);
		// echo "<pre style='margin-top: 5em'>";
		// var_dump($params);
		// echo "</pre>";
		$categoria = !empty($params['categoria']) ? $params['categoria'] : null;

		// Recuperando parámetros POST
		$post = $this->input->post();
		if ($post === null or empty($post['buscar'])) {
			// No hay parámetros
			redirigir_pagina($this, 'catalogo', 'catalogo');
			return;
		}

		pagina($this, 'buscar', $pagina);
		$data = obtener_flash($this);


		/* Comportamiento básico */
		// Condiciones de búsqueda
		$condiciones = array(
			'conditions' => array('ucase(descripcion) like ?', '%'.strtoupper($post['buscar']).'%'),
			'order' => 'descripcion asc'
		);
		$paginationUrl = 'catalogo/buscar/pagina/';
		$paginationSegment = 4;
		/* Modificaciones al comportamiento básico si existe categoría definida */
		if ($categoria != null) {
			$categoriaObj = Categoria::find(array('conditions' => array('url_nombre = ?', $categoria)));
			$paginationUrl = 'categoria/'.$categoriaObj->url_nombre.'/buscar/pagina';
			$paginationSegment = 5;
			$condiciones = array(
				'conditions' => array('categoria_id = ? and ucase(descripcion) like ?', $categoriaObj->id, '%'.strtoupper($post['buscar']).'%'),
				'order' => 'descripcion ASC'
			);
		}


		$data['productos'] = do_pagination($this,
		   $paginationUrl,
		   0,
		   $pagina,
		   'Producto',
		   $condiciones,
		   Catalogo::$productosPorPagina,
		   $paginationSegment
		);

		$data['buscar'] = $post['buscar'];
		$categoria == null ? $data['titulo'] = 'Resultados para "'.$post['buscar'].'" en el catálogo' : (
		$data['titulo'] = 'Resultados para "'.$post['buscar'].'" en la categoría "'.$categoriaObj->nombre.'"');
		$categoria == null ? $data['busquedaUrl'] = 'catalogo/buscar' : $data['busquedaUrl'] = "categoria/$categoriaObj->url_nombre/buscar";
		load_template($this, 'catalogo/catalogo', $data);
	}

	public function producto($id) {
		$data = obtener_flash($this);
		$producto = Producto::find_by_id($id);
		if ($producto != null and $producto->publicado > 0) {
			$data['producto']= $producto;
			$data['titulo']= 'Detalles de '.$producto->descripcion;
		} else {
			$data['no_disponible']= "El producto especificado no está disponible";
			$data['titulo'] = 'Producto no disponible';
		}
		if ($this->input->is_ajax_request()) {
			$this->load->view('catalogo/dialogo_detalles', $data);
		} else {
			load_template($this, 'catalogo/detalles', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */