<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Respuesta{}
class Usuarios extends CI_Controller {
	
	// Filtros válidos para este controller
	public $filtros = array(
		// Clave => array('nombre para mostrar', 'valor del filtro')
		'todos' => array('Todos', '1=1'),
		'activados' => array('Sólo activados', 'activado > 0'),
		'desactivados' => array('Sólo desactivados', 'activado <= 0')
	);

	public function __construct() {
		parent::__construct();
		admin_logueado($this);

		$cc = array(
			'rol-cliente_comun' => array('Sólo usuarios de rol CLIENTE_COMUN', 'rol = '.ROLES_CLIENTE_COMUN)
		);
		$ad = array(
			'rol-administrador' => array('Sólo usuarios de rol ADMINISTRADOR', "rol = ".ROLES_ADMINISTRADOR)
		);

		$this->filtros = array_merge($this->filtros, $cc);
		$this->filtros = array_merge($this->filtros, $ad);
	}

	public function index($offset = 1) {
		pagina($this, 'usuarios', $offset);
		$data = obtener_flash($this);

		$condiciones = filtro_merge($this, 'usuarios', array('order' => 'created_at desc'));
		$data['usuarios'] = do_pagination($this,
			'admin/usuarios/pagina/',
			Usuario::count(),
			$offset, 
			'Usuario',
			$condiciones
		);

		// Remover usuario actual de la lista de usuarios.
		// TODO: Algoritmo más rápido para hacer esto.
		$uid = get_user_id($this);
		for ($i = 0; $i < sizeof($data['usuarios']); $i++) {
			if ($data['usuarios'][$i]->id == $uid) unset($data['usuarios'][$i]);
		}

		$data['filtro'] = filtro($this, 'usuarios');
		$data['filtros'] = $this->filtros;

		$data['titulo'] = 'Administrar usuarios';
		load_admin_template($this,'admin/usuarios/index', $data);
	}

	public function obtener_tabla() {
		$r = new Respuesta();

		$r->cols = new Respuesta();

		$r->cols->id = new Respuesta();
		$r->cols->id->index = 1;
		$r->cols->id->type = 'number';

		$r->cols->nombre = new Respuesta();
		$r->cols->nombre->index = 2;
		$r->cols->nombre->type = 'string';

		$us = Usuario::all();
		foreach ($us as $u) {
			$ud = new Respuesta();
			$ud->id = $u->id;
			$ud->nombre = $u->nombre_usuario;
			$r->rows[] = $ud;
		}

		echo json_encode($r);
	}

	public function nuevo() {
		$post = $this->input->post();
		$data['destino_formulario'] = base_url().'admin/usuarios/nuevo';
		$data['usar_roles'] = TRUE;
		$data['titulo'] = 'Nuevo usuario';
		if ($post == null) {
			load_admin_template($this,'admin/usuarios/nuevo', $data);
		} else {
			$this->load->helper('registro');
			$ret = registrar_usuario($this, $this->input->post(), TRUE);

			if ($ret['valor'] == 0) {
				/* Exito al añadir al usuario */
				flash_exito($this, TRUE, "Usuario \"".$this->input->post('usuario')."\" registrado.");
				redirect('admin/usuarios/index');
			} else {
				$data['exito'] = FALSE;
				$data['falla'] = true;
				if ($ret['valor'] == 2) $data['mensaje_error'] = $ret['mensaje_error'];
				else $data['mensaje_error'] = '';
				load_admin_template($this,'admin/usuarios/nuevo', $data);
			}
		}
	}

