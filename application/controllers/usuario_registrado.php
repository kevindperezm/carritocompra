<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_registrado extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if (!esta_logueado($this, $GLOBALS['ROLES_USUARIO'])) {
			redirect('login');
		}
	}

	public function index() {
		/* Muestra los datos personales del usuario */
		try {
			$data['usuario'] = Usuario::find( get_user_id($this) );
			$data['titulo'] = "Perfil de ".$data['usuario']->nombre_usuario;
			switch ( $data['usuario']->rol ) {
				case ROLES_ADMINISTRADOR:
					load_admin_template($this, 'usuario/index', $data);
					break;
				
				case ROLES_CLIENTE_COMUN:
					load_template($this, 'usuario/index', $data);
					break;
			}
		} catch (Exception $e) {

		}
	}
}

?>