<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

  // Filtros válidos para este controller
  public $filtros = array(
    // Clave => array('nombre para mostrar', 'valor del filtro')
    'todos' => array('Todos', '1=1'),
    'publicados' => array('Sólo publicados', 'publicado > 0'),
    'no-publicados' => array('Sólo no publicados', 'publicado <= 0'),
  );

  public function __construct() {
    parent::__construct();
    admin_logueado($this);
  }


  private function subir_imagen(){
    $config['upload_path'] = basepath().'public/img/productos/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '2024';
    $config['max_width']  = '800';
    $config['max_height']  = '800';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('imagen')) {
      /* Error al subir la imagen */
      $res['nombre'] = null;
      $res['error'] = $this->upload->display_errors();
    } else {
      $data = $this->upload->data();
      $res['nombre'] = $data['file_name'];
    }

    return $res;
  }

  private function validar_formulario($editando = FALSE) {
    $this->load->helper('form');
    $this->load->library('form_validation');

    // $this->form_validation->set_rules('imagen', 'Imagen', 'required');
    $this->form_validation->set_rules('descripcion', 'Descripción', 'required');
    $this->form_validation->set_rules('codigo', 'Código', 'required');
    $this->form_validation->set_rules('stock', 'Cantidad en almacén', 'required|integer');
    $this->form_validation->set_rules('categoria', 'Categoría', 'required|greater_than[0]');
    $this->form_validation->set_rules('precio_unitario', 'Precio unitario', 'required|numeric|greater_than[0]');
    $this->form_validation->set_rules('medida', 'Medida', 'required|numeric|greater_than[0]');

    return $this->form_validation->run();
  }

  public function index($pagina = 1){
    // var_dump($pagina);
    pagina($this, 'productos', $pagina);
    $data = obtener_flash($this);

    $condiciones = filtro_merge($this, 'productos', array('order' => 'id asc'));
    $data['productos'] = do_pagination($this,
      'admin/productos/pagina/',
      Producto::count(),
      $pagina,
      'Producto',
      $condiciones
    );
    $data['filtro'] = filtro($this, 'productos');
    $data['filtros'] = $this->filtros;

    $data['titulo'] = 'Administrar productos';
    load_admin_template($this,'admin/productos/index', $data);
  }

  public function nuevo(){
    $post = $this->input->post();
    $data['destino_formulario'] = base_url().'admin/productos/nuevo';
    if ($post == null) {
      $data['titulo'] = 'Nuevo producto';
      load_admin_template($this,"admin/productos/nuevo", $data);
    } else {
      /* Validamos formulario */
      $form = $this->validar_formulario();

      /* Procesamos la imagen */
      $img = null;
      if ($form) $img = $this->subir_imagen();

      if ($img != null and $img['nombre'] != null) {
        /* Procesamos el producto */
        $p = new Producto();
        $p->codigo = $post['codigo'];
        $p->descripcion = $post['descripcion'];
        $p->imagen = 'public/img/productos/'.$img['nombre'];
        $p->stock_unitario = $post['stock'];
        $p->precio_unitario = $post['precio_unitario'];
        $p->publicado = 0;
        $p->categoria_id = $post['categoria'];
        $p->medida_id = $post['medida'];

        $p->save();

        // Almacenando variantes de este producto
        $indiceTipos = 0;
        $indiceValores = 0;
        while ($indiceTipos < sizeof($post['tipo-variante'])) {
          $tipoVariante = $post['tipo-variante'][$indiceTipos];
          if ($tipoVariante != 0) {
            // Operación de guardado. Si ignora $tipoVariante == 0
            $valorVariante = $post['valor-variante'][$indiceValores];
            // Guardamos variante
            $V = new Variante();
            $V->tipo_variante_id = $tipoVariante;
            $V->producto_id = $p->id; // ID del producto recién guardado.
            $V->valor = $valorVariante;
            $V->save();

            $indiceValores++;
          }
          $indiceTipos++;
        }

        flash_exito($this, TRUE, "Producto \"".$this->input->post('descripcion')."\" registrado.");
        redirect('admin/productos/index');
      } else {
        $data['exito'] = FALSE;
        $data['titulo'] = 'Nuevo producto';
        $data['falla'] = true;
        if ($img != null and $img['nombre'] == null) $data['mensaje_error'] = $img['error'];
        else $data['mensaje_error'] = '';
        load_admin_template($this,'admin/productos/nuevo', $data);
      }
    }
  }

  public function modificar($editar_id) {
    /* Refactorizar modificar */
    $post = $this->input->post();
    $data['destino_formulario'] = base_url().'admin/productos/modificar/'.$editar_id;
    $data['usar_roles'] = TRUE;

    $editar_producto = Producto::find_by_id($editar_id);
    if ($editar_producto == null) {
      $data['titulo'] = 'Modificar producto';
      $data['exito'] = FALSE;
      $data['falla'] = true;
      $data['mensaje_error'] = 'El producto especificado no existe.';
      load_admin_template($this,'admin/productos/nuevo', $data);
      return;
    }
    $data['titulo'] = 'Modificar producto "'.$editar_producto->descripcion.'"';
    $data['editar_producto'] = $editar_producto;

    if ($post == null) {
      load_admin_template($this,'admin/productos/nuevo', $data);
    } else {
      /* Actualizar */
      $img = null;

      $form = $this->validar_formulario();

      if ($form) {
        /* Actualizar datos de producto */
        $editar_producto->codigo = $post['codigo'];
        $editar_producto->descripcion = $post['descripcion'];
        $editar_producto->stock_unitario = $post['stock'];
        $editar_producto->precio_unitario = $post['precio_unitario'];
        $editar_producto->categoria_id = $post['categoria'];
        $editar_producto->medida_id = $post['medida'];

        /* Modificando imagen */
        $ignorarImagen = TRUE;
        if ($_FILES['imagen']['error'] == 0) {
          $ignorarImagen = FALSE;
          /* Remover la imagen actual */
          $ubicacion = $_SERVER['SCRIPT_FILENAME'];
          $basepath = explode(basename($ubicacion), $ubicacion);
          $basepath = $basepath[0];
          try {
            unlink($basepath.$editar_producto->imagen);
          } catch (Exception $e) {
            log_message('error', $e->getMessage());
          }
          /* Guardar la nueva imagen */
          $img = $this->subir_imagen();
          if ($img['nombre'] != null) {
            $editar_producto->imagen = 'public/img/productos/'.$img['nombre'];
          }
        }

        /* Guardamos el producto editado */
        $editar_producto->save();
      }

      if ($form and ($ignorarImagen or ($img != null and $img['nombre'] != null))) {
        /* Exito al modificar al producto */
        flash_exito($this, TRUE, "Producto \"".$editar_producto->descripcion."\" modificado.");
        redirect('admin/productos/index');
      } else {
        $data['exito'] = FALSE;
        $data['falla'] = true;
        if ($img != null and $img['nombre'] == null) $data['mensaje_error'] = $img['error'];
        else $data['mensaje_error'] = '';
        load_admin_template($this,'admin/productos/nuevo', $data);
      }
    }
  }

  public function eliminar($id) {
    try {
      $u = Producto::find_by_id($id);
      if ($u != null) {
        // Borrando...
        $u->delete();
        /* Borrando imagen asociada */
        $imgfile = basepath().$u->imagen;
        unlink($imgfile);

        // Borrando variantes asociadas
        Variante::table()->delete(array(
          'producto_id' => $u->id
        ));

        flash_exito($this, TRUE, "Producto \"$u->descripcion\" eliminado.");
      } else {
        // producto no existe
        flash_exito($this, FALSE, "El producto especificado no existe.");
      }
    } catch (Exception $e) {
      flash_accion_error($this, "Error al tratar de eliminar producto con id = $id. ".$e->getMessage());
    }
    redirigir_pagina($this, 'productos', 'admin/productos');
  }

  private function do_publicar($id, $estado) {
    try {
      $u = Producto::find_by_id($id);
      if ($u != null) {
        $u->publicado = $estado;
        $u->save();

        $mssg = "El producto \"$u->descripcion\" ahora ";
        if ($estado) $mssg .= "es visible al publico.";
        else $mssg .= "está oculto para el público.";
        flash_exito($this, TRUE, $mssg);

      } else {
        // producto no existe
        flash_exito($this, FALSE, "El producto especificado no existe.");
      }
    } catch (Exception $e) {
      flash_accion_error($this, "Error al tratar de cambiar el estado del producto con id = $id. ".$e->getMessage());
    }
    redirigir_pagina($this, 'productos', 'admin/productos');
  }

  public function publicar($id) {
    $this->do_publicar($id, TRUE);
  }

  public function no_publicar($id) {
    $this->do_publicar($id, FALSE);
  }

  public function comando() {
    /* TODO: Refactorizar comando */
    /*
    | Actuamos sobre los seleccionados dependiendo del comando
    | recibido en el formulario.
    */
    $seleccionados = $this->input->post('seleccionados');
    $comando = $this->input->post('comando');
    try {
      switch ($comando) {
        case 'publicar-todos':
          $upd = array('publicado' => 1);
          $whre = array('id' => $seleccionados);
          $cant = sizeof(Producto::all(array('conditions' => $whre)));
          Producto::table()->update($upd, $whre);
          flash_exito($this, TRUE, "$cant productos publicados.");
          break;

        case 'ocultar-todos':
          $upd = array('publicado' => 0);
          $whre = array('id' => $seleccionados);
          $cant = sizeof(Producto::all(array('conditions' => $whre)));
          Producto::table()->update($upd, $whre);
          flash_exito($this, TRUE, "$cant productos retirados de publicación.");
          break;

        case 'eliminar-todos':
          $whre = array('id' => $seleccionados);
          $cant = sizeof(Producto::all(array('conditions' => $whre)));
          Producto::table()->delete($whre);
          flash_exito($this, TRUE, "$cant productos eliminados.");
          break;

      }
      redirigir_pagina($this, 'productos', 'admin/productos');
    } catch (Exception $e) {
      flash_accion_error($this, "Error al tratar de cambiar el estado de múltiples productos {".print_r($seleccionados)."}.".$e->getMessage());
    }
  }

  public function filtro($filtro) {
    filtro_controller($this, 'productos', $filtro);
    redirigir_pagina($this, 'productos', 'admin/productos');
  }

}
?>