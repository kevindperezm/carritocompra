<?php if (isset($no_disponible)) { ?>
  <div class='col-xs-12'>
    <div class='alert alert-danger'>
      <?=$no_disponible?>
    </div>
  </div>
  <?php } else { ?>
  <div class="latte col-xs-12 col-sm-6">
    <h1 class='hidden-sm hidden-md hidden-lg'>
      <?=$producto->descripcion?><br>
      <span class='texto-rojo' style='font-size: 1.6em'><b>$ <?=number_format($producto->precio_unitario, 2)?></b></span><br>
      x <?= !is_null($producto->medida) ? $producto->medida->nombre : 'pieza'?>
    </h1>
    <div class='well text-center'>
      <img src="<?= base_url().$producto->imagen ?>" class="img-responsive"
           style="display: inline-block; margin-bottom: 0.5em;">
      <br>
      <?php $this->load->helper('form')?>
      <?php $attrs = array('class' => 'comprar-form') ?>
      <?=form_open(base_url().'carrito/agregar/'.$producto->id, $attrs)?>
      <input type='hidden' name='id' value='<?=$producto->id?>'>
      <div class='input-group'>
        <span class='input-group-addon'>Cantidad</span>
        <input type="number" value='1' min='1' name="cantidad" class="form-control">
        <span class='input-group-addon'>x <b>$ <?=number_format($producto->precio_unitario, 2)?></b></span>
      </div>
      <button type='submit' class='btn btn-danger btn-lg' style='width: 100%; margin-top: 0.5em' <?php if (isset($no_disponible)) { echo 'disabled="disabled"'; }?>><i class='glyphicon glyphicon-shopping-cart'></i> Añadir al carrito</a>
      </form>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6">
    <h1 class='hidden-xs'>
      <?=$producto->descripcion?><br>
      <b class='texto-rojo' style='font-size: 1.6em'>$ <?=number_format($producto->precio_unitario, 2)?></b><br>
      x <?=!is_null($producto->medida) ? $producto->medida->nombre : 'pieza';?>
    </h1>
    <?php if (isset($no_disponible)) { ?>
    <div class='alert alert-danger hidden-xs'>
      <?=$no_disponible?>
    </div>
    <?php } ?>
    <?php
    if (sizeof($producto->variantes) > 0) {
      # Este input hidden se usa para que el controlador que recibe el formulario de compra
      # exija que se elija una variante de este producto.
      echo '<input type="hidden" name="tiene-variantes" form="comprar-form" value="1">';

      # Función que ayuda en la creación de un div que represente a una variante de color.
      function colorDiv($colorHex, $numero, $variante) {
        $div = "
        <label class='btn btn-primary colorDiv detalles ";
        if ($numero == 0) $div .= "active";
        $div .= "' style='background: $colorHex'>
        <input type='radio' form='comprar-form' name='valor-variante' value='$variante->id'";
        if ($numero == 0) $div .= "checked='checked'";
        $div .= ">
      </label>";
      return $div;
    }

      # Recorriendo las variantes del producto.
      # Primero hacemos un ciclo que agrupará los tipos de variante.
      # Para que el ciclo haga bien su trabajo, las variantes del producto
      # deben estar ordenadas según su id de tipo de variante, de forma
      # ascendente.
    $tipoVarianteActual = 0;
    foreach ($producto->variantes as $tipoVariante) {
        # Lo siguiente sólo se ejecuta cuando nos topamos con un nuevo
        # id de tipo de variante.
      if ($tipoVariante->tipo_variante_id != $tipoVarianteActual) {
          # Recordamos el nuevo id de tipo de variante.
        $tipoVarianteActual = $tipoVariante->tipo_variante_id;

          # Esta variable lleva cuenta de los variantes de este grupo de
          # variantes que ya se han mostrado. Así podemos saber cuál es la
          # primera variante disponible de este grupo y marcarla para comodidad
          # del usuario.
        $varianteCount = 0;

        echo "
        <div class='variantes well'>

          <span class='titulo'>".ucfirst($GLOBALS['TIPOS_VARIANTE'][$tipoVariante->tipo_variante_id])." disponibles: </span>
          <div class='btn-group' data-toggle='buttons'>";

                # Mostramos cada variante que pertenezca al grupo actual de variantes.
                # Los grupos se forman por el id de tipo de variante de cada variante.
                # Un switch nos ayuda a identificar los tipos de variante y así
                # poder mostrar las variantes en la forma correcta.
                # Ya que esté ciclo interno itera sobre todos las variantes del
                # producto pero actúa según el id de tipo de variante, no actuará
                # sobre variantes cuyo id de tipo de variante no es el mismo que el
                # valor actual de la iteración del ciclo que contiene este código.
            foreach ($producto->variantes as $valorVariante) {
              if ($valorVariante->tipo_variante_id == $tipoVarianteActual)
                switch ($valorVariante->tipo_variante_id) {
                  case VARIANTE_COLORES:
                  echo colorDiv($valorVariante->valor, $varianteCount, $valorVariante);
                  break;
                }
                $varianteCount ++;
              }
              echo "
            </div>
          </div>";
        } // if
      } // foreach
    } //if ?>
    <p>
      <b>Código:</b> <?=$producto->codigo?><br>
      <b>Categoría:</b> <?= !is_null($producto->categoria) ? '<a href="'.base_url().'categoria/'.$producto->categoria->url_nombre.'">'.$producto->categoria->nombre.'</a>' : 'Ninguna'?>
    </p>
  </div>
  <?php
} ?>
