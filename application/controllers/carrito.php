<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*! 
@file controllers/carrito.php
@brief Controller 'Carrito'.

Este archivo contiene el código de la clase Carrito, que actúa como el
controller para las operaciones propias del carrito de compra.
*/

/*!
@brief Controller del carrito de compra.
*/
class Carrito extends CI_Controller {
	/*!
	@brief Constructor del controller.
	@return Esta función no devuelve ningún valor.

	El constructor de la clase Carrito comprueba que el usuario que accede
	a través de la petición web haya iniciado sesión en la aplicación y su
	rol esté entre los permitidos para usar un carrito de compra.
	*/
	public function __construct() {
		parent::__construct();

		if (!esta_logueado($this, $GLOBALS['ROLES_USUARIO'])) {
			redirect('login');
		}
	}

	/*!
	@brief Página inicial del carrito de compra.
	@return Esta función no devuelve ningún valor.

	Esté método muestra la página inicial del carrito de compra, que
	consiste en un listado de los artículos que el usuario ha añadido
	a su carrito, mostrando 25 artículos por página. Los artículos se
	agrupan por id de producto y luego por id de variante, de tal forma
	que, por ejemplo, si el producto 'Plumón BACO' con la  variante 'rojo'
	es añadido al carrito múltiples veces, el carrito sólo muestra un 
	producto 'Plumón BACO' con la variante 'rojo' cuya cantidad solicitada
	es la suma de las cantidades de todas las veces que 'Plumón BACO' fue
	añadido. Pero, si después se añade otro producto diferente u otro
	'Pĺumón BACO' de variante distinta, como por ejemplo a¿'azul', el
	listado del carrito mostrará ahora dos veces el producto 'Plumón BACO':
	uno con la variante 'rojo' y otro con la variante 'azul'.

	@params int pagina Página del listado que se desea ver. Por defecto es 1.
	*/
	public function index($pagina = 1) {
		$data = obtener_flash($this); // Inicializa la variable $data.
		pagina($this, 'carrito', $pagina); // Guarda el número de página que está siendo visto.

		$conds = array(
			'conditions' => array('usuario_id = ? and concretada = 0', get_user_id($this)),
			'select' => '*, sum(precio_bruto) as precio_bruto_agrupado, sum(cantidad) as cantidad_agrupado',
			'group' => 'producto_id, variante_id',
			'order' => 'created_at desc'
		); // Condiciones que se pasarán al método 'do_pagination'. Así se filtran o agrupan las compras de carrito.

		// Esto va primero para aprovechar los mecanismos de caché
		$total = 0;
		foreach(Compra::all($conds) as $compra) {
			// Se calcula el total de las compras de carrito de este usuario.
			$total += $compra->cantidad_agrupado * $compra->producto->precio_unitario;
		}		
		$data['total'] = $total; // El totalse guarda para ser enviado a la view.
		
		$data['compras'] = do_pagination($this,
			'carrito/pagina/',
			0,
			$pagina,
			'Compra',
			$conds,
			25,
			3
		); // Las compras de carrito que serán mostradas se cargan usando 'do_pagination'.

		$data['titulo'] = 'Carrito';
		load_template($this, 'catalogo/carrito', $data);
	}

	public function agregar() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|integer');

