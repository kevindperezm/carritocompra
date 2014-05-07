<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	private function redirect_rol() {
		/*
		 | 
		 | Esta función redirige al usuario según su rol.
		 | Si el usuario es ADMINISTRADOR, será enviado a
		 | la página de inicio de administración. Si es 
		 | CLIENTE_COMUN, será enviado al catálogo. 
		*/
		$rol = $this->session->userdata('user_rol');
		switch ($rol) {
		case ROLES_ADMINISTRADOR:
			redirect('admin');
			break;
		case ROLES_CLIENTE_COMUN:
			redirect('catalogo');
			break;
		default:
			redirect('login');
			break;
		}
		exit();
	}

	public function index() {
		/*
		|
		| Controla el inicio de sesión.
		| Este método primero comprueba su el usuario
		| que visita la página ya está logueado 
		| en el sistema. Si es así, muestra la vista
		| 'login/index' (que redirigirá al usuario 
		| según su rol). Si se está enviando un
		| formulario de login, lo recibe y lo pasa
		| al método Login::do_login().
		| 
		*/
		$post = $this->input->post();
		if ($post == null) {
			
			$logueado = $this->session->userdata('user_logged_in');
			if (!$logueado) {
				$data = array(
					'no_sidebar' => TRUE,
					'titulo' => 'Iniciar sesión'
				);
				$this->load->view('login/index', $data);
			} else {
				$this->redirect_rol();
			}

		} else {

			$data = $this->do_login($post);
			if ($data === true) {
				$this->redirect_rol();
			} else {
				$this->load->view('login/index', $data);
			}

		}
	}

	private function do_login($post) {
		/*
		 |
		 | Este método comprueba las credenciales
		 | enviadas, contenidas dentro del array $post.
		 | Si las credenciales son válidas, genera un
		 | token de sesión y lo almacena. También coloca
		 | algunas variables de sesión, como son el id
		 | del usuario, su nombre, el token de sesión
		 | generado y su id de rol. Tras esto, este 
		 | método devuelve TRUE.
		 | Este método devuelve FALSE en dos situaciones:
		 | 1. Si el formulario no fue correctamente llenado y
		 | 2. Si las credenciales proporcionadas son inválidas.
		 |
		*/
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('contrasena', 'Contraseña', 'required');

		$usuario = Usuario::find(array(
			'conditions' => array('nombre_usuario = ? and contrasena = ? and activado', $post['usuario'], sha1($post['contrasena']))
		));

		$valid_form = $this->form_validation->run();
		$valid_user = ($usuario != null);
		if ($valid_form and $valid_user) {
			/* Inicio de sesión correcto */

			// Generar token de seguridad
			$token = new Token();
			$token->usuario_id = $usuario->id;
			$token->string = generate_token();
			$token->save(); 

			$userdata = array(
				'user_id' => $usuario->id,
				'user_nombre' => $usuario->nombres,
				'user_rol' => $usuario->rol,
				'user_token' => $token->string,
				'user_logged_in' => TRUE
				);
			$this->session->set_userdata($userdata);

			return true;
		} else {
			/* Inicio de sesión fallido */
			$data = array(
				'no_sidebar' => TRUE,
				'error' => TRUE,
				'titulo' => 'Iniciar sesión'
			);
			if (!$valid_user and $valid_form) 
				$data['mensaje_error'] = 'Usuario o contraseña incorrectos.';
			else 
				$data['mensaje_error'] = '';
			return $data;
		}
	}

	public function logout() {
		/*
		|
		| Controla el cierre de sesión.
		| Elimina las variables de sesión y el token de sesión asociado.
		| 
		*/
		Token::table()->delete(array(
			'string' => $this->session->userdata('user_token')
		));
		$this->session->sess_destroy();
		redirect('login');
	}
}

?>