	public function modificar($editar_id) {
		$post = $this->input->post();
		$data['destino_formulario'] = base_url().'admin/usuarios/modificar/'.$editar_id;
		$data['usar_roles'] = TRUE;

		$editar_usuario = Usuario::find_by_id($editar_id);
		if ($editar_usuario == null) {
			$data['titulo'] = 'Modificar usuario';
			$data['exito'] = FALSE;
			$data['falla'] = true;
			$data['mensaje_error'] = 'El usuario especificado no existe.';
			load_admin_template($this,'admin/usuarios/nuevo', $data);
			return;
		}	
		$data['titulo'] = 'Modificar usuario "'.$editar_usuario->nombre_usuario.'"';
		$data['editar_usuario'] = $editar_usuario;

		if ($post == null) {	
			load_admin_template($this,'admin/usuarios/nuevo', $data);
		} else {
			$this->load->helper('registro');
			$ret = registrar_usuario($this, $this->input->post(), TRUE, $editar_id);

			if ($ret['valor'] == 0) {
				/* Exito al modificar al usuario */
				/* Borramos los token de seguridad del usuario.
				 * Esto lo forzará a iniciar sesión nuevamente, 
				 * para que pueda apreciar los cambios que se 
				 * han hecho.
				 */
				Token::table()->delete(array(
					'usuario_id' => $editar_usuario->id
				));

				flash_exito($this, TRUE, "Usuario \"".$this->input->post('usuario')."\" modificado. El usuario tendrá que volver a iniciar sesión.");
				redirigir_pagina($this, 'usuarios', 'admin/usuarios');
			} else {
				$data['exito'] = FALSE;
				$data['falla'] = true;
				if ($ret['valor'] == 2) $data['mensaje_error'] = $ret['mensaje_error'];
				else $data['mensaje_error'] = '';
				load_admin_template($this,'admin/usuarios/nuevo', $data);
			}
		}	
	}

	public function eliminar($id) {
		try {
			$u = Usuario::find_by_id($id);
			if ($u != null) {
				// Borrando...
				$u->delete();
				flash_exito($this, TRUE, "Usuario \"$u->nombre_usuario\" eliminado.");
			} else {
				// Usuario no existe
				flash_exito($this, FALSE, "El usuario especificado no existe.");
			}
		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de eliminar el usuario con id = $id. ".$e->getMessage());
		}
		redirigir_pagina($this, 'usuarios', 'admin/usuarios');
	}

	private function do_activar($id, $estado) {
		try {
			$u = Usuario::find_by_id($id);
			if ($u != null) {
				$u->activado = $estado;
				if (!$u->save()) throw new Exception($u->errors->on('nombre_usuario'), 1);

				$mssg = "Usuario \"$u->nombre_usuario\" ";
				if ($estado) $mssg .= "activado.";
				else $mssg .= "desactivado.";
				flash_exito($this, TRUE, $mssg);
			} else {
				// Usuario no existe
				flash_exito($this, FALSE, "El usuario especificado no existe.");
			}
		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de cambiar el estado del usuario con id = $id. ".$e->getMessage());
		}
	}
	
	public function activar($id) {
		$this->do_activar($id, TRUE);
		redirigir_pagina($this, 'usuarios', 'admin/usuarios');
	}

	public function desactivar($id) {
		$this->do_activar($id, FALSE);
		Token::table()->delete(array(
			'usuario_id' => $id
		));
		redirigir_pagina($this, 'usuarios', 'admin/usuarios');
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
				case 'activar-todos':
					$upd = array('activado' => 1);
					$whre = array('id' => $seleccionados);
					$cant = sizeof(Usuario::all(array('conditions' => $whre)));
					Usuario::table()->update($upd, $whre);
					flash_exito($this, TRUE, "$cant usuarios activados.");
					break;

				case 'desactivar-todos':
					$upd = array('activado' => 0);
					$whre = array('id' => $seleccionados);
					$cant = sizeof(Usuario::all(array('conditions' => $whre)));
					Usuario::table()->update($upd, $whre);
					flash_exito($this, TRUE, "$cant usuarios desactivados.");
					break;

				case 'eliminar-todos':
					$whre = array('id' => $seleccionados);
					$cant = sizeof(Usuario::all(array('conditions' => $whre)));
					Usuario::table()->delete($whre);
					flash_exito($this, TRUE, "$cant usuarios eliminados.");
					break;

			}
			redirigir_pagina($this, 'usuarios', 'admin/usuarios');

		} catch (Exception $e) {
			flash_accion_error($this, "Error al tratar de cambiar el estado de múltiples usuarios {".print_r($seleccionados)."}.".$e->getMessage());
		}
	}

	public function filtro($filtro) {
		filtro_controller($this, 'usuarios', $filtro);
		redirigir_pagina($this, 'usuarios', 'admin/usuarios');
	}
}
?>