		$tieneVariantes = ($this->input->post('tiene-variantes') !== FALSE);
		$id = $this->input->post('id');
		$cantidad = $this->input->post('cantidad');
		if (!$id or !$cantidad) {
			flash_exito($this, FALSE, 'Petición "agregar" mal hecha.');
		} else if (!$this->form_validation->run()) {
			/* El formulario no es válido */
			flash_exito($this, FALSE, 'La cantidad debe expresarse como un número sin decimales.');
			redirect(base_url().'producto/'.$this->input->post('id'));
		} else {
			try {
				$producto = Producto::find($id);
				$compra = new Compra();
				$compra->usuario_id = get_user_id($this);
				$compra->producto_id = $id;
				$tieneVariantes ? $compra->variante_id = $this->input->post('valor-variante') : $compra->variante_id = 0;
				$compra->cantidad = $cantidad;
				$compra->concretada = FALSE;
				$compra->save();

				flash_exito($this, TRUE, 'Producto "'.$producto->descripcion.'" agregado al carrito.');
				redirect(base_url().'producto/'.$producto->id);
				return;
			} catch (Exception $e) {
				flash_accion_error($this, 'Error al crear nueva compra de carrito: '.$e->getMessage());
			}
		}
		redirect($this, 'catalogo', 'catalogo');
	}

	public function remover($id) {
		/* Eliminar compra del carrito cuyo id = $id */
		try {
			$compra = Compra::find_by_id($id);
			if ($compra === null) {
				flash_exito($this, FALSE, 'La compra especificada no existe.');
			} else {
				/* 
				* Borramos las compras que tengan sean del mismo usuario, 
				* producto y variante.
				*/
				Compra::table()->delete(array(
					'usuario_id' => $compra->usuario_id,
					'producto_id' => $compra->producto_id,
					'variante_id' => $compra->variante_id
				));
				flash_exito($this, TRUE, 'El producto "'.$compra->producto->descripcion.'" se ha removido del carrito.');
			}
		} catch (Exception $e) {
			flash_accion_error($this, 'Error al remover un producto del carrito de un usuario: '.$e->getMessage());
		}
		redirigir_pagina($this, 'carrito', 'carrito');
	}

	public function vaciar() {
		try {
			$id = get_user_id($this);
			if ($id !== false) {
				Compra::table()->delete(array(
					'usuario_id' => $id,
					'concretada' => 0
				));
			} else {
				flash_accion_error($this, 'Id de usuari inválido.');
			}
		} catch (Exception $e) {
			flash_accion_error($this, 'Error al remover un producto del carrito de un usuario: '.$e->getMessage());
		}
		redirect(base_url().'carrito');
	}

	public function confirmar() {
		// Confirma el carrito actual como pedido
		// TODO: Comprobar formulario que llega
		$post = $this->input->post();
		try {
			$usuario = Usuario::find(get_user_id($this));
			if ($usuario !== null) {
				// Generando pedido
				$pedido = new Pedido();
				$pedido->usuario_id = $usuario->id;
				$pedido->observaciones = $post['observaciones'];
				$pedido->save();

				// Insertando filas de asociación pedido-compras
				foreach ($usuario->selecciones as $sel) {
					$pc = new PedidoCompra();
					$pc->pedido_id = $pedido->id;
					$pc->compra_id = $sel->id;
					$pc->save();

					// Actualizamos el estado de las selecciones
					$sel->concretada = TRUE;
					// Actualizamos el precio que tenía el producto
					// en esta venta al valor más reciente.
					$sel->precio_unitario = $sel->producto->precio_unitario;
					// Calculamos el total de esta compra cuando se confirmó.
					$sel->precio_bruto = $sel->precio_unitario * $sel->cantidad;
					$sel->save();
				}

				// flash_exito($this, TRUE, 'Su compra ha sido confirmada. El pedido será procesado pronto.');
				redirect(base_url().'carrito/confirmado/'.$pedido->id);
			} else {
				// Usuario inválido
				flash_exito($this, FALSE, 'Usuario no válido.');
				redirect(base_url().'carrito');	
			}
		} catch (Exception $e) {
			flash_accion_error($this, "No fue posible confirmar un carrito como pedido: ".$e->getMessage());
			redirect(base_url().'carrito');
		}
	}

	public function confirmado($idpedido, $imprimir = false) {
		// Este método previene que cuando se refresque la página de confirmación
		// de pedido se cree un nuevo pedido vacío.

		$data['usuario'] = Usuario::find(get_user_id($this));
		try {
			$data['pedido'] = Pedido::find($idpedido);
		} catch (Exception $e) {
			flash_exito($this, FALSE, 'No. de pedido inválido.');
			redirigir_pagina($this, 'catalogo', 'catalogo');
		}
		// Comprobando que el usuario sea el mismo que el que hizo el pedido.
		if ($data['usuario']->id == $data['pedido']->usuario->id) {
			$data['titulo'] = 'Compra confirmada';
			if ($imprimir) {
				# Genera el PDF imprimible con los detalles del pedido
				require_once(FCPATH.'application/third_party/tcpdf/tcpdf_import.php');
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
				ini_set('memory_limit','32M'); 
				$pdf->setPrintHeader(false);
				$pdf->SetMargins(0,0,0,true);
				$pdf->SetAutoPageBreak(TRUE, 0);
				$pdf->AddPage();
				#$pdf->writeHTML(load_template($this, 'catalogo/carrito-confirmado', $data, true));
				$html = load_template($this, 'login/index', $data, true);
				// echo '<pre>';
				// echo $html;
				// echo '</pre>';
				// return;
				$pdf->writeHTML($html);
				$pdf->Output('example_001.pdf', 'I');

			    return;
				} else {
					# Muestra la vista de pedido confirmado
					load_template($this, 'catalogo/carrito-confirmado', $data);
				}
		} else {
			flash_exito($this, FALSE, 'El usuario actual no realizó el pedido que trata de ver. Acceso prohibido.');
			redirigir_pagina($this, 'catalogo', 'catalogo');
		}
	}

	public function imprimir($idpedido) {
		// Genera el PDF imprimible de los detalles del pedido.
		$this->confirmado($idpedido, true);
	}
}
?>