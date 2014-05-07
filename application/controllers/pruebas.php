<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pruebas extends CI_Controller {

	private function show_result($title, $output){ 
		$data['title'] = $title;
		$data['output'] = $output;
		$this->load->view('pruebas', $data);
	}

	public function usuario_primero() {
		try {
			$U = Usuario::first();
		} catch (Exception $e) {
			$U = 'Error en la conexion.\n'.$e->getMessage();
		}
		$this->show_result('Primer usuario', $U);
	}

	public function usuario_todos() {
		try {
			$U = Usuario::all();
		} catch (Exception $e) {
			$U = 'Error en la conexion.\n'.$e->getMessage();
		}
		$this->show_result('Todos los usuarios', $U);
	}

	public function usuario_selecciones($id) {
		try {
			$user = Usuario::find($id);
			$U = $user->selecciones;
		} catch (Exception $e) {
			$U = $e->getMessage();
		}
		$this->show_result("Selecciones de $user->nombre_usuario", $U);
	}

	public function usuario_compras($id) {
		try {
			$user = Usuario::find($id);
			$U = $user->compras;
		} catch (Exception $e) {
			$U = $e->getMessage();
		}
		$this->show_result("Compras de $user->nombre_usuario", $U);
	}

	public function compra_usuario($id) {
		try {
			$user = Compra::find($id);
			$U = $user->usuario;
		} catch (Exception $e) {
			$U = $e->getMessage();
		}
		$this->show_result("Usuario de una compra", $U);
	}

	public function prueba_save() {
		$user = Usuario::first();
		$user->nombre_usuario = "kevin";
		$U = $user->save();
		$this->show_result("Valor de retorno de ActiveRecord\Model->save()", $U);
	}

	public function pedido() {
		try {
			// $p = Compra::first();
			$p[] = Pedido::first();
			// $valor = $p->pedidos;
			$p[0]->compras;
			// $valor = $p->compras;
			$p[] = Compra::first();
			$p[1]->pedido;
			$valor = $p;
		} catch (Exception $e) {
			$valor = $e->getMessage();
		}
		$this->show_result('Primer pedido', $valor);
	}

	public function masivo1() {
		try {
			$valor = 'OK';
			$upd = array('activado' => '1');
			$where = array('id' => array(118, 119, 200));
			$valor = sizeof(Usuario::all(array('conditions' => $where)));
			Usuario::table()->update($upd, $where);
		} catch (Exception $e) {
			$valor = $e->getMessage();
		}
		$this->show_result('Primer pedido', $valor);
	}
}

?>