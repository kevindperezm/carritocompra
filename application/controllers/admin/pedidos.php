<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller {
	
	// Filtros válidos para este controller
	public $filtros = array(
		// Clave => array('nombre para mostrar', 'valor del filtro')
		'todos' => array('Todos', '1=1'),
		'no-procesados' => array('Sólo no procesados', 'procesado <= 0'),
		'procesados' => array('Sólo procesados', 'procesado > 0')
	);

	public function __construct() {
		parent::__construct();
		admin_logueado($this);
	}

	public function index($offset = 1) {
		pagina($this, 'pedidos', $offset);
		$data = obtener_flash($this);

		$condiciones = filtro_merge($this, 'pedidos', array('order' => 'created_at desc'));
		$data['pedidos'] = do_pagination($this,
			'admin/pedidos/pagina/',
			Pedido::count(),
			$offset,
			'Pedido',
			$condiciones
		);
		$data['filtro'] = filtro($this, 'pedidos');
		$data['filtros'] = $this->filtros;

		$data['titulo'] = 'Administrar pedidos';
		load_admin_template($this,'admin/pedidos/index', $data);
	}

	public function detalles($pedido_id) {
		$pedido = Pedido::find_by_id($pedido_id);
		if ($pedido != null) {
			$data['titulo'] = 'Detalles de pedido #'.$pedido->id;
			$data['pedido'] = $pedido;
			$data['admin'] = true;
			
			load_admin_template($this,'admin/pedidos/detalles', $data);
		} else {
			flash_exito($this, FALSE, "El pedido especificado no existe.");	
			redirect('admin/pedidos');
		}
	}

	public function no_procesados() {
		$this->index(1, 'no_procesados');
	}

	public function procesados() {
		$this->index(1, 'procesados');
	}

	public function eliminar($id) {
		try {
			$u = Pedido::find_by_id($id);
			if ($u != null) {
				// Se borran todas las compras asociadas
				$ids = array();
				foreach ($u->compras as $compra) {
					$ids[] = $compra->id;
				}
				Compra::table()->delete(array(
					'id' => $ids
				));
				// Borrando...
				$u->delete();
				flash_exito($this, TRUE, "Pedido #$u->id eliminado.");
			} else {
				// Usuario no existe
				flash_exito($this, TRUE, "El pedido especificado no existe.");
			}
		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de eliminar pedido con id = $id. ".$e->getMessage());
		}
		redirigir_pagina($this, 'pedidos', 'admin/pedidos');
	}

	private function do_procesar($id, $estado) {
		$this->session->set_flashdata('mensaje_flash', TRUE);
		try {
			$u = Pedido::find_by_id($id);
			if ($u != null) {
				$u->procesado = $estado;
				$u->save();

				$mssg = "Pedido #$u->id marcado como ";
				if ($estado) $mssg .= "procesado.";
				else $mssg .= "no procesado.";

				flash_exito($this, TRUE, $mssg);
			} else {
				// Usuario no existe
				flash_exito($this, FALSE, "El pedido especificado no existe.");
			}
		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de cambiar el estado del pedido con id = $id. ".$e->getMessage());
		}
	}
	
	public function procesar($id) {
		$this->do_procesar($id, TRUE);
		redirigir_pagina($this, 'pedidos', 'admin/pedidos');
	}

	public function no_procesar($id) {
		$this->do_procesar($id, FALSE);
		redirigir_pagina($this, 'pedidos', 'admin/pedidos');
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
				case 'procesar-todos':
					$upd = array('procesado' => 1);
					$whre = array('id' => $seleccionados);
					$cant = sizeof(Pedido::all(array('conditions' => $whre)));
					Pedido::table()->update($upd, $whre);
					flas_exito($this, TRUE, "$cant pedidos activados.");
					break;

				case 'no-procesar-todos':
					$upd = array('procesado' => 0);
					$whre = array('id' => $seleccionados);
					$cant = sizeof(Pedido::all(array('conditions' => $whre)));
					Pedido::table()->update($upd, $whre);
					flash_exito($this, TRUE, "$cant pedidos desactivados.");
					break;

				case 'eliminar-todos':
					$whre = array('id' => $seleccionados);
					$cant = sizeof(Pedido::all(array('conditions' => $whre)));
					Pedido::table()->delete($whre);
					flash_exito($this, TRUE, "$cant pedidos eliminados.");
					break;

			}
			
			redirigir_pagina($this, 'pedidos', 'admin/pedidos');

		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de cambiar el estado de múltiples pedidos {".print_r($seleccionados)."}.".$e->getMessage());
		}
	}

	public function filtro($filtro) {
		filtro_controller($this, 'pedidos', $filtro);
		redirigir_pagina($this, 'pedidos', 'admin/pedidos');
	}
	
}
